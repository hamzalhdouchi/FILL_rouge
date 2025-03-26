<?php

namespace App\Repositories;

use App\Models\Plat;
use App\RepositoryInterfaces\CommandeRepositoryInterface;
use App\Models\Commande;

class CommandeRepository implements CommandeRepositoryInterface
{
    public function create( $data)
    {
        $commande = Commande::create($data);

        $paltes = $data->plates;
        $commande->plat()->attach($paltes);

        $total_price = Plat::whereIn('id',$paltes)->sum('prix');

        $commande->update(['prixTotal'=>$total_price]);
        return response()->json(['message' => 'Commande created successfully', 'commande' => $commande]);
    }

    public function getById($id)
    {
        return Commande::findOrFail($id);
    }

    public function getAll()
    {
        $commande = Commande::all();
        return $commande;
    }

    public function update($id,$data)
    {
        $commande = Commande::findOrFail($id);

        $plats = $data->plats;
    
        $commande->plats()->sync($plats);

        $totalPrice = Plat::whereIn('id', $plats)->sum('price');

        $commande->update(['total_price' => $totalPrice]);
    
        return response()->json(['message' => 'Commande updated successfully', 'commande' => $commande]);
    }

    public function delete($id)
    {
        $commande = Commande::findOrFail($id);
        $commande->delete();
        return true;
    }

    public function changeStatus($id, $status)
    {
        $commande = Commande::findOrFail($id);
        $commande->statut = $status;
        $commande->save();
        return $commande;
    }

    public function calculateTotal($id)
    {
        $commande = Commande::findOrFail($id);
        return $commande->quantite * $commande->prixTotal;
    }

    public function calculateSubTotal($id)
    {
        $commande = Commande::findOrFail($id);
        $total = $commande->quantite * ($commande->prixTotal * 0.9);
        return $total;
    }
}

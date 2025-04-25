<?php

namespace App\Repositories;

use App\Models\Plat;
use App\RepositoryInterfaces\CommandeRepositoryInterface;
use App\Models\Commande;

class CommandeRepository implements CommandeRepositoryInterface
{
    public function create($data)
    {
        $commande = Commande::create($data);
    
        $plats = $data['plats'];
        $attachData = [];
    
        foreach ($plats as $plat) {
            $attachData[$plat['plat_id']] = [
                'quantite' => $plat['quantite'],
                'notes' => $plat['notes'] ?? null,
            ];
        }
    
        $commande->plat()->attach($attachData);
    
        $total_price = 0;
        foreach ($plats as $plat) {
            $platModel = Plat::find($plat['plat_id']);
            $total_price += $platModel->prix * $plat['quantite'];
        }
    
        $commande->update(['prixTotal' => $total_price]);
    
        return response()->json([
            'message' => 'Commande créée avec succès',
            'commande' => $commande
        ]);
    }
    public function getById($id)
    {
        return Commande::findOrFail($id);
    }
    public function getAllByRestaurantId($id)
    {
        return Commande::where('restaurant_id',$id)->get();
    }

    public function getCommendById($restaurant_id, $table_id)
    {
        return Commande::where('restaurant_id', $restaurant_id)->where('table_number', $table_id)->with('plat')->get();
    }

    public function getAll($id)
    {
        $commande = Commande::where('restaurant_id', $id);
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

    public function delet($id)
    {
        $commande = Commande::findOrFail($id);
        $commande->delete();
    }

}

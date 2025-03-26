<?php

namespace App\Repositories;

use App\RepositoryInterfaces\CommandeRepositoryInterface;
use App\Models\Commande;

class CommandeRepository implements CommandeRepositoryInterface
{
    public function create(array $data)
    {
        return Commande::create($data);
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

    public function update($id, array $data)
    {
        $commande = Commande::findOrFail($id);
        $commande->update($data);
        return $commande;
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

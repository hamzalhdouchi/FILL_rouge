<?php

namespace App\Repositories;

use App\Models\Plat;
use App\RepositoryInterfaces\PlatRepositoryInterface;

class PlatRepository implements PlatRepositoryInterface
{
    public function ajouterPlat( $data)
    {
        return Plat::create($data);
    }

    public function affichePlats()
    {
        return Plat::with('categorie')->get();
    }

    public function modifierPlat($id,$data)
    {
        $plat = Plat::find($id);
        if ($plat) {
            $plat->update($data);
            return $plat;
        }
        return null;
    }

    public function supprimerPlat($id)
    {
        $plat = Plat::find($id);
        if ($plat) {
            $plat->delete();
            return true;
        }
        return false;
    }

    public function changerDisponibilite($id, $disponible)
    {
        $plat = Plat::find($id);
        if ($plat) {
            $plat->disponible = $disponible;
            $plat->save();
            return $plat;
        }
        return null;
    }
}

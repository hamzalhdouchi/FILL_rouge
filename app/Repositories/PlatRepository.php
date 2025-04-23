<?php

namespace App\Repositories;

use App\Models\Plat;
use App\RepositoryInterfaces\PlatRepositoryInterface;

class PlatRepository implements PlatRepositoryInterface
{
    public function ajouterPlat($data)
    {
        if (isset($data['image'])) {
            $path = $data['image']->store('Plate', 'public');
            $data['image'] = str_replace('public/', '', $path);
        }
        $plat = Plat::create([
            'nom_plat' => $data['nom_plat'],
            'desciption' => $data['desciption'],
            'prix' => $data['prix'],
            'categorie_id' => $data['categorie_id'],
            'temps_Preparation' => $data['temps_Preparation'],
            'image' => $data['image'],
            'menu_id' => $data['menu_id'],
        ]);
    
        $plat->ingrediant()->attach($data['ingredients']); ;           
        
    
        return $plat;
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

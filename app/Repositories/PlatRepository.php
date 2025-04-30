<?php

namespace App\Repositories;

use App\Models\Plat;
use App\RepositoryInterfaces\PlatRepositoryInterface;

class PlatRepository implements PlatRepositoryInterface
{
    public function ajouterPlat($data)
    {
        if (isset($data['image'])) {
            $path = $data['image']->store('plate', 'public');
            
        }

        $plat = Plat::create([
            'nom_plat' => $data['nom_plat'],
            'desciption' => $data['desciption'],
            'prix' => $data['prix'],
            'categorie_id' => $data['categorie_id'],
            'temps_Preparation' => $data['temps_Preparation'],
            'image' => $path,
            'menu_id' => $data['menu_id'],
        ]);

        
    
        $plat->ingrediant()->attach($data['ingredients']); ;           
        
    
        return $plat;
    }
    

    public function affichePlats($id)
    {
        return Plat::where('menu_id',$id)->with('categorie')->paginate(10);
    }

    public function modifierPlat($id,  $data)
    {
        $plat = Plat::find($id);
        if (!$plat) {
            return null;
        }

        $plat->nom_plat = $data['nom_plat'] ?? $plat->nom_plat;
        $plat->desciption = $data['desciption'] ?? $plat->desciption;
        $plat->prix = $data['prix'] ?? $plat->prix;
        $plat->categorie_id = $data['categorie_id'] ?? $plat->categorie_id;
        $plat->temps_Preparation = $data['temps_Preparation'] ?? $plat->temps_Preparation;
        $plat->menu_id = $data['menu_id'] ?? $plat->menu_id;

        if (!empty($data['image'])) {
            $path = $data['image']->store('plate', 'public');
            $plat->image = $path;
        }
        $plate = $plat->save();

        return $plate;
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

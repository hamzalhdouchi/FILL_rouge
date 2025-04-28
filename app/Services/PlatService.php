<?php

namespace App\Services;

use App\RepositoryInterfaces\PlatRepositoryInterface;
use App\Services\Interfaces\PlatServiceInterface;

class PlatService implements PlatServiceInterface
{
    protected $platRepository;

    public function __construct(PlatRepositoryInterface $platRepository)
    {
        $this->platRepository = $platRepository;
    }

    public function ajouterPlat( $data)
    {
        $plat = $this->platRepository->ajouterPlat($data);
        if (!$plat) {
            return response()->json(['message' => 'Erreur lors de l ajout du plat'],500);
        }
        return response()->json(['message' => 'Plat ajouté avec succès!', 'data' => $plat] ,201);
    }

    public function affichePlats($id)
    {
        $plats = $this->platRepository->affichePlats($id);
        if (!$plats) {
            return response()->json(['message' => 'Aucun plat trouvé'],404);
        }
        return response()->json(['message' => 'Plats récupérés avec succès!', 'data' => $plats],200) ;
    }

    public function modifierPlat($id,array  $data)
    {
        $plat = $this->platRepository->modifierPlat($id, $data);
        if (!$plat) {
            return response()->json(['message' => 'Plat non trouvé'],404);
        }
        return response()->json(['message' => 'Plat modifié avec succès!', 'data' => $plat],201);
    }

    public function supprimerPlat($id)
    {
        $result = $this->platRepository->supprimerPlat($id);
        if (!$result) {
            return response()->json(['message' => 'Plat non trouvé'],404);
        }
        return response()->json(['message' => 'Plat supprimé avec succès!'],200);
    }

    public function changerDisponibilite($id, $disponible)
    {
        $plat = $this->platRepository->changerDisponibilite($id, $disponible);
        if (!$plat) {
            return response()->json(['message' => 'Plat non trouvé'],404);
        }
        return response()->json(['message' => 'Disponibilité mise à jour avec succès!', 'data' => $plat],200);
    }
}

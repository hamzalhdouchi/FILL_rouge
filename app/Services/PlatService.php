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

    public function ajouterPlat(array $data)
    {
        $plat = $this->platRepository->ajouterPlat($data);
        return $plat ? ['message' => 'Plat ajouté avec succès!', 'data' => $plat] : ['message' => 'Erreur lors de l\'ajout du plat'];
    }

    public function affichePlats()
    {
        $plats = $this->platRepository->affichePlats();
        return $plats ? ['message' => 'Plats récupérés avec succès!', 'data' => $plats] : ['message' => 'Aucun plat trouvé'];
    }

    public function modifierPlat($id, array $data)
    {
        $plat = $this->platRepository->modifierPlat($id, $data);
        return $plat ? ['message' => 'Plat modifié avec succès!', 'data' => $plat] : ['message' => 'Plat non trouvé'];
    }

    public function supprimerPlat($id)
    {
        $result = $this->platRepository->supprimerPlat($id);
        return $result ? ['message' => 'Plat supprimé avec succès!'] : ['message' => 'Plat non trouvé'];
    }

    public function changerDisponibilite($id, $disponible)
    {
        $plat = $this->platRepository->changerDisponibilite($id, $disponible);
        return $plat ? ['message' => 'Disponibilité mise à jour avec succès!', 'data' => $plat] : ['message' => 'Plat non trouvé'];
    }
}

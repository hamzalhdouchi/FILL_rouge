<?php

namespace App\Services;

use App\RepositoryInterfaces\CommandeRepositoryInterface;
use App\Models\Commande;
use App\Notifications\PaymentFactureNotification;
use App\Services\Interfaces\CommandeServiceInterface;
use Illuminate\Http\JsonResponse;

class CommandeService implements CommandeServiceInterface
{
    protected $commandeRepository;

    public function __construct(CommandeRepositoryInterface $commandeRepository)
    {
        $this->commandeRepository = $commandeRepository;
    }

    public function passerCommande($data)
    {
        $commande = $this->commandeRepository->create($data);
        
        return response()->json([
            'message' => 'Commande passée avec succès',
            'commande' => $commande
        ], 201);
    }

    public function annulerCommande($id)
    {
        $commande = $this->commandeRepository->changeStatus($id, 'annulee');

        return response()->json([
            'message' => 'Commande annulée avec succès',
            'commande' => $commande
        ]);
    }

    public function getCommandes()
    {
        $commandes = $this->commandeRepository->getAll();
        if (!$commandes) {
            return response()->json(['message'=> 'the commend is not found'],404);
        }

        return response()->json(['message'=> 'the commandes is found successfully','data' => $commandes],200);
    }

    public function evaluerService($id, $note)
    {
        $commande = $this->commandeRepository->getById($id);
        
        if (!$commande) {
            return response()->json(['message' => 'Commande non trouvée'], 404);
        }

        $commande->evaluation = $note;
        $commande->save();

        return response()->json([
            'message' => 'Évaluation enregistrée avec succès',
            'commande' => $commande
        ]);
    }

    public function calculerTotal($id)
    {
        $total = $this->commandeRepository->calculateTotal($id);

        if ($total === null) {
            return response()->json(['message' => 'Commande non trouvée'], 404);
        }

        return response()->json([
            'commande_id' => $id,
            'total' => $total
        ]);
    }

    public function calculerSousTotal($id)
    {
        $sousTotal = $this->commandeRepository->calculateSubTotal($id);

        if ($sousTotal === null) {
            return response()->json(['message' => 'Commande non trouvée'], 404);
        }

        return response()->json([
            'commande_id' => $id,
            'sous_total' => $sousTotal
        ]);
    }

    public function changerStatut($id, $statut)
    {
        $commande = $this->commandeRepository->changeStatus($id, $statut);

        if (!$commande) {
            return response()->json(['message' => 'Commande non trouvée'], 404);
        }

        return response()->json(['message' => 'Statut mis à jour avec succès','commande' => $commande]);
    }

    public function genererFacture($id)
    {
        $commande = $this->commandeRepository->getById($id);

        if (!$commande) {
            return response()->json(['message' => 'Commande non trouvée'], 404);
        }
        $client = $commande->client;
        $client->notify(new PaymentFactureNotification($commande));

        return response()->json(['message' => 'Facture générée et envoyée avec succès !']);
    }
}

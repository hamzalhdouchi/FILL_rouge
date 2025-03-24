<?php

namespace App\Services;

use App\RepositoryInterfaces\CommandeRepositoryInterface;
use App\Interfaces\CommandeServiceInterface;
use App\Models\Commande;
use App\Notifications\PaymentFactureNotification;

class CommandeService implements CommandeServiceInterface
{
    protected $commandeRepository;

    public function __construct(CommandeRepositoryInterface $commandeRepository)
    {
        $this->commandeRepository = $commandeRepository;
    }

    public function passerCommande(array $data)
    {
        return $this->commandeRepository->create($data);
    }

    public function annulerCommande($id)
    {
        return $this->commandeRepository->changeStatus($id, 'annulee');
    }

    public function evaluerService($id, $note)
    {
        $commande = $this->commandeRepository->getById($id);
        $commande->evaluation = $note;
        $commande->save();
        return $commande;
    }

    public function calculerTotal($id)
    {
        return $this->commandeRepository->calculateTotal($id);
    }

    public function calculerSousTotal($id)
    {
        return $this->commandeRepository->calculateSubTotal($id);
    }

    public function changerStatut($id, $statut)
    {
        return $this->commandeRepository->changeStatus($id, $statut);
    }

    public function genererFacture($id)
    {
        $commande = $this->commandeRepository->getById($id);
        
        
        $client = $commande->client;
        $client->notify(new PaymentFactureNotification($commande));

        return response()->json(['message' => 'Facture générée et envoyée avec succès !']);
    }
}

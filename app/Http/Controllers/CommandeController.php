<?php

namespace App\Http\Controllers;

use App\Http\Requests\commandeStoreRequest;
use App\Interfaces\CommandeServiceInterface;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    protected $commandeService;

    public function __construct(CommandeServiceInterface $commandeService)
    {
        $this->commandeService = $commandeService;
    }

    public function store(commandeStoreRequest $request)
    {
        $data = $request->all();
        $commande = $this->commandeService->passerCommande($data);
        return $commande;
    }

    public function annulerCommande($id)
    {
        $annulerCommande = $this->commandeService->annulerCommande($id);
        return $annulerCommande;
    }

    public function evaluerService(Request $request, $id)
    {
        $note = $request->note;
        $evaluerservice = $this->commandeService->evaluerService($id, $note);
        return $evaluerservice;
    }

    public function calculerTotal($id)
    {
        $calculerTotal = $this->commandeService->calculerTotal($id);
        return $calculerTotal;
    }

    public function calculerSousTotal($id)
    {
        $calculerSousTotal = $this->commandeService->calculerSousTotal($id);
        return $calculerSousTotal;
    }

    public function changerStatut(Request $request, $id)
    {
        $changeStetut = $this->commandeService->changerStatut($id, $request->statut);
        return $changeStetut;
    }

    public function genererFacture($id)
    {
        $facture = $this->commandeService->genererFacture($id);
        return $facture;
    }
}

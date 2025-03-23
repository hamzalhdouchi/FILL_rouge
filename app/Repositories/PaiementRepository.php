<?php

namespace App\Repositories;

use App\RepositoryInterfaces\PaiementRepositoryInterface;
use App\Models\Paiement;

class PaiementRepository implements PaiementRepositoryInterface
{
    public function create(array $data)
    {
        return Paiement::create($data);
    }

    public function getAll()
    {
        return Paiement::all();
    }
}

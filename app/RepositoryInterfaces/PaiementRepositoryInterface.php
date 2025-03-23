<?php

namespace App\RepositoryInterfaces;

interface PaiementRepositoryInterface
{
    public function create(array $data);
    public function getAll();
}

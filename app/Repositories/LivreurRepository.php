<?php
namespace App\Repositories;

use App\Repositories\Interfaces\LivreurRepositoryInterface;
use App\Models\Livreur;
use Illuminate\Support\Facades\Hash;

class LivreurRepository implements LivreurRepositoryInterface
{
    public function all()
    {
        return Livreur::all();
    }

    public function find($id)
    {
        return Livreur::findOrFail($id);
    }

    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $data['role_id'] = 2;
        
        return Livreur::create($data);
    }

    public function update($id, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        
        $livreur = $this->find($id);
        $livreur->update($data);
        
        return $livreur;
    }

    public function delete($id)
    {
        $livreur = $this->find($id);
        return $livreur->delete();
    }
}
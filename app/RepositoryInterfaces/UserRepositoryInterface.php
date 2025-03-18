<?php 

namespace App\RepositoryInterfaces;

interface UserRepositoryInterface
{
    public function create(array $data);
    public function find($id);
    public function update($id, array $data);
    public function delete($id);
    public function findByEmail($email);
}

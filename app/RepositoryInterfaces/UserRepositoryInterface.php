<?php 

namespace App\RepositoryInterfaces;

interface UserRepositoryInterface
{
    public function create( $data);
    public function find($id);
    public function update($id,  $data);
    public function delete($id);
    public function findByEmail($email);
    public function getAll();
    public function logout($request);

}

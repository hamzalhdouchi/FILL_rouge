<?php 

namespace App\Repositories;

use App\Models\User;
use App\RepositoryInterfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function create( $data)
    {
        return User::create($data);
    }

    public function getAll()
    {
        $users = User::with('Role')->paginate(6);
        return response()->json($users,200);
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function update($id,  $data)
    {
        $user = User::find($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = User::find($id);
        return $user ? $user->delete() : false;
    }

    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function logout($request)
    {
        $request->user()->currentAccessToken()->delete();

        return [
            'message' => 'Déconnexion réussie.'
        ];
    }
}

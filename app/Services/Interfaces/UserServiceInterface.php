<?php

namespace App\Services\Interfaces;

interface UserServiceInterface
{
    public function createUser($validatedData);
    public function updateProfile($request, $id);
    public function deleteUser($id);
    public function changeStatus($request, $id);
    public function sendResetLink($request);
    public function resetPassword($request);
    public function login($request);
    public function showProfile($id);
    public function gatAllUsers();
    public function logout($request);

}

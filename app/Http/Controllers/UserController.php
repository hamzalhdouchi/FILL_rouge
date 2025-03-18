<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreResquest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\ResetpasswordRequest;
use App\ServiceInterfaces\UserServiceInterface;
//use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(\App\Services\Interfaces\UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function store(UserStoreResquest $request)
    {
        $validatedData = $request->validated();
        $utilisateur = $this->userService->createUser($validatedData);

        return response()->json($utilisateur, 201);
    }

    public function updateProfile(UpdateProfileRequest $request, $id)
    {
        $response = $this->userService->updateProfile($request, $id);
        return $response;
    }

    public function destroy($id)
    {
        $response = $this->userService->deleteUser($id);
        return $response;
    }

    public function changeStatus(Request $request, $id)
    {
        $response = $this->userService->changeStatus($request, $id);
        return $response;
    }

    public function sendResetLink(Request $request)
    {
        $response = $this->userService->sendResetLink($request);
        return $response;
    }

    public function resetPassword(ResetpasswordRequest $request)
    {
        $response = $this->userService->resetPassword($request);
        return $response;
    }
}

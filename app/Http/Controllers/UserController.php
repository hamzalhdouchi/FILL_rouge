<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use App\Http\Requests\sendResetLink;
use App\Http\Requests\UserStoreResquest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\ResetpasswordRequest;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $restaurant = $this->userService->gatAllUsers();
        return $restaurant;
    }

    public function register(UserStoreResquest $request)
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

    public function login(loginRequest $request)
    {
        return response()->json($this->userService->login($request->all()));
    }
    public function destroy($id)
    {
        $response = $this->userService->deleteUser($id);
        return $response;
    }

    public function showProfile($id)
    {
        $response = $this->userService->showProfile($id);
        return $response;
    }

    public function changeStatus(Request $request, $id)
    {
        $response = $this->userService->changeStatus($request, $id);
        return $response;
    }

    public function sendResetLink(sendResetLink $request)
    {
        $response = $this->userService->sendResetLink($request);
        return $response;
    }

    public function resetPassword(ResetpasswordRequest $request)
    {
        $response = $this->userService->resetPassword($request);
        return $response;
    }

    public function logout(Request $request)
    {
        $result = $this->userService->logout($request);
        return response()->json($result);
    }
}

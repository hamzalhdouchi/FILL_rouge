<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationResquest;
use App\Http\Requests\ResetpasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UserStoreResquest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreResquest $request)
    {
        $validatedData = $request->validated();
        $utilisateur = User::create($validatedData);

        $token = $utilisateur->createToken('User')->plainTextToken;

        return response()->json($utilisateur, 201);
    }

    /**
     * Display the specified resource.
     */
    public function showProfile($id)
    {
        $user = User::findOrFail($id);

        return response()->json([
            'message' => 'Profile fetched successfully.',
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateProfile(UpdateProfileRequest $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
    
        $validate = $request->validated();
    
        if ($request->has('last_password')) {
            if (!Hash::check($request->last_password, $user->password)) {
                return response()->json(['message' => 'The current password is incorrect.'], 400);
            }
    
            if ($request->has('new_password')) {
                if (Hash::check($request->new_password, $user->password)) {
                    return response()->json(['message' => 'New password cannot be the same as the current password.'], 400);
                }
                $user->password = Hash::make($request->new_password);
            }
        }
    
        $user->save();
    
        return response()->json([
            'message' => 'Profile updated successfully.',
            'user' => $user
        ]);
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $utilisateur = User::findOrFail($id);

        $utilisateur->delete();
    
        return response()->json([
            'message' => 'Compte utilisateur supprimé avec succès'
        ], 200);
    }

    public function changeStatus(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:actif,inactif',
        ]);

        $utilisateur = User::findOrFail($id);

        $utilisateur->statut = $request->statut;
        $utilisateur->save();

        return response()->json([
            'message' => 'Statut mis à jour avec succès',
            'utilisateur' => $utilisateur
        ], 200);
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);
        $token = Str::random(60);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['token' => Hash::make($token), 'created_at' => Carbon::now()]
        );
        $resetLink = url("/api/reset-password?token={$token}&email={$request->email}");

        Mail::raw("Click the link to reset your password: $resetLink", function ($message) use ($request) {
            $message->to($request->email)->subject('Password Reset Link');
        });
        return response()->json(['message' => 'Password reset link sent to your email.']);
    }

    public function resetPassword(ResetpasswordRequest $request)
    {
        $request->validated($request);

        $resetRecord = DB::table('password_resets')->where('email', $request->email)->first();
        if (!$resetRecord || !Hash::check($request->token, $resetRecord->token)) {
            return response()->json(['message' => 'Invalid or expired token.'], 400);
        }
        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
        ]);
        DB::table('password_resets')->where('email', $request->email)->delete();
        return response()->json(['message' => 'Password has been reset successfully.']);
    }
}

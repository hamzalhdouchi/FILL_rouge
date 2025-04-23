<?php 

namespace App\Services;

use App\Http\Requests\UserStoreResquest;
use App\Models\Restaurant;
use App\RepositoryInterfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function gatAllUsers()
    {
        $Users = $this->userRepository->getAll();
        return $Users;
    }

    public function createUser($validatedData): mixed
    {
        return $this->userRepository->create($validatedData);
    }

    public function updateProfile($request, $id)
    {
        $user = $this->userRepository->find($id);

        if ($request->has('last_password') && !Hash::check($request->last_password, $user->password)) {
            return response()->json(['message' => 'The current password is incorrect.'], 400);
        }

        if ($request->has('new_password')) {
            if (Hash::check($request->new_password, $user->password)) {
                return response()->json(['message' => 'New password cannot be the same as the current password.'], 400);
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return response()->json(['message' => 'Profile updated successfully.', 'user' => $user]);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }

    public function changeStatus($request, $id)
    {
        
        $user = $this->userRepository->find($id);
        $user->statut = $request->statut;
        $user->save();

        return response()->json(['message' => 'Status updated successfully', 'user' => $user]);
    }

    public function sendResetLink($request)
    {
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

    public function resetPassword($request)
    {
        $resetRecord = DB::table('password_resets')->where('email', $request->email)->first();
        if (!$resetRecord || !Hash::check($request->token, $resetRecord->token)) {
            return response()->json(['message' => 'Invalid or expired token.'], 400);
        }

        User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where('email', $request->email)->delete();

        return response()->json(['message' => 'Password has been reset successfully.']);
    }

    public function login($data)
    {

    
        
        $user = $this->userRepository->findByEmail($data['email']);
     

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return abort(500, 'Invalid login attempt');;
        }
    
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'message' => 'Login successful',
             'token' => $token,
            'user' => $user
        ];
    }

    public function showProfile($id)
    {
        $user = $this->userRepository->find($id);

        if (!$user) {
            return response()->json([
                'message' => 'the profile is not found',
            ],404);
        }

        return response()->json(['message' => 'profile is found successfully','user' => $user],200);
    }

    public function logout($request)
    {
        return $this->userRepository->logout($request);
    }

}

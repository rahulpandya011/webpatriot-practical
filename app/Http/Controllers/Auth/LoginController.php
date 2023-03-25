<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Http\Requests\Auth\{
    LoginRequest,
    RegisterRequest
};

use App\Models\{
    User,
    UserHobbies
};

use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\{
    Auth,
    Hash
};

class LoginController extends Controller
{
    public function login(Request $request)
    {
        return view('auth.login');
    }

    public function checkLogin(LoginRequest $request)
    {
        try {
            $validated = $request->validated();
            $user = User::where('username', '=', $validated['username'])->first();

            if (empty($user)) {
                return redirect('/')->with('error', "User Not Found");
            }
            if (!Hash::check($validated['password'], $user->password)) {
                return redirect('/')->with('error', "Wrong Password");
            }
            Auth::login($user);
            return redirect(route('user.dashboard'));
        } catch (Exception $e) {
            return redirect('/')->with('error', $e->getMessage());
        }
    }

    public function register(Request $request)
    {
        return view('auth.register');
    }

    public function registerPost(RegisterRequest $request)
    {
        try {
            $validated = $request->validated();
            $validated['password'] = Hash::make($validated['password']);
            $validated['username'] = substr($validated['first_name'], 0, 2) . substr($validated['last_name'], 0, 2) . rand(1000, 9999);

            $profilePic = $validated['profile_pic'];
            $validated['profile_pic'] = '';

            $hobbies = $validated['hobbies'];
            unset($validated['hobbies']);



            $user = User::create($validated);
            if ($user) {
                foreach ($hobbies as $key => $val) {
                    $userH = new UserHobbies();
                    $userH->user_id = $user->user_id;
                    $userH->hobby_id = $val;
                    $userH->save();
                }
                $file = $request->file('profile_pic');
                $name = time() . $file->getClientOriginalName();
                $destinationPath = 'uploads/user_profile';
                $file->move($destinationPath, $name);

                $user->profile_pic = $name;
                $user->save();

                return redirect('/')->with('success', "Register Successfully");
            } else {
                return redirect(route('auth.register'))->with('error', "User not creating some issue occures");
            }
        } catch (Exception $e) {
            return redirect(route('auth.register'))->with('error', $e->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', "Logout Successfully");
    }
}

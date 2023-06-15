<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Events\UserLogin;
use App\Http\Requests\Info;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Requests\Signup;
use App\Http\Requests\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    /**
     * View Login
     */
    public function index()
    {
        return view('user.login');
    }

    /**
     * Login Method
     */
    public function login(Request $request)
    {


        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            
            $request->session()->regenerate();
            event( new UserLogin(auth()->user()));        

            return redirect('/')->with('success','You Are Login Now');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    /**
     * Logout Method
     */

    public function logout(Request $request)
    {

        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/auth/login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.signup');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function signup(Signup $request)
    {

        $data = $request->validated();
        
        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return redirect('/')->with('success','Signup Successfully');
    }


    /**
     * Display the specified resource.
     */
    public function profile()
    {

        $profile = UserProfile::where('profileable_id',auth()->user()->id);
        $profile = $profile ? $profile->get()[0] : null;

        return view('user.profile',[
            'profile' => $profile
        ]);
    }

    /**
     * Show the form for view editing the specified resource.
     */
    public function info()
    {

        $user = User::find(auth()->user()->id);
        $profile = UserProfile::where('profileable_id',auth()->user()->id)->get();
        $info = $profile ? $profile[0] : null;

        return view('user.info-user',[
            'user' => $user,
            'info' => $info
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function infoUpdate(string $id,Request $request)
    {

        $user = User::findOrFail($id);
        $profile = UserProfile::where('profileable_id',$id);

        $data = $request->validate([          
            'username' => ['required'],
            'email' => ['required'],
            'privilege' => ['required'],
            'mobile' => ['required'],
        ]);

        $updateUser = $request->only(['privilege']);
        $updateProfile = $request->only(['mobile']);


        $user->update($updateUser);
        $profile->update($updateProfile);

        return redirect('/user/profile')->with('success','Info Has Been Updated');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Profile $request, string $id)
    {
        $data = $request->validated();

        $update = UserProfile::where('profileable_id',auth()->user()->id);
        $getData = $update ? $update->get()[0] : null;
        
        if($request->hasFile('picture') && !empty($request->picture)){
        
            if(is_null($getData)) {
                UserProfile::create([
                    'mobile' => '123123',
                    'picture' => 'test',
                    'profileable_type' => User::class,
                    'profileable_id' => auth()->user()->id,
                ]);
            }

            if(!is_null($getData->picture)) {
                Storage::delete($getData->picture);
            }

            $data['picture'] = $request->file('picture')->store('profile');
        }

        $update->update($data);
        
        return to_route('profile.view');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

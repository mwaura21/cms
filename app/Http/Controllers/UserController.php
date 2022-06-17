<?php

namespace App\Http\Controllers;

use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //taken to index if logged in, login page if not
    public function index()
    {
        return view('admin.login');
    }
 
    //validate form items, check if they exist in db then log in if they exist 
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return redirect()->intended(route('dashboard'))->with('message', 'Successfully Logged In');
        }
        
        return redirect()->route('index')->withErrors([
            'email' => 'The provided credentials do not match our records',
            'password' => 'The provided credentials do not match our records.'
        ]);
    }

    //taken to dashboard if logged in, taken to login page if not
    public function dashboard()
    {
        if(Auth::check)
        {
            return view('admin.index');
        }
        
        return redirect()->route('index')->with('error-message', 'You cannot to access this page');
    }

    public function logout()
    {
        Session::flush;
        Auth::logout;

        return redirect()->route('index')->with('message', 'Successfully Logged out');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}

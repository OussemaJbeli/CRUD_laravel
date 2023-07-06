<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index():View
    {
        return view('login');
    }   
    public function login_crud(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('name', $request->name)
            ->first();
        //IF name
        if ($user) {
            //password true
            if (Hash::check($request->password, $user->password)) {
                if (Auth::attempt($credentials)) {
                    $request->session()->regenerate();
                    return redirect()->route('products.index');
                }
            } 
            else{
                return back()->withErrors([
                        'password' => 'password incorrect',
                    ])->onlyInput('password');
            }
        }
        else{
            return back()->withErrors([
                    'name' => 'username not found ',
                ])->onlyInput('name');
        }
    }

    public function logout_crud(){
        Auth::logout();

        return redirect()->route('admin.index');
    }

    public function create(): View
    {
        return view('create_new');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        User::create($request->all());
        return redirect()->route('admin.index')->with('success','Product created successfully.');;
    }

}

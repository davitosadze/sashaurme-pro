<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $req) {

        if($req->session()->has('admin_user')){
            return redirect('/back/dashboard');
        } 
        else {
            return view('admin.login');
        }
        
    }

    public function auth(Request $req) {
        $user = User::where('email', $req->email)->first();
        if($req->password == $user->password) {
            if($user->is_admin) {
                $req->session()->put('admin_user', $req->email);
                return redirect('/back/dashboard');
            }
            else {
                return redirect('/back');
            }
        }
        else {
            return redirect('/back');
        }
        
    }

    public function logout(Request $req) {
        $req->session()->forget('admin_user');

        return redirect('/back');
    }}

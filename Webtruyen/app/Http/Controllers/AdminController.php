<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RequestLogin;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\Author;
use App\Models\Story;
use App\Models\Category;
use App\Models\Genre;

class AdminController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return redirect('dashboard');
        }else{
            return view('login');
        }
    }
    public function login(RequestLogin $request)
    {
        
        $remember = $request->has('remember_me') ? true : false;
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember))
        {
            return redirect('dashboard');
        }
        else
        {
            return redirect('/admin')->with('message', 'Tài khoản hoặc mật khẩu không đúng!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return view('login');
    }
    public function dashboard(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $roles = $user->roles;
        $story_view = Story::orderBy('view','DESC')->take(20)->get();
        $total_category = Category::all()->count();
        $total_genre = Genre::all()->count();
        $total_author = Author::all()->count();
        $total_story = Story::all()->count();
        return view('dashboard', compact('user', 'roles', 'total_category', 'total_genre', 'total_author', 'total_story','story_view'));

    }
    public function error()
    {
        return view('error-404');
    }
}

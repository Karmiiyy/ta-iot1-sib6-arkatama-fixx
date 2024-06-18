<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    function index()
    {
        $data['title'] = 'User';
        $data['breadcrumbs'][] = [
            'title' => 'Dashboard',
            'url' => route('dashboard')
        ];
       
        $data['breadcrumbs'][] = [
            'title' => 'User',
            'url' => 'users.index'
        ];
        $users = User::orderBy('name')->get();
        $data['users'] = $users;
        
        return view('pages.user.index', $data);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AccountUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $query->where('username', 'like', '%' . $request->search . '%');
        }

        $users = $query->orderBy('id', 'asc')->get();

        return view('admin.user.index', compact('users'));
    }
}

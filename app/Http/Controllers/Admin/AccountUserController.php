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
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
        ]);

        $user->update($request->only(['name', 'email', 'phone']));

        return redirect()->route('user.index')->with('success', 'Data berhasil diupdate.');
    }
    
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Data berhasil dihapus.');
    }

}

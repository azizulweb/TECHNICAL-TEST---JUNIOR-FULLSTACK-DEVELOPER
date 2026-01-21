<?php

//Controller bertugas menangani request API terkait produk
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

/**
 * UserController
 * Mengatur manajemen user dan hak akses (role)
 */

class UserController extends Controller
{
     /**
     * GET /api/users
     * Menampilkan user beserta role-nya
     */
    
    public function index()
    {
        return User::with('role')->get()->map(function ($user) {
            return [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'role'  => $user->role ? $user->role->name : null,
            ];
        });
    }

    /**
     * PUT /api/users/{id}/change-role
     * Mengubah role user
     */

    public function changeRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:Admin,Seller,Customer'
        ]);

        $role = Role::where('name', $request->role)->firstOrFail();

        $user = User::findOrFail($id);
        $user->role_id = $role->id;
        $user->save();

        return response()->json([
            'message' => 'Role berhasil diubah'
        ]);
    }
}

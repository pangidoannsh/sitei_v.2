<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return view('role.index', [
            'roles' => Role::all(),
        ]);
    }

    public function create()
    {
        return view('role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_akses' => ['required', 'unique:role'],
        ]);

        Role::create([
            'role_akses' => $request->role_akses,
        ]);
        return redirect('/role')->with('message', 'Data Berhasil Ditambahkan!');
    }

    public function edit(Role $role)
    {
        return view('role.edit', [
            'role' => $role,
        ]);
    }

    public function update(Request $request, Role $role)
    {
        if ($request->role_akses != $role->role_akses) {
            $validated = $request->validate([
                'role_akses' => ['required', 'unique:role'],
            ]);

            Role::where('id', $role->id)
                ->update($validated);

            return redirect('/role')->with('message', 'Data Berhasil Diubah!');
        } else {
            return redirect('/role')->with('message', 'Data Berhasil Diubah!');
        }
    }

    public function destroy(Role $role)
    {
        Role::destroy($role->id);
        return redirect('/role')->with('message', 'Data Berhasil Dihapus!');
    }
}

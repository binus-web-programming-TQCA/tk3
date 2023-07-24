<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class StaffController extends Controller
{
    public function index()
{
    $users = User::all();
    return view('staffs.index', compact('users'));
}

public function create()
{
    return view('staffs.create');
}

public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required',
        'username' => 'required',
        'password' => 'required|min:6|confirmed',
        'jenis_kelamin' => 'required',
    ]);

    $data['password'] = Hash::make($request->password);
    $data['role'] = 'staff';
    // dd($data);
    // dd($request->all());
    User::create($data);

    return redirect()->route('staffs.index')->with('success', 'Data staff berhasil ditambahkan.');
}

public function edit(User $staff)
{
    return view('staffs.edit', compact('staff'));
}

public function update(Request $request, User $user)
{
    $data = $request->validate([
        'nama' => 'required',
        'jenis_kelamin' => 'required',
        'username' => 'required|unique',
        'password' => 'nullable|min:6|confirmed',
    ]);

    if ($request->password) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    return redirect()->route('staffs.index')->with('success', 'Data staff berhasil diperbarui.');
}

public function destroy(User $user)
{
    $user->delete();

    return redirect()->route('staffs.index')->with('success', 'Data staff berhasil dihapus.');
}
}

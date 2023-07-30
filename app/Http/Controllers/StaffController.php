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

    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('staffs.edit' , compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'jenis_kelamin' => 'required',
            'username' => 'required',
            'password' => 'nullable|min:6|confirmed',
        ]);
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        User::where('id',$id)->update($data);

        return redirect()->route('staffs.index')->with('success', 'Data staff berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->where('id',$user->id)->delete();

        return redirect()->route('staffs.index')->with('success', 'Data staff berhasil dihapus.');
    }
}

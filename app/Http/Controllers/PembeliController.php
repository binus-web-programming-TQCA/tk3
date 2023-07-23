<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class PembeliController extends Controller
{
    public function list()
    {
        $data = Pembeli::all();
        return view('pembeli.list', ['data' => $data]);
    }

    public function add() {
        return view('pembeli.add');
    }

    public function view($id)
    {
        $data = Pembeli::find($id);
        return view('pembeli.view', ['data' => $data]);
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'user' => ['required', 'string', 'max:255', 'unique:'.Pembeli::class],
            'tempat_lahir' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'string'],
            'jenis_kelamin' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $data = new Pembeli();
        $data->nama = $request->input('nama');
        $data->tempat_lahir = $request->input('tempat_lahir');
        $data->tanggal_lahir = $request->input('tanggal_lahir');
        $data->jenis_kelamin = $request->input('jenis_kelamin');
        $data->alamat = $request->input('alamat');
        $data->user = $request->input('user');
        $data->foto_ktp = "";
        $data->password = Hash::make($request->input('password'));
        $data->save();
        return redirect()->route('pembeli.list');
    }

    public function delete($id) {
        $data = Pembeli::findOrFail($id);
        $data->delete();
        return redirect()->route('pembeli.list');
    }
}

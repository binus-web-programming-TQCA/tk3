<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\DataBarang;
use Illuminate\Http\Request;

class DataBarangController extends Controller
{
    public function index()
    {
        $users = DataBarang::all();
        return view('barang.index', compact('users'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_barang' => 'required',
            'deskripsi' => 'required',
            'jenis_barang' => 'required',
            'stock_barang' => 'required|integer|min:0',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'gambar_barang' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('gambar_barang')) {
            $gambarBarang = $request->file('gambar_barang')->store('public/gambar_barang');
            $data['gambar_barang'] = $gambarBarang;
        }
        // dd($data);
        DataBarang::create($data);

        return redirect()->route('barang.index')->with('success', 'Data staff berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = DataBarang::findOrFail($id);
        return view('barang.edit' , compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama_barang' => 'required',
            'deskripsi' => 'required',
            'jenis_barang' => 'required',
            'stock_barang' => 'required|integer|min:0',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'gambar_barang' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('gambar_barang')) {
            $gambarBarang = $request->file('gambar_barang')->store('public/gambar_barang');
            $data['gambar_barang'] = $gambarBarang;
        }
        DataBarang::where('id',$id)->update($data);

        return redirect()->route('barang.index')->with('success', 'Data staff berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = DataBarang::findOrFail($id);
        $user->where('id',$user->id)->delete();

        return redirect()->route('barang.index')->with('success', 'Data staff berhasil dihapus.');
    }
}

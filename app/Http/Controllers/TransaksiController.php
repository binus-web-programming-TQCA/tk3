<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\DataBarang;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DataBarang::all();
        return view('transaksi.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $id)
    {
        Transaksi::create([
            'id_user' => $request->user()->id,
            'id_barang' => $id,
            'status' => false,
        ]);
        //todo show notif
        return redirect()->back()->with('success', 'Data staff berhasil ditambahkan.');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function list_order()
    {
        // Transaksi::all();
        $transaksi = DB::table('transaksis')
            ->join('users', 'transaksis.id_user', '=', 'users.id')
            ->join('data_barang', 'transaksis.id_barang', '=', 'data_barang.id')
            ->select('users.name as user_name','data_barang.*','transaksis.id as transaksi_id','transaksis.status')->get();
        
    
        // return $transaksi;
        return view('transaksi.list-transaksi', compact('transaksi'));

    }

    public function submit(Request $request, $id)
    {

        
        Transaksi::where('id',$id)->update([
            'status'=>true
        ]);
        $idtransaksi = Transaksi::findOrFail($id);
        $user = DataBarang::findOrFail($idtransaksi->id_barang);
        DataBarang::where('id',$idtransaksi->id_barang)->update([
            'stock_barang'=> $user->stock_barang - 1 
        ]);
        return redirect()->back()->with('success', 'Barang berhasil DiApprove.');

    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}

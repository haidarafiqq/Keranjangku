<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book = Keranjang::all();
        return $book;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data+=['id_user'=>auth()->user()->id];
        $data = $request->all();
        $data+=['id_user'=>auth()->user()->id];
        $harga = DB::table('products')->select('harga')->where('id', $data['id_produk'])->first();
        // $diskon = DB::table('diskons')->select('jumlah_diskon')->where('id', $data['diskon_id'])->first();
        // $diskon = (int)$harga->harga * (int)$diskon->jumlah_diskon / 100;
        $total_harga =  (int)$harga->harga * (int)$data['jumlah_barang'];

        $data += [
            'total_harga' => $total_harga
        ];
        $store = Keranjang::create($data);
        return $store;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Keranjang $keranjang)
    {
        // return $keranjang->produk;
        $data = $request->all();
        if ($request->jumlah_barang) {
            $data += [
                'total_harga' => (int)$keranjang->produk->harga * (int)$request->jumlah_barang
            ];
        }
        $update = Keranjang::where("id", $keranjang->id)->update($data);
        return $update;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Keranjang::destroy($id);
        return $destroy;
    }
}

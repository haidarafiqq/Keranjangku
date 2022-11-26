<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book = Order::all();
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
        $harga = DB::table('products')->select('harga')->where('id', $data['id_produk'])->first();
        $diskon = DB::table('diskons')->select('jumlah_diskon')->where('id', $data['diskon_id'])->first();
        $diskon = (int)$harga->harga * (int)$diskon->jumlah_diskon / 100;
        $total_harga =  (int)$harga->harga * (int)$data['jumlah_product'] - $diskon;

        $data += [
            'total_harga' => $total_harga
        ];
        $store = Order::create($data);
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
    public function update(Request $request, $id)
    {
        $update = Order::where("id", $id)->update($request->all());
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
        $destroy = Order::destroy($id);
        return $destroy;
    }
}

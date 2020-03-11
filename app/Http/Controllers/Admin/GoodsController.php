<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\GoodsRequest;
use App\Model\goods;
use App\Model\Genre;

class GoodsController extends MasterController
{

    /**
     * Display a listing of the resource.
     * get
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goods = Goods::all();
        $genres = Genre::all();
        $data=[$goods,$genres];

        return view('admin.goods.goods',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * get
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * post
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GoodsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * get
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * get
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * put patch
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * delete
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

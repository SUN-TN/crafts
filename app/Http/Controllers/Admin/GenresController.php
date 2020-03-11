<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\GenresRequest;
use App\Model\Genre;

class GenresController extends MasterController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Genre::all();
        return view('admin.goods.genres', compact('data'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(GenresRequest $request, Genre $model)
    {
        $genre = $model->create($request->all());
        return response()->json([
            'status_code' => 200,
            'message' => '添加成功',
            'newGenre' => $genre,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(GenresRequest $request,$id)
    {

        Genre::where('id',$request['id'])
            ->update(['genre' => $request['genre']]);
        return response()->json([
            'status_code' => 200,
            'message' => '修改成功',
            'genre' => $request['genre'],
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Genre::destroy($id);
        return response()->json(['message' => '删除成功']);
    }
}

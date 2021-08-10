<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class iCrawlerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    function index()
    {
        $index_site = DB::select('select * from TB_CFG_INDEX');

        return compact('index_site');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(Request $request)
    {
        $siteid = $request->input('siteid');
        die($siteid);
        return response()->json(['name' => 'show', 'id' => $siteid]);
//        $siteid = $request->old('siteid');
//        die($siteid);
//        $data = DB::table('TB_CFG_INDEX')
//            ->select('*')
//            ->where('site_id', $siteid)
//            ->get();

        return compact('data');
    }

    public function search(Request $request)
    {
        $siteid = $request->input('siteid');
        die($siteid);
//        $data = DB::table('TB_CFG_INDEX')
//            ->select('*')
//            ->where('site_id', $siteid)
//            ->get();
//
//        return compact('data');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MonitorController extends Controller
{
    function showIndex(Request $request){
        if ($request->ajax()) {
            $data = DB::table('TB_CFG_INDEX')
            ->select('*')
            ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Action</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('home');
    }

    function crawler(Request $request){

        return view('crawler.crawler');
    }
}

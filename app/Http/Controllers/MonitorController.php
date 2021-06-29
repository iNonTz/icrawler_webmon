<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MonitorController extends Controller
{
    function showIndex(Request $request){
//        $index_site = DB::select('select * from TB_CFG_INDEX order by SITE_ID desc')->paginate(15);
//        $index_site = DB::table('TB_CFG_INDEX')
//            ->select('*')
//            ->orderBy('SITE_ID')
//            ->get();
        if ($request->ajax()) {
            $data = DB::table('TB_CFG_INDEX')
            ->select('*');
            return Datatables::of($data)
                ->make(true);
        }
        return view('home');
//        return ['index_site' => $index_site];
    }
}

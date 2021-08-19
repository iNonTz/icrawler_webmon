<?php

namespace App\Http\Controllers;

use App\Models\Post;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Yajra\DataTables\Facades\DataTables;

class MonitorController extends Controller
{
    function showIndex(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('TB_CFG_INDEX')
                ->select('*')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Action</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('home');
    }

    function crawler(Request $request)
    {

        $request->flash();

        return view('crawler.crawler');
    }

    function searchSiteID(Request $request){

        $requestAjax = $request->all();
        $siteid = $requestAjax['siteid'];
//        $siteid = $request->input('siteid');

        $data = DB::table('TB_CFG_SITE')
            ->select('*')
            ->where('site_id', $siteid)
            ->get();

        $IndexUrl = DB::table('TB_CFG_INDEX')
            ->select('*')
            ->where('site_id', $siteid)
            ->get();
        $count = $IndexUrl->count();

        return response()->json([$data, $IndexUrl, $count]);
    }

    function crawlIndex(Request $request){

        $requestAjax = $request->all();
        $qid = $requestAjax['qid'];
        $siteid = $requestAjax['siteid'];
        $url = $requestAjax['url'];
        $type = $requestAjax['type'];
        $allow_domain = $requestAjax['allow_domains'];
        $deny_domain = $requestAjax['deny_domains'];
        $allow_regex = $requestAjax['allow'];
        $deny_regex = $requestAjax['deny'];
        $js_render = $requestAjax['js_render'];
        $misc = $requestAjax['misc'];
        $mapping = $requestAjax['mapping'];
        $client = new Client();
        $qitem = [
            'qid' => $qid,
            'type' => $type,
            'url' => $url ?: '',
            'allow' => $allow_regex ?: [],
            'deny' => $deny_regex ?: [],
            'allow_domains' => $allow_domain ?: [],
            'deny_domains' => $deny_domain ?: [],
            'js_render' => $js_render ?: False,
            'siteid' => $siteid,
            'misc' => $misc ?: '',
            'mapping' => $mapping ?: ''
        ];
        $res = $client->request('POST', 'http://127.0.0.1:8081/linkXtract', [
            'json' => $qitem
        ]);
        $IndexUrl = json_decode($res->getBody(), true);
        return response()->json($IndexUrl);
    }

    function crawlStory(Request $request){

        $siteid = $request->input('SITE_ID');
        $requestAjax = $request->all();
        $url = $requestAjax['url'];
        $js_render = $requestAjax['js_render_story'];
        $roadrunner = $requestAjax['roadrunner'];
        $misc = $request->input('misc');
        $mapping = $request->input('mapping');
        $client = new Client();
        $qitem = [
            'qid' => '1',
            'type' => 'story',
            'url' => $url ?: '',
            'js_render' => $js_render ?: False,
            'siteid' => $siteid,
            'misc' => $misc ?: '',
            'srcid'=> '',
        ];
        if ($roadrunner == 1){
            $res = $client->request('POST', 'http://127.0.0.1:8081/roadRunnerXtract', [
                'json' => $qitem
            ]);
        } else {
            $res = $client->request('POST', 'http://127.0.0.1:8081/storyXtract', [
                'json' => $qitem
            ]);
        }

        $Story = json_decode($res->getBody(), true);
        return response()->json($Story);
    }

    function redis(Request $request){

        $redis = Redis::get('*');
        dd($redis);

        return view('crawler.redis', compact('posts'));
    }
}

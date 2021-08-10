<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    function crawlerTools(Request $request)
    {
        $request->flash();
        if ($request->submit == "crawlStory"){

            $siteid = $request->input('SITE_ID');
            $url = $request->input('urlstory');
            $js_render = $request->input('js_render');
            $misc = $request->input('misc');
            $mapping = $request->input('mapping');
            $client = new Client();
            $qitem = [
                'qid' => '1',
                'type' => 'story',
                'url' => $url ?: '',
                'js_render' => $js_render ?: '',
                'siteid' => $siteid,
                'misc' => $misc ?: '',
                'srcid'=> '',
            ];
            $res = $client->request('POST', 'http://127.0.0.1:8081/storyXtract', [
                'json' => $qitem
            ]);
            $Story = json_decode($res->getBody(), true);
            $IndexUrl = DB::table('TB_CFG_INDEX')
                ->select('*')
                ->where('site_id', $siteid)
                ->get();
            $count = $IndexUrl->count();

            return view('crawler.crawler', compact('Story', 'IndexUrl'));
        }

        if ($request->submit == "search-site") {
            $siteid = $request->input('siteid');
            $data = DB::table('TB_CFG_SITE')
                ->select('*')
                ->where('site_id', $siteid)
                ->get();

            $IndexUrl = DB::table('TB_CFG_INDEX')
                ->select('*')
                ->where('site_id', $siteid)
                ->get();
            $count = $IndexUrl->count();


            return view('crawler.crawler', compact('data', 'IndexUrl', 'count'));
        }
        if ($request->submit == "crawlIndex") {

            $siteid = $request->input('SITE_ID');
            $url = $request->input('url');
            $type = $request->input('type');
            $allow_domain = $request->input('allow_domain');
            $deny_domain = $request->input('deny_domain');
            $allow_regex = $request->input('allow_regex');
            $deny_regex = $request->input('deny_regex');
            $js_render = $request->input('js_render');
            $misc = $request->input('misc');
            $mapping = $request->input('mapping');
            $client = new Client();
            $qitem = [
                'qid' => '1',
                'type' => $type,
                'url' => $url ?: '',
                'allow' => $allow_regex ?: '',
                'deny' => $deny_regex ?: '',
                'allow_domains' => $allow_domain ?: '',
                'deny_domains' => $deny_domain ?: '',
                'js_render' => $js_render ?: '',
                'siteid' => $siteid,
                'misc' => $misc ?: '',
                'mapping' => $mapping ?: ''
            ];
            $res = $client->request('POST', 'http://127.0.0.1:8081/linkXtract', [
                'json' => $qitem
            ]);
            $urlStory = json_decode($res->getBody(), true);

            $IndexUrl = DB::table('TB_CFG_INDEX')
                ->select('*')
                ->where('site_id', $siteid)
                ->get();
            $count = $IndexUrl->count();

            return view('crawler.crawler', compact('urlStory', 'IndexUrl'));
        }
    }

    function crawlStory(Request $request)
    {

        $url = $request->input('url');
        $allow_domain = $request->input('allow_domain');
        $deny_domain = $request->input('deny_domain');
        $allow_regex = $request->input('allow_regex');
        $deny_regex = $request->input('deny_regex');
        $js_render = $request->input('js_render');
        $misc = $request->input('misc');
        $mapping = $request->input('mapping');
        $client = new Client();
        $data = [
            'qid' => '1',
            'type' => 'index',
            'url' => $url ?: '',
            'allow' => $allow_regex ?: '',
            'deny' => $deny_regex ?: '',
            'allow_domains' => $allow_domain ?: '',
            'deny_domains' => $deny_domain ?: '',
            'js_render' => $js_render ?: '',
            'siteid' => '5',
            'misc' => $misc ?: '',
            'mapping' => $mapping ?: ''
        ];
        $res = $client->request('POST', 'http://127.0.0.1:8081/storyXtract', [
            'json' => $data
        ]);
        $urlStory = $res->getBody();
        return view('crawler.crawler', compact('urlStory'));
    }
}

@extends('layouts.master')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
@section('title', 'Crawler')
@section('navbar')
    @parent
@stop
@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Crawl Info</h5>
                    <form action="{{ route("crawl-tools") }}" method="get">
                        <div class="input-group mb-3">
                            @if (empty($data))
                                <input type="text" class="form-control"
                                       aria-label="SiteID"
                                       aria-describedby="button-addon2" id="siteid" name="siteid"
                                       @if (empty($IndexUrl))
                                       placeholder="Search by Site ID"
                                       @else value="{{($IndexUrl->first()->SITE_ID ?? []) ?: ''}}"
                                    @endif>
                            @else
                                <input type="text" class="form-control" placeholder="Site ID"
                                       aria-label="SiteID"
                                       aria-describedby="button-addon2" id="siteid" name="siteid"
                                       value="{{($data->first()->SITE_ID ?? []) ?: ''}}">
                            @endif
                            <button class="btn btn-outline-secondary" type="submit" id="search-site" value="search-site"
                                    name="submit">Search
                            </button>
                        </div>
                    </form>
                    <form action="{{ route("crawl-tools") }}" method="post" id="crawlIndex" name="crawlIndex">
                        {{ csrf_field() }}
                        <div class="input-group mb-3">
                            @if(empty($count))
                                <input type="text" class="form-control type" placeholder="TYPE" aria-label="TYPE"
                                       aria-describedby="basic-addon1" id="type" name="type" value="{{old('type')}}">
                            @else
                                @if($count == '1')
                                    <input type="text" class="form-control type" placeholder="TYPE" aria-label="TYPE"
                                           aria-describedby="basic-addon1" id="type" name="type"
                                           value="{{(trim($IndexUrl->first()->TYPE) ?? []) ?: ''}}">
                                @else
                                    <input type="text" class="form-control type" placeholder="TYPE" aria-label="TYPE"
                                           aria-describedby="basic-addon1" id="type" name="type"
                                           value="{{old('type')}}">

                                @endif
                            @endif
                        </div>
                        <div class="input-group mb-3">

                            @if (empty($data))
                                @if(empty($IndexUrl))
                                    <input type="text" class="form-control" placeholder="URL" aria-label="URL"
                                           aria-describedby="basic-addon1" id="url" name="url" value="{{old('url')}}">
                                @else
                                    <input type="hidden" name="SITE_ID"
                                           value="{{($IndexUrl->first()->SITE_ID ?? []) ?: ''}}">
                                    <select class="form-select url" id="url"
                                            aria-label="Index URL" name="url">
                                        @foreach($IndexUrl as $items_each)
                                            <option type="{!! trim($items_each->TYPE) !!}"
                                                    value="{!! trim($items_each->INDEX_URL) !!}"
                                                    id="{!! trim($items_each->NO) !!}" {{ old('url') == trim($items_each->INDEX_URL) ? 'selected' : '' }}>{!! $items_each->INDEX_URL !!}</option>
                                        @endforeach
                                    </select>
                                    <button id="add-option" class="btn btn-outline-secondary" type="button">Button
                                    </button>
                                @endif
                            @else
                                <input type="hidden" name="SITE_ID" value="{{($data->first()->SITE_ID ?? []) ?: ''}}">
                                <select class="form-select url" id="url"
                                        aria-label="Index URL" name="url">
                                    @foreach($IndexUrl as $items_each)
                                        <option type="{!! trim($items_each->TYPE) !!}"
                                                value="{!! trim($items_each->INDEX_URL) !!}"
                                                id="{!! trim($items_each->NO) !!}" {{ old('url') == trim($items_each->INDEX_URL) ? 'selected' : '' }}>{!! $items_each->INDEX_URL !!}</option>
                                    @endforeach
                                </select>
                                <button id="add-option" class="btn btn-outline-secondary" type="button">Button</button>
                            @endif
                        </div>

                        <div class="input-group mb-3">
                            @if (empty($data))
                                <input type="text" class="form-control" placeholder="ALLOW DOMAIN"
                                       aria-label="AllowDomain" aria-describedby="basic-addon1" id="allow_domain"
                                       name="allow_domain" value="{{old('allow_domain')}}">
                            @else
                                <input type="text" class="form-control" placeholder="ALLOW DOMAIN"
                                       aria-label="AllowDomain" aria-describedby="basic-addon1" id="allow_domain"
                                       name="allow_domain"
                                       value="{{($data->first()->ALLOW_DOMAINS ?? []) ?: ''}}"
                                >
                            @endif

                        </div>
                        <div class="input-group mb-3">
                            @if (empty($data))
                                <input type="text" class="form-control" placeholder="DENY DOMAIN"
                                       aria-label="DenyDomain" aria-describedby="basic-addon1" id="deny_domain"
                                       name="deny_domain" value="{{old('deny_domain')}}">
                            @else
                                <input type="text" class="form-control" placeholder="DENY DOMAIN"
                                       aria-label="DenyDomain" aria-describedby="basic-addon1" id="deny_domain"
                                       name="deny_domain"
                                       value="{{($data->first()->DENY_DOMAINS ?? []) ?: ''}}"
                                >
                            @endif

                        </div>
                        <div class="input-group mb-3">
                            @if (empty($data))
                                <input type="text" class="form-control" placeholder="Allow Regx" aria-label="AllowRegex"
                                       aria-describedby="basic-addon1" id="allow_regex" name="allow_regex"
                                       value="{{old('allow_regex')}}">
                            @else
                                <input type="text" class="form-control" placeholder="Allow Regx" aria-label="AllowRegex"
                                       aria-describedby="basic-addon1" id="allow_regex" name="allow_regex"
                                       value="{{($data->first()->ALLOW ?? []) ?: ''}}"
                                >
                            @endif
                        </div>
                        <div class="input-group mb-3">
                            @if (empty($data))
                                <input type="text" class="form-control" placeholder="Deny Regx" aria-label="DenyRegex"
                                       aria-describedby="basic-addon1" id="deny_regex" name="deny_regex"
                                       value="{{old('deny_regex')}}">
                            @else
                                <input type="text" class="form-control" placeholder="Deny Regx" aria-label="DenyRegex"
                                       aria-describedby="basic-addon1" id="deny_regex" name="deny_regex"
                                       value="{{($data->first()->DENY ?? []) ?: ''}}"
                                >
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    @if (empty($data))
                                        <input type="text" class="form-control" placeholder="MISC" aria-label="MISC"
                                               aria-describedby="basic-addon1" id="misc" name="misc"
                                               value="{{old('misc')}}">
                                    @else
                                        <input type="text" class="form-control" placeholder="MISC" aria-label="MISC"
                                               aria-describedby="basic-addon1" id="misc" name="misc"
                                               value="{{($data->first()->MISC ?? []) ?: ''}}"
                                        >

                                    @endif

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    @if (empty($data))
                                        <input type="text" class="form-control" placeholder="MAPPING"
                                               aria-label="Mapping"
                                               aria-describedby="basic-addon1" id="mapping" name="mapping"
                                               value="{{old('mapping')}}">
                                    @else
                                        <input type="text" class="form-control" placeholder="MAPPING"
                                               aria-label="Mapping"
                                               aria-describedby="basic-addon1" id="mapping" name="mapping"
                                               value="{{($IndexUrl->first()->mapping ?? []) ?: ''}}"
                                        >
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-check form-switch">
                            @if (empty($data))
                                <input class="form-check-input" type="checkbox" id="js_render" name="js_render"
                                       value="{{old('js_render')}}">
                            @else
                                <input class="form-check-input" type="checkbox" id="js_render" name="js_render"
                                       value="{{$data->first()->JS_RENDER}}"
                                       @if ($data->first()->JS_RENDER == '1') checked @endif>
                            @endif
                            <label class="form-check-label" for="flexSwitchCheckDefault">Enable JS Render</label>
                        </div>
                        <div class="mb-3 form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="headless">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Enable Playwright</label>
                        </div>
                        <div style="float: left">
                            <button type="submit" class="btn btn-primary" id="crawlIndex" value="crawlIndex"
                                    name="submit">Crawl
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body ">
                    <h5 class="card-title">Preview Index Url</h5>
                    @if (empty($urlStory))
                        <p class="card-text"></p>
                    @else
                        <form action="{{ route("crawl-tools") }}" method="post" id="crawlStory" name="crawlStory">
                            {{ csrf_field() }}
                            <div class="input-group">
                                <select class="form-select url" id="urlstory"
                                        aria-label="Index URL" name="urlstory">
                                    @foreach($urlStory['urls'] as $items_each)
                                        <option value="{{$items_each['url']}}">{{$items_each['url']}}</option>
                                    @endforeach
                                </select>
                                <button id="crawlStory" class="btn btn-outline-secondary" type="submit"
                                        value="crawlStory" name="submit">Crawl
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
                <div class="card-body">
                    @if (empty($Story))
                        <p class="card-text"></p>
                    @else
                        @foreach($Story as $items_each)
                            {{$items_each['story']}}
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    @parent
    <script>
        $(document).ready(function () {
            $(document).on('change', '.url', function () {
                var index_val = $(this).val();     // get id the value from the select
                var index_text = $('.url option:selected').attr('type');
                $('.type').val(index_text);   // set the textbox value

                // if you want the selected text instead of the value
                // var air_text = $('.aircraftsName option:selected').text();
            });
        });
        var addOption = document.getElementById("add-option");
        var selectField = document.getElementById("url");
        addOption.addEventListener("click", function () {
            var item = prompt("What would you like");
            var option = document.createElement("option");
            option.setAttribute("value", item);
            var optionName = document.createTextNode(item);
            option.appendChild(optionName);
            selectField.appendChild(option);
        });
    </script>
@stop

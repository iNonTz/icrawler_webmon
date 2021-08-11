@extends('layouts.master')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
@section('title', 'Crawler')
@section('navbar')
    @parent
@stop
@section('content')
    {{ csrf_field() }}
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Crawl Info</h5>
                    <form class="searchid" id="searchSite" name="searchSite">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control"
                                   aria-label="SiteID"
                                   aria-describedby="button-addon2" id="siteid" name="siteid"
                                   placeholder="Search by Site ID" value="{{old('siteid')}}">
                            <button class="btn btn-outline-secondary search-site" type="button" id="search-site"
                                    value="search-site"
                                    name="search-site">Search
                            </button>
                        </div>
                    </form>
                    <form id="crawlIndex" name="crawlIndex">
                        <div class="data"></div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control type" placeholder="TYPE" aria-label="TYPE"
                                   aria-describedby="basic-addon1" id="type" name="type"
                                   value="{{old('type')}}">
                        </div>
                        <div class="input-group mb-3">
                            <select class="form-select url" id="url" aria-label="Index URL" name="url"></select>
                            <button id="add-option" class="btn btn-outline-secondary" type="button">+</button>
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" class="form-control allow_domain" placeholder="ALLOW DOMAIN"
                                   aria-label="AllowDomain" aria-describedby="basic-addon1" id="allow_domain"
                                   name="allow_domain" value="{{old('allow_domain')}}">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control deny_domain" placeholder="DENY DOMAIN"
                                   aria-label="DenyDomain" aria-describedby="basic-addon1" id="deny_domain"
                                   name="deny_domain" value="{{old('deny_domain')}}">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control allow_regex" placeholder="Allow Regx"
                                   aria-label="AllowRegex"
                                   aria-describedby="basic-addon1" id="allow_regex" name="allow_regex"
                                   value="{{old('allow_regex')}}">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control deny_regex" placeholder="Deny Regx"
                                   aria-label="DenyRegex"
                                   aria-describedby="basic-addon1" id="deny_regex" name="deny_regex"
                                   value="{{old('deny_regex')}}">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control misc" placeholder="MISC" aria-label="MISC"
                                           aria-describedby="basic-addon1" id="misc" name="misc"
                                           value="{{old('misc')}}">
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
                            <input class="form-check-input" type="checkbox" id="js_render" name="js_render"
                                   value="{{old('js_render')}}">

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
                            <div class="input-group">
                                <select class="form-select urlstory" id="urlstory"
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
                        {{$Story['story']}}
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
            });
        });
    </script>
    <script>
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
    <script>
        $(".crawlStory").click(function (event) {
            event.preventDefault();
            let urlstory = $('.urlstory option:selected').val();
            let _token = $('input[name="_token"]').val();
            $.ajax({
                url: "/crawler_tools",
                type: "POST",
                data: {
                    url: urlstory,
                    _token: _token
                },
                success: function (response) {
                    console.log(response);
                    if (response) {
                        $('.headline').text(JSON.stringify(response['headline']))
                        $('.story').text(JSON.stringify(response['story']))
                        $('.imageurl').html('<img src="' + response['image_url'] + '" class="img-fluid rounded mx-auto d-block" style="width: 700px;margin-top: 10px;"/>')
                        // $('.non').append(response)
                    }
                },
            });
        });
    </script>
    <script>
        $(".search-site").click(function (event) {
            event.preventDefault();
            let siteid = $('input[name="siteid"]').val();
            let _token = $('input[name="_token"]').val();
            $.ajax({
                url: "/api/searchSiteID",
                type: "POST",
                data: {
                    siteid: siteid,
                    _token: _token
                },
                success: function (response) {
                    console.log(response);
                    if (response) {
                        var cfg_site = JSON.parse(JSON.stringify(response[0][0]))
                        var cfg_index = JSON.parse(JSON.stringify(response[1]))
                        var count = JSON.parse(JSON.stringify(response[2]))
                        $('.type').val('')
                        if (count === 1){
                           cfg_index.map(function(sObj){
                                return $('.type').val(sObj.TYPE)
                            });
                        }
                        $('.url').children().remove().end().append(cfg_index.map(function(sObj){
                            return '<option id="'+sObj.NO+'" value="'+sObj.URL+'" type="'+sObj.TYPE+'" >'+ sObj.INDEX_URL +'</option>'
                        }));
                        $('.allow_regex').val(cfg_site['ALLOW'])
                        $('.deny_regex').val(cfg_site['DENY'])
                        $('.allow_domain').val(cfg_site['ALLOW_DOMAINS'])
                        $('.misc').val(cfg_site['MISC'])
                        $('.js_render').val(cfg_site['js_render'])
                        // $('.url').val(cfg_site['js_render'])


                    } else {
                        console.log(Error);
                    }
                },
            });
        });
    </script>
    <script>
        $(".crawlStory").click(function (event) {
            event.preventDefault();
            let urlstory = $('.urlstory option:selected').val();
            let _token = $('input[name="_token"]').val();
            $.ajax({
                url: "/crawler_tools",
                type: "POST",
                data: {
                    url: urlstory,
                    _token: _token
                },
                success: function (response) {
                    console.log(response);
                    if (response) {
                        $('.headline').text(JSON.stringify(response['headline']))
                        $('.story').text(JSON.stringify(response['story']))
                        $('.imageurl').html('<img src="' + response['image_url'] + '" class="img-fluid rounded mx-auto d-block" style="width: 700px;margin-top: 10px;"/>')
                        // $('.non').append(response)
                    }
                },
            });
        });
    </script>

@stop

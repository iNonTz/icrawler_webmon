@extends('layouts.master')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
@section('title', 'Crawler')
@section('navbar')
    @parent
@stop
@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Crawl Info</h5>
                    <form class="searchid" id="searchSite" name="searchSite">
                        {{ csrf_field() }}
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
                    <form name="crawlIndex">
                        {{ csrf_field() }}
                        <div class="data"></div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control type" placeholder="TYPE" aria-label="TYPE"
                                   aria-describedby="basic-addon1" id="type" name="type"
                                   value="{{old('type')}}">
                        </div>
                        <div class="input-group mb-3 urldiv">
                            <input type="text" class="form-control urlInput" placeholder="INDEX URL"
                                   aria-label="urlInput"
                                   aria-describedby="basic-addon1" id="urlinput" name="urlInput"
                                   value="{{old('urlinput')}}">
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
                                    <input type="text" class="form-control mapping" placeholder="MAPPING"
                                           aria-label="Mapping"
                                           aria-describedby="basic-addon1" id="mapping" name="mapping"
                                           value="{{old('mapping')}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input js_render" type="checkbox" id="js_render" name="js_render"
                                   value="{{old('js_render')}}">

                            <label class="form-check-label" for="flexSwitchCheckDefault">Enable JS Render</label>
                        </div>
                        <div class="mb-3 form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="headless">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Enable Playwright</label>
                        </div>
                        <div style="float: left">
                            <button type="button" class="btn btn-primary crawlIndex" id="crawlIndex" value="crawlIndex"
                                    name="submit">Crawl
                            </button>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#queryModal">Show Query Config
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Preview</h5>
                    <h5 class="countUrl"></h5>
                    <form name="crawlStory">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="input-group urlStorydiv">
                                <input type="text" class="form-control urlStory" placeholder="Story URL"
                                       aria-label="urlStory" aria-describedby="basic-addon1" id="urlStory"
                                       name="urlStory" value="{{old('urlStory')}}">
                                <button id="crawlStory" class="btn btn-outline-secondary crawlStory" type="button"
                                        value="crawlStory" name="submit">Crawl
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-check form-switch">
                                    <input class="form-check-input js_render_story" type="checkbox" id="js_render_story"
                                           name="js_render_story"
                                           value="{{old('js_render_story')}}">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Enable JS
                                        Render</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3 form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="headless">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Enable
                                        Playwright</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-check form-switch">
                                    <input class="form-check-input roadrunner" type="checkbox" id="roadrunner"
                                           name="roadrunner"
                                           value="{{old('roadrunner')}}">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Enable
                                        Roadrunner</label>
                                </div>
                            </div>
                            <div class="col">

                            </div>
                        </div>
                    </form>
                    <div class="card-text" style="height: 480px; overflow: auto;">
                        <div class="headline" style=" font-weight: bold; font-size: x-large;"></div>
                        <div class="source-url"></div>
                        <div class="url-sig"></div>
                        <div class="imageurl" id="imgUrl"></div>
                        <div class="story"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="queryModal" tabindex="-1" aria-labelledby="queryModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Query for sql</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>USE [DB_INTERNET_CRAWLER]</p>
                    <p>GO</p>
                    <p>INSERT INTO [dbo].[TB_CFG_INDEX] ([SITE_ID]
                        ,[INDEX_URL]
                        ,[DELAY]
                        ,[TYPE]
                        ,[ENABLE]
                        ,[mapping]
                        ,[updatetime]
                        ,[Size])</p>
                    <p>Values</p>
                    <p id="query-siteid"></p>
                    <p id="query-url"></p>
                    <p>'5',</p>
                    <p id="query-type"></p>
                    <p>'1',</p>
                    <p id="query-mapping"></p>
                    <p>GETDATE(),</p>
                    <p>NULL )</p>
                    <p>GO</p>

                    <p>INSERT INTO [dbo].[TB_CFG_SITE]
                        ([SITE_ID]
                        ,[SOURCEID]
                        ,[SITE_NAME]
                        ,[ALLOW_DOMAINS]
                        ,[DENY_DOMAINS]
                        ,[ALLOW]
                        ,[DENY]
                        ,[JS_RENDER]
                        ,[MISC]
                        ,[updatetime]
                        ,[DENY_CRAWLER]
                        ,[idpat])</p>
                    <p>VALUES </p>
                    <p id="query-siteid-cfg"></p>
                    <p>'81000000',</p>
                    <p id="query-sitename"></p>
                    <p id="query-allowDomain"></p>
                    <p>'',</p>
                    <p>'',</p>
                    <p>'',</p>
                    <p>'0',</p>
                    <p>'',</p>
                    <p>GETDATE(),</p>
                    <p>NULL,</p>
                    <p>NULL )</p>
                    <p>GO</p>
                </div>
            </div>
        </div>
    </div>

@stop
@section('script')
    @parent
    <script>
        $(function () {
            var $siteidinput = $('#siteid'),
                $query_siteid = $('#query-siteid');
                $query_siteid_cfg = $('#query-siteid-cfg');
            $siteidinput.on('input', function () {
                $query_siteid.text('"' + $siteidinput.val() + '",');
                $query_siteid_cfg.text('"' + $siteidinput.val() + '",');
            });
            var $urlinput = $('#urlinput'),
                $query_url = $('#query-url');
            $urlinput.on('input', function () {
                $query_url.text('"' + $urlinput.val() + '",');
            });
            var $typeinput = $('#type'),
                $query_type = $('#query-type');
            $typeinput.on('input', function () {
                $query_type.text('"' + $typeinput.val() + '",');
            });
            var $mappinginput = $('#mapping'),
                $query_mapping = $('#query-mapping');
            $mappinginput.on('input', function () {
                $query_mapping.text('"' + $mappinginput.val() + '",');
            });
            var $allow_domain_input = $('#allow_domain'),
                $query_allow_domain = $('#query-allowDomain');
            $allow_domain_input.on('input', function () {
                $query_allow_domain.text('"' + $allow_domain_input.val() + '",');
                $('#query-sitename').text('"' + $allow_domain_input.val() + '",');
            });
            var $mappinginput = $('#mapping'),
                $query_mapping = $('#query-mapping');
            $mappinginput.on('input', function () {
                $query_mapping.text('"' + $mappinginput.val() + '",');
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $(document).on('change', '.url', function () {
                var index_val = $(this).val();     // get id the value from the select
                var index_text = $('.url option:selected').attr('data-type');
                var mapping_text = $('.url option:selected').attr('data-mapping');
                $('.type').val(index_text);   // set the textbox value
                $('.mapping').val(mapping_text);   // set the textbox value
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $(document).on('change', '.urlStory', function () {
                let js_render_story = '';
                if ($("#js_render_story").prop("checked") === true) {
                    js_render_story = 1;
                } else {
                    js_render_story = 0;
                }
                let roadrunner = '';
                if ($("#roadrunner").prop("checked") === true) {
                    roadrunner = 1;
                } else {
                    roadrunner = 0;
                }
                let urlstory = $('.urlStory option:selected').val();
                let _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "/api/crawlStory",
                    type: "POST",
                    data: {
                        url: urlstory,
                        js_render_story: js_render_story,
                        roadrunner: roadrunner,
                        _token: _token
                    },
                    success: function (response) {
                        console.log(response);
                        if (response) {
                            let sourceUrl = JSON.parse(JSON.stringify(response['url']))
                            let urlSig = JSON.parse(JSON.stringify(response['url_sig']))
                            $('.headline').text(JSON.parse(JSON.stringify(response['headline'])))
                            $('.story').text(JSON.parse(JSON.stringify(response['story'])))
                            $('.source-url').html('<b>Source URL : </b><a href="' + sourceUrl + '">' + sourceUrl + '</a>')
                            $('.url-sig').html('<b>URL Sig : </b>' + urlSig)
                            $('.imageurl').html('<img src="' + response['image_url'] + '" class="img-fluid rounded mx-auto d-block" style="width: 700px;margin-top: 10px;"/>')
                        } else {
                            console.log(Error);
                        }
                    }
                })
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
        $(document).ready(function () {
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
                            if (count === 1) {
                                $('.urldiv').html('<input type="text" class="form-control urlInput" placeholder="urlIndex" aria-label="urlInput" aria-describedby="basic-addon1" id="urlinput" name="urlInput">')
                                cfg_index.map(function (sObj) {
                                    return [$('.type').val(sObj.TYPE), $('.mapping').val(sObj.mapping), $('.urlInput').val(sObj.INDEX_URL)]
                                });
                            } else {
                                $('.mapping').val('')
                                $('.urldiv').html('<select class="form-select url" id="url" aria-label="Index URL" name="url"></select><button id="add-option" class="btn btn-outline-secondary" type="button">+</button>');
                                $('.url').children().remove().end().append(cfg_index.map(function (sObj) {
                                    mapping_text = JSON.parse(sObj.mapping)
                                    return '<option id="' + sObj.NO + '" value="' + sObj.INDEX_URL + '" data-type="' + sObj.TYPE + '" data-mapping="' + mapping_text.codes + '">' + sObj.INDEX_URL + '</option>'
                                }));
                            }
                            $('.allow_regex').val(cfg_site['ALLOW'])
                            $('.deny_regex').val(cfg_site['DENY'])
                            $('.allow_domain').val(cfg_site['ALLOW_DOMAINS'])
                            $('.misc').val(cfg_site['MISC'])
                            $('.js_render').val(cfg_site['JS_RENDER'])
                            if (cfg_site['JS_RENDER'] === "1") {
                                $("#js_render").prop("checked", true);
                            } else {
                                $("#js_render").prop("checked", false);
                            }

                            // $('.url').val(cfg_site['js_render'])


                        } else {
                            console.log(Error);
                        }
                    },
                });
            });
        });

    </script>
    <script>
        $(document).ready(function () {
            $(".crawlIndex").click(function (event) {
                event.preventDefault();
                let allow_regex = '';
                let deny_regex = '';
                let deny_domain = '';
                url_input_sel = $('.url option:selected').val()
                url_input_type = $('input[name="urlInput"]').val()
                let url = "";
                if (url_input_sel) {
                    url = url_input_sel;
                } else {
                    url = url_input_type;
                }
                let type = $('input[name="type"]').val();
                let js_render = '';
                if ($("#js_render").prop("checked") === true) {
                    js_render = 1;
                } else {
                    js_render = 0;
                }
                let allow_domain = $('input[name="allow_domain"]').val().split("|");
                let siteid = $('input[name="siteid"]').val();
                let misc = $('input[name="misc"]').val();
                let mapping = $('input[name="mapping"]').val();
                let _token = $('input[name="_token"]').val();
                if (allow_regex || deny_regex || deny_domain) {
                    allow_regex = $('input[name="allow_regex"]').val().split("|");
                    deny_regex = $('input[name="deny_regex"]').val().split("|");
                    deny_domain = $('input[name="deny_domain"]').val().split("|");
                } else {
                    allow_regex = $('input[name="allow_regex"]').val();
                    deny_regex = $('input[name="deny_regex"]').val();
                    deny_domain = $('input[name="deny_domain"]').val();
                }

                $.ajax({
                    url: "/api/crawlIndex",
                    type: "POST",
                    data: {
                        qid: 1,
                        type: type,
                        url: url,
                        allow: allow_regex,
                        deny: deny_regex,
                        allow_domains: allow_domain,
                        deny_domains: deny_domain,
                        js_render: js_render,
                        siteid: siteid,
                        misc: misc,
                        mapping: mapping,
                        _token: _token
                    },
                    success: function (response) {
                        console.log(response);
                        if (response) {
                            var url_story = JSON.parse(JSON.stringify(response))
                            let urlCount = url_story['urls'].length
                            $('.countUrl').text('Total = ' + urlCount + ' URL');
                            $('.urlStorydiv').html('<select class="form-select urlStory" id="urlStory" aria-label="Story URL" name="urlStory"></select>');
                            $('.urlStory').children().remove().end().append(url_story['urls'].map(function (sObj) {
                                return '<option id="' + sObj.url_sig + '" value="' + sObj.url + '">' + sObj.url + '</option>'
                            }));
                        } else {
                            console.log(Error);
                        }
                    },
                });
            });
        });

    </script>
    <script>
        $(document).ready(function () {
            $(".crawlStory").click(function (event) {
                console.log(Error)
                event.preventDefault();
                let js_render_story = '';
                if ($("#js_render_story").prop("checked") === true) {
                    js_render_story = 1;
                } else {
                    js_render_story = 0;
                }
                let roadrunner = '';
                if ($("#roadrunner").prop("checked") === true) {
                    roadrunner = 1;
                } else {
                    roadrunner = 0;
                }
                url_urlstory_input_sel = $('.urlStory option:selected').val()
                url_urlstory_input_type = $('input[name="urlStory"]').val()
                let urlstory = "";
                if (url_urlstory_input_sel) {
                    urlstory = url_urlstory_input_sel;
                } else {
                    urlstory = url_urlstory_input_type;
                }
                let _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "/api/crawlStory",
                    type: "POST",
                    data: {
                        url: urlstory,
                        roadrunner: roadrunner,
                        js_render_story: js_render_story,
                        _token: _token
                    },
                    success: function (response) {
                        console.log(response);
                        if (response) {
                            let sourceUrl = JSON.parse(JSON.stringify(response['url']))
                            let urlSig = JSON.parse(JSON.stringify(response['url_sig']))
                            $('.headline').text(JSON.parse(JSON.stringify(response['headline'])))
                            $('.story').text(JSON.parse(JSON.stringify(response['story'])))
                            // $('.source-url').text(JSON.parse(JSON.stringify(response['url'])))
                            $('.source-url').html('<b>Source URL : </b><a href="' + sourceUrl + '">' + sourceUrl + '</a>')
                            $('.url-sig').html('<b>URL Sig : </b>' + urlSig)
                            $('.imageurl').html('<img src="' + response['image_url'] + '" class="img-fluid rounded mx-auto d-block" style="width: 700px;margin-top: 10px;"/>')
                            // $('.non').append(response)
                        } else {
                            console.log(Error);
                        }
                    },
                });
            });
        });
    </script>

@stop

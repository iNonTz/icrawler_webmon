@extends('layouts.master')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
@section('title', 'Crawler')
@section('navbar')
    @parent
@stop
@section('content')
    <div class="row justify-content-center">
        <fieldset class="border p-2">
            <legend class="w-auto">Crawl Info</legend>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Crawler</a>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Search by site id</a>
                </li>
            </ul>
        </fieldset>
        <div class="col-6">
            <fieldset class="border p-2">
                <legend class="w-auto">Crawl Info</legend>
                <form>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Site ID" aria-label="SiteID"
                                       aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary" type="button" id="button-addon2">Search
                                </button>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group">
                                <select class="form-select" id="type"
                                        aria-label="Example select with button addon">
                                    <option selected>Select type</option>
                                    <option value="1">RSS</option>
                                    <option value="2">INDEX</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="URL" aria-label="URL"
                               aria-describedby="basic-addon1" id="url">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="ALLOW DOMAIN"
                               aria-label="AllowDomain" aria-describedby="basic-addon1" id="allow_domain">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Allow Regx" aria-label="AllowRegex"
                               aria-describedby="basic-addon1" id="allow_regex">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Deny Regx" aria-label="DenyRegex"
                               aria-describedby="basic-addon1" id="deny_regex">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="MISC" aria-label="MISC"
                                       aria-describedby="basic-addon1" id="misc">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="MAPPING" aria-label="Mapping"
                                       aria-describedby="basic-addon1" id="mapping">
                            </div>
                        </div>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="js_render">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Enable JS Render</label>
                    </div>
                    <div class="mb-3 form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="headless">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Enable Playwright</label>
                    </div>
                    <div style="float: left">
                        <button type="submit" class="btn btn-primary" id="crawl">Crawl</button>
                        <button type="reset" class="btn btn-warning" id="reset">Reset</button>
                    </div>


                </form>
            </fieldset>
        </div>
        <div class="col-6">
            <fieldset class="border p-2">
                <legend class="w-auto">Preview</legend>
                <div class="input-group">
                    <textarea class="form-control" aria-label="With textarea"></textarea>
                </div>
            </fieldset>
        </div>
        <div class="col-6">

        </div>
    </div>
@stop
@section('script')
    @parent

@stop

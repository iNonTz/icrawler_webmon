@extends('layouts.master')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
@section('title', 'Crawler')
@section('navbar')
    @parent
@stop
@section('content')
{{user}}
@stop
@section('script')
    @parent

@stop

@extends('layouts.master')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
@section('title', 'Index')
@section('navbar')
    @parent
@stop
@section('content')
    <table class="table display" id="table_index" style="width:100%">
        <thead>
        <tr>
            <th>Site ID</th>
            <th>Index URL</th>
            <th>Type</th>
            <th>Enable</th>
            <th>Update Time</th>
        </tr>
        </thead>
        <tbody>
{{--        @foreach($index_site as $item)--}}
{{--            <tr>--}}
{{--                <th scope="row">{{$item->SITE_ID}}</th>--}}
{{--                <td>{{$item->INDEX_URL}}</td>--}}
{{--                <td>{{$item->TYPE}}</td>--}}
{{--                <td>{{$item->ENABLE}}</td>--}}
{{--                <td>{{$item->updatetime}}</td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
        </tbody>
    </table>
@stop
@section('script')
    @parent
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#table_index').DataTable(
                {
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('index') }}",
                    columns: [
                        { data: 'SITE_ID', name: 'SITE_ID' },
                        { data: 'INDEX_URL', name: 'INDEX_URL' },
                        { data: 'TYPE', name: 'TYPE' },
                        { data: 'ENABLE', name: 'ENABLE' },
                        { data: 'updatetime', name: 'updatetime' },
                    ]

                }
            );
        } );
    </script>
@stop

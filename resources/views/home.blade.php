@extends('layouts.master')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
@section('title', 'Index')
@section('navbar')
    @parent
@stop
@section('content')
    <div class="row justify-content-center">
        <table class="table table-responsive" id="table_index" style="width:100%">
            <thead>
            <tr>
                <th>Site ID</th>
                <th>Index URL</th>
                <th>Type</th>
                <th>Enable</th>
                <th>Update Time</th>
                <th width="100px">Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@stop
@section('script')
    @parent
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#table_index').DataTable(
                {
                    processing: true,
                    serverSide: true,
                    ajax: "{{ url("/") }}",
                    columns: [
                        {data: 'SITE_ID', name: 'SITE_ID'},
                        {data: 'INDEX_URL', name: 'INDEX_URL'},
                        {data: 'TYPE', name: 'TYPE'},
                        {data: 'ENABLE', name: 'ENABLE'},
                        {data: 'updatetime', name: 'updatetime'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]

                }
            );
        });
    </script>
@stop

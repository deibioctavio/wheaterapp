@extends('layouts.master')

@section('content')
    <table class="table table-bordered" id="sensor-report-all-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Sensor ID</th>
            <th>Temperature</th>
            <th>Power OK</th>
            <th>Extra Data</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
        </thead>
    </table>
@stop
@push('scripts')
    <script>
        $(function() {
            $('#sensor-report-all-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('sensorsdata.reports.all') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'sensor_id', name: 'sensor_id' },
                    { data: 'temperature', name: 'temperature' },
                    { data: 'power_ok', name: 'power_ok' },
                    { data: 'extra_data', name: 'extra_data' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' }
                ]
            });
        });
    </script>
@endpush

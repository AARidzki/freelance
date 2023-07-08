<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
</head>
<body>
    <style type="text/css">
        table tr td,
        table tr th{
            font-size: 9pt;
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
    <center>
        <h5>Report Pekerjaan Mr. DIY Salatiga</h4>
    </center>
    
    <table 
    {{-- class="table table-striped table-md" --}}
    >

            <tr>
                <th>No</th>
                <th>Jenis Pekerjaan</th>
                <th>Qty</th>
                <th>Keterangan</th>
                <th>Perbaikan</th>
                <th>Status</th>
                <th>Sebelum</th>
                <th>Pengerjaan</th>
                <th>Sesudah</th>
            </tr>

            @foreach ($projects as $project)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $project->jenis }}</td>
                    <td>{{ $project->qty }}</td>
                    <td>{{ $project->keterangan }}</td>
                    <td>{{ $project->perbaikan }}</td>
                    <td>{{ $project->status }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $project->sebelum) }}" class="img-fluid" alt="{{ $project->sebelum }}"
                        style="max-width: 7em;">
                    </td>
                    <td>
                        <img src="{{ asset('storage/' . $project->pengerjaan) }}" class="img-fluid" alt="{{ $project->pengerjaan }}"
                        style="max-width: 7em;">
                    </td>
                    <td>
                        <img src="{{ asset('storage/' . $project->sesudah) }}" class="img-fluid" alt="{{ $project->sesudah }}"
                        style="max-width: 7em;">
                    </td>
                </tr>
            @endforeach
    </table>
</body>
</html>

{{-- @extends('dashboard.layouts.main')

@section('container')

<style type="text/css">
    table tr td,
    table tr th{
        font-size: 9pt;
    }
</style>
<center>
    <h5>Report</h4>
</center>

<table class="table table-striped table-md">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Jenis Pekerjaan</th>
            <th scope="col">Qty</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Perbaikan</th>
            <th scope="col">Status</th>
            <th scope="col">Sebelum</th>
            <th scope="col">Pengerjaan</th>
            <th scope="col">Sesudah</th>
            <th scope="col">Action</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($projects as $project)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $project->jenis }}</td>
                <td>{{ $project->qty }}</td>
                <td>{{ $project->keterangan }}</td>
                <td>{{ $project->perbaikan }}</td>
                <td>{{ $project->status }}</td>
                <td>
                    <img src="{{ asset('storage/' . $project->sebelum) }}" class="img-fluid" alt="{{ $project->sebelum }}"
                    style="max-width: 10em;">
                </td>
                <td>
                    <img src="{{ asset('storage/' . $project->pengerjaan) }}" class="img-fluid" alt="{{ $project->pengerjaan }}"
                    style="max-width: 10em;">
                </td>
                <td>
                    <img src="{{ asset('storage/' . $project->sesudah) }}" class="img-fluid" alt="{{ $project->sesudah }}"
                    style="max-width: 10em;">
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection --}}
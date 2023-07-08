@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Projects</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-8" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive col-lg-20">
        <a href="/dashboard/projects/create" class="btn btn-primary mb-3">Create new Project</a>
        <a href="/dashboard/pdf" class="btn btn-primary mb-3" target="_blank">CETAK PDF</a>
        <table class="table table-striped table-md">
            <thead>
                <tr>
                    <th scope="col">No</th>
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
                            style="max-width: 8em;">
                        </td>
                        <td>
                            <img src="{{ asset('storage/' . $project->pengerjaan) }}" class="img-fluid" alt="{{ $project->pengerjaan }}"
                            style="max-width: 8em;">
                        </td>
                        <td>
                            <img src="{{ asset('storage/' . $project->sesudah) }}" class="img-fluid" alt="{{ $project->sesudah }}"
                            style="max-width: 8em;">
                        </td>
                        <td>
                            {{-- <a href="/dashboard/projects/{{ $project->id }}" class="badge bg-info"><span
                                    data-feather="eye"></span></a> --}}
                            <a href="/dashboard/projects/{{ $project->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                            <form action="/dashboard/projects/{{ $project->id }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge bg-danger border-0" onclick="return confirm('are you sure?')"><span data-feather="x-circle"></span></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

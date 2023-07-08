
@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Orders</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-8" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('errors'))
        <div class="alert alert-danger col-lg-8" role="alert">
            {{ session('errors') }}
        </div>
    @endif

    <div class="table-responsive col-lg-20">
        <a href="/dashboard/orders/create" class="btn btn-primary mb-3">Create new Order</a>
        {{-- <a href="/dashboard/pdf" class="btn btn-primary mb-3" target="_blank">CETAK PDF</a> --}}
        <table class="table table-striped table-md">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Jenis Pekerjaan</th>
                    <th scope="col">Client</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->jenis }}</td>
                        <td>{{ $order->client->nama }}</td>
                        <td>{{ $order->tgl }}</td>

                        <td>
                            <a href="/dashboard/orders/{{ $order->id }}" class="badge bg-info"><span
                                    data-feather="eye"></span></a>
                            <a href="/dashboard/orders/{{ $order->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                            <form action="/dashboard/orders/{{ $order->id }}" method="post" class="d-inline">
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

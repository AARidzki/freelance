<!-- resources/views/orders/show.blade.php -->

@extends('dashboard.layouts.main')

@section('container')
    {{-- <h1>Order Details</h1> --}}

    <div class="d-flex flex-column pt-3 pb-2 mb-3 border-bottom">
        <p class="fs-2 fw-bolder">Order Information</p>
        <p class="fs-5 fw-semibold">Jenis : {{ $order->jenis }}</p>
        <p class="fs-5 fw-semibold">Client : {{ $order->client->nama }}</p>
        <p class="fs-5 fw-semibold">Tanggal : {{ $order->tgl }}</p>
    
    </div>
    <p class="fs-4 fw-bold">Order Details</p>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
        <a href="{{ route('orders.create-detail', $order) }}" class="btn btn-primary me-md-auto">Create New Detail</a>
        <a href="{{ route('orders.index') }}" class="btn btn-primary">Back to Orders <i class="bi bi-arrow-return-left"></i></a>
    </div>
    
    <div class="table-responsive col-lg-20">
        <table class="table table-striped table-md">
            <thead>
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $detail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $detail->jenis_detail }}</td>
                        <td>{{ $detail->qty }}</td>
                        <td>{{ $detail->keterangan }}</td>
                        <td>{{ $detail->perbaikan }}</td>
                        <td>{{ $detail->status }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $detail->sebelum) }}" class="img-fluid" alt="{{ $detail->sebelum }}"
                            style="max-width: 8em;">
                        </td>
                        <td>
                            <img src="{{ asset('storage/' . $detail->pengerjaan) }}" class="img-fluid" alt="{{ $detail->pengerjaan }}"
                            style="max-width: 8em;">
                        </td>
                        <td>
                            <img src="{{ asset('storage/' . $detail->sesudah) }}" class="img-fluid" alt="{{ $detail->sesudah }}"
                            style="max-width: 8em;">
                        </td>
                        <td>
                            <a href="{{ route('orders.edit-detail', ['order' => $order, 'detail' => $detail]) }}" class="badge bg-warning"><span data-feather="edit"></span></a>
                            <form action="{{ route('orders.destroy-detail', ['order' => $order, 'detail' => $detail]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

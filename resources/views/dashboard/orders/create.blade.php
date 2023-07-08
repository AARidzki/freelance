@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create New Order</h1>
    </div>

    <div class="col-lg-8">
        <form method="POST" action="/dashboard/orders" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="jenis" class="form-label">Jenis Pekerjaan</label>
                <input type="text" class="form-control @error('jenis') is-invalid @enderror" id="jenis" name="jenis"
                    required autofocus value="{{ old('jenis') }}">
                @error('jenis')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="client" class="form-label">Client</label>
                <select class="form-select" name="client_id">
                    @foreach ($clients as $client)
                        @if (old('client_id') == $client->id)
                            <option value="{{ $client->id }}" selected>{{ $client->nama }}</option>
                        @else
                            <option value="{{ $client->id }}">{{ $client->nama }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="tgl" class="form-label">Tanggal</label>
                <input type="date" class="form-control @error('tgl') is-invalid @enderror" id="tgl" name="tgl"
                    required autofocus value="{{ old('tgl') }}">
                @error('tgl')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create Order</button>
        </form>
    </div>

@endsection

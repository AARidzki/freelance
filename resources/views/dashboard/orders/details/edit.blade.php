@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Detail</h1>
    </div>

    <div class="col-lg-8">
        <form method="POST" action="{{ route('orders.update-detail', ['order' => $order, 'detail' => $detail]) }}" class="mb-5" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="jenis_detail" class="form-label">Jenis Pekerjaan</label>
                <input type="text" class="form-control @error('jenis_detail') is-invalid @enderror" id="jenis_detail" name="jenis_detail"
                    required autofocus value="{{ old('jenis_detail', $detail->jenis_detail) }}">
                @error('jenis_detail')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="qty" class="form-label">Qty</label>
                <input type="text" class="form-control  @error('qty') is-invalid @enderror" id="qty"
                    name="qty" required value="{{ old('qty', $detail->qty) }}">
                @error('qty')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <input type="text" class="form-control  @error('keterangan') is-invalid @enderror" id="keterangan"
                    name="keterangan" required value="{{ old('keterangan', $detail->keterangan) }}">
                @error('keterangan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="perbaikan" class="form-label">Perbaikan</label>
                <input type="text" class="form-control  @error('perbaikan') is-invalid @enderror" id="perbaikan"
                    name="perbaikan" required value="{{ old('perbaikan', $detail->perbaikan) }}">
                @error('perbaikan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control  @error('status') is-invalid @enderror" id="status"
                    name="status" required value="{{ old('status', $detail->status) }}">
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="sebelum" class="form-label">Sebelum Pengerjaan</label>
                <input type="hidden" name="oldImage" value="{{ $detail->sebelum }}">
                @if ($detail->sebelum)
                <img src="{{ asset('storage/' . $detail->sebelum) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                @else
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                @endif
                <input class="form-control @error('sebelum') is-invalid @enderror" type="file" id="sebelum" name="sebelum" onchange="previewImage()">
                @error('sebelum')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="pengerjaan" class="form-label">Sedang Pengerjaan</label>
                <input type="hidden" name="oldImage" value="{{ $detail->pengerjaan }}">
                @if ($detail->pengerjaan)
                <img src="{{ asset('storage/' . $detail->pengerjaan) }}" class="img-preview1 img-fluid mb-3 col-sm-5 d-block">
                @else
                    <img class="img-preview1 img-fluid mb-3 col-sm-5">
                @endif
                <input class="form-control @error('pengerjaan') is-invalid @enderror" type="file" id="pengerjaan" name="pengerjaan" onchange="previewImage1()">
                @error('pengerjaan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="sesudah" class="form-label">Sesudah Pengerjaan</label>
                <input type="hidden" name="oldImage" value="{{ $detail->sesudah }}">
                @if ($detail->sesudah)
                <img src="{{ asset('storage/' . $detail->sesudah) }}" class="img-preview2 img-fluid mb-3 col-sm-5 d-block">
                @else
                    <img class="img-preview2 img-fluid mb-3 col-sm-5">
                @endif
                <input class="form-control @error('sesudah') is-invalid @enderror" type="file" id="sesudah" name="sesudah" onchange="previewImage2()">
                @error('sesudah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>



            <button type="submit" class="btn btn-primary">Update Detail</button>
        </form>
    </div>

    <script>
        function previewImage(){
            const image = document.querySelector('#sebelum');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader =  new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result;
            }
        }
        function previewImage1(){
            const image1 = document.querySelector('#pengerjaan');
            const imgPreview1 = document.querySelector('.img-preview1');

            imgPreview1.style.display = 'block';

            const oFReader =  new FileReader();
            oFReader.readAsDataURL(image1.files[0]);

            oFReader.onload = function(oFREvent){
                imgPreview1.src = oFREvent.target.result;
            }
        }
        function previewImage2(){
            const image2 = document.querySelector('#sesudah');
            const imgPreview2 = document.querySelector('.img-preview2');

            imgPreview2.style.display = 'block';

            const oFReader =  new FileReader();
            oFReader.readAsDataURL(image2.files[0]);

            oFReader.onload = function(oFREvent){
                imgPreview2.src = oFREvent.target.result;
            }
        }
    </script>
@endsection

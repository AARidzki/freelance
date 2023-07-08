@extends('dashboard.layouts.main')

@section('container')
    
<h2>Add Detail</h2>

<form action="{{ route('orders.store-detail', $order) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="jenis_detail" class="form-label">Jenis Pekerjaan</label>
        <input type="text" class="form-control @error('jenis_detail') is-invalid @enderror" id="jenis_detail" name="jenis_detail"
            required autofocus value="{{ old('jenis_detail') }}">
        @error('jenis_detail')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="qty" class="form-label">Qty</label>
        <input type="text" class="form-control  @error('qty') is-invalid @enderror" id="qty"
            name="qty" required value="{{ old('qty') }}">
        @error('qty')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="keterangan" class="form-label">Keterangan</label>
        <input type="text" class="form-control  @error('keterangan') is-invalid @enderror" id="keterangan"
            name="keterangan" required value="{{ old('keterangan') }}">
        @error('keterangan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="perbaikan" class="form-label">Perbaikan</label>
        <input type="text" class="form-control  @error('perbaikan') is-invalid @enderror" id="perbaikan"
            name="perbaikan" required value="{{ old('perbaikan') }}">
        @error('perbaikan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <input type="text" class="form-control  @error('status') is-invalid @enderror" id="status"
            name="status" required value="{{ old('status') }}">
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="sebelum" class="form-label">Sebelum Pengerjaan</label>
        <img class="img-preview img-fluid mb-3 col-sm-5">
        <input class="form-control @error('sebelum') is-invalid @enderror" type="file" id="sebelum" name="sebelum" onchange="previewImage()">
        @error('sebelum')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="pengerjaan" class="form-label">Sedang Pengerjaan</label>
        <img class="img-preview1 img-fluid mb-3 col-sm-5">
        <input class="form-control @error('pengerjaan') is-invalid @enderror" type="file" id="pengerjaan" name="pengerjaan" onchange="previewImage1()">
        @error('pengerjaan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="sesudah" class="form-label">Sesudah Pengerjaan</label>
        <img class="img-preview2 img-fluid mb-3 col-sm-5">
        <input class="form-control @error('sesudah') is-invalid @enderror" type="file" id="sesudah" name="sesudah" onchange="previewImage2()">
        @error('sesudah')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Create Detail</button>
</form>

<script>

    function previewImage(){
        const image = document.querySelector('#sebelum');
        const imgPreview = document.querySelector('.img-preview')

        imgPreview.style.display = 'block';
        
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
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
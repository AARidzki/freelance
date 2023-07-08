

@extends('dashboard.layouts.main')

@section('container')


    <div class="d-flex flex-column pt-3 pb-2 mb-3 border-bottom">
        <p class="fs-2 fw-bolder">Order Report</p>
    </div>
    

    <div class="row  mb-3">
        <div class="col-md-8">
            <form action="{{ route('orders.report') }}" method="GET">
                <label for="client">Pilih Client</label>
                <select name="client" id="client" class="form-control">
                    <option value="0">Semua Client</option>
                    @foreach ($clientOptions as $option)
                    <option value="{{ $option->id }}" @if(request('client') == $option->id) selected @endif>{{ $option->nama }} </option>
                    @endforeach    
                </select>

                <label for="order">Pilih Order</label>
                <select name="order" id="order" class="form-control">
                    <option value="0">Semua Order</option>
                    @foreach ($orderOptions as $option)
                        <option value="{{ $option->id }}" @if(request('order') == $option->id) selected @endif>{{ $option->jenis }}, {{$option->client->nama}}</option>
                    @endforeach
                </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mt-4"><i class="bi bi-filter"></i> Filter</button>
        </div>
            </form>
        <div class="col-auto">
            <a href="/dashboard/pdf" class="btn btn-success mt-4" id="link" target="_blank"><i class="bi bi-download"></i>  CETAK PDF</a>
        </div>    
    </div>




    <div class="table-responsive col-lg-20">
        <table class="table table-striped table-md">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis</th>
                    <th>Qty</th>
                    <th>Keterangan</th>
                    <th>Perbaikan</th>
                    <th>Status</th>
                    <th>Sebelum</th>
                    <th>Pengerjaan</th>
                    <th>Sesudah</th>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        var e = document.getElementById("order");
        var f = document.getElementById("client");

        function onChange() {
          var value = e.value;
          var text = e.options[e.selectedIndex].text;
         // console.log(value, text);
          var value1 = f.value;
          var text1 = f.options[f.selectedIndex].text;
         // console.log(value1, text1);
           
                var link = document.getElementById("link");
                link.setAttribute("href", "/dashboard/pdf?order=" + value + "&client=" + value1);
        }
        e.onchange = onChange;
        f.onchange = onChange;
        onChange();
    </script>
@endsection


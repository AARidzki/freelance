
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
        table {
            font-family: arial, sans-serif;
            font-size: 9pt;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
        }
        th {
            background-color: #dddddd;
        }
    </style>
    <center>
        @if ($jumlah == 'semua') 
        <h4>Semua Report Pekerjaan Dari Semua Client</h4>

    @elseif ($jumlah == 'only_client')
        @foreach ($orders as $order)
        @if($loop->index<1)
            <h4>Semua Report Pekerjaan Dari {{ $order->nama }}</h4>
        @endif
        @endforeach
        
    @elseif ($jumlah == 'only_order')
        @foreach ($orders as $order)
        
    @if($loop->index<1)
            <h4>Report Pekerjaan {{ $order->jenis }} Dari Semua Client</h4>
    @endif    
        @endforeach

    @else
        @foreach ($orders as $order)
        @if($loop->index<1)
            <h4>Report Pekerjaan {{ $order->jenis }} Dari {{ $order->nama }}</h4>
        @endif
        @endforeach
    @endif
    </center>
    
    <table>
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

            @foreach ($orders as $detail)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $detail->jenis_detail }}</td>
                    <td>{{ $detail->qty }}</td>
                    <td>{{ $detail->keterangan }}</td>
                    <td>{{ $detail->perbaikan }}</td>
                    <td>{{ $detail->status }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $detail->sebelum) }}" class="img-fluid" alt="{{ $detail->sebelum }}"
                        style="max-width: 7em;">
                    </td>
                    <td>
                        <img src="{{ asset('storage/' . $detail->pengerjaan) }}" class="img-fluid" alt="{{ $detail->pengerjaan }}"
                        style="max-width: 7em;">
                    </td>
                    <td>
                        <img src="{{ asset('storage/' . $detail->sesudah) }}" class="img-fluid" alt="{{ $detail->sesudah }}"
                        style="max-width: 7em;">
                    </td>
                </tr>
            @endforeach
    </table>
</body>
</html>
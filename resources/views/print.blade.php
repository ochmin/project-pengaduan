<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Data Pengaduan</title>
</head>
<body>
    <h2 style="text-align: center; margin-buttom: 20px">Data keseluruhan pengaduan</h2>
    <table style="width: 100%">
        <tr>
            <th>No</th>
            <th>NIK</th>
            <th>No_telp</th>
            <th>Tanggal</th>
            <th>Pengaduan</th>
            <th>Gambar</th>
            <th>Status Response</th>
            <th>Pesan Response</th>
        </tr>
        @php
        $no = 1;
        @endphp
        @foreach($reports as $report)
        <tr>
            <td>{{$no++}}</td>
            <td>{{$report['nik']}}</td>
            <td>{{$report['nama']}}</td>
            <td>{{$report['no_telp']}}</td>
            <td>{{\Carbon\Carbon::parse($report['created_at'])->format('J F, Y')}}</td>
            <td>{{$report['pengaduan']}}</td>
            <td><img src="assets/image/{{$report['foto']}}" width="80"></td>
            <td>
                {{--cek apakah data report ini sudah memiliki relasi dengan data dr with ('response')--}}
                  @if ($report['response'])
                  {{--kalau ada hasil relasinya , tampilkan bagian status--}}
                  {{ $report['response']['status'] }}
                  @else
                  {{--kalu gada tampilan tanda ini--}}
                  -
                  @endif
                      
              </td>
                      
              <td>
                  {{--cek apakah data report ini sudah memiliki relasi dengan data dr with ('response')--}}
                                      @if ($report['response'])
                                      {{--kalau ada hasil relasinya , tampilkan bagian pesan--}}
                                      {{ $report['response']['pesan'] }}
                                      @else
                                      {{--kalu gada tampilan tanda ini--}}
                                      -
                                      @endif
                                          
                                  </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
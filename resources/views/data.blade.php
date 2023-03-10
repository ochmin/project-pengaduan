<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>
<body>
    <h2 class="title-table">Laporan Keluhan</h2>
<div style="display: flex; justify-content: center; margin-bottom: 30px">
    <a href="/logout" style="text-align: center">Logout</a>
    <div style="margin: 0 10px"> | </div>
    <a href="index.html" style="text-align: center">Home</a>
</div>
<div style="display: flex; justify-content: flex-end; align-items:center">
    {{--menggunakan method get karena rote untuk masuk ke halaman data ini menggunakan :: get--}}
    <form action="" method="GET">
        @csrf
        <input type="text" name="search" placeholder="cari berdasarkan nama">
        <button type="submit" class="btn-login" style="margin-top: -1px">Cari</button>
            
    </form>
    {{--refresh balik ke route data karna nanti pas di klik refresh bersihin riwayat pencarian sebelumnnya dan di balikin lagi ke halaman data lagi--}}
    <a href="{{route('data')}}" style="margin-left: 10px; margin-top: -2px">Refresh</a>
    <a href="{{route('export-pdf')}}" style="margin-left: 10px; margin-top:-10px;">Cetak PDF</a>
    <a href="{{route('export.excel')}}" style="margin-left: 10px; margin-top:-10px;">Cetak Excel</a>
</div>
<div style="padding: 0 30px">
    <table>
        <thead>
        <tr>
            <th width="5%">No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Telp</th>
            <th>Pengaduan</th>
            <th>Gambar</th>
            <th>Status Response</th>
            <th>Pesan Response</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            @endphp
            @foreach($reports as $report)
            <tr>

                {{--menambahkan angka 1 dr $no di php tiap baris nya --}}
                <td>{{$no++}}</td>
                <td>{{$report['nik']}}</td>
                <td>{{$report['nama']}}</td>\
                {{--mengganti format 08 jadi 628--}}
                @php
                //substr_replace : mengubah karater string
                //punya 3 argumen. argumen 1 : data yang di masukan ke string 
                //argumen ke2: mulai dr index sama ubahnya 
                //argumen ke3 : sampai index sama di ubahnya 
$telp = substr_replace($report->no_telp, "62", 0, 1)
@endphp
@php
//kalau udah di response data reportnya  chat wanya data dr response di tampilin
if ($report->response) {
    $pesanWA= 'Hallo' . $report->nama . '!pengaduan anda di'. 
$report->response['status']. ',berikut pesan untuk anda :'. 
$report->response['pesan'];
}
// kalau belum di response pengaduannya , chat wanya kaya gini
else{
    $pesanWA = 'belum ada data pegawai';
}
@endphp

<td><a href="https://wa.me/{{$telp}}?text=Hallo,%20{{$report->nama}}%20pengaduan%20anda%20akan%20kami%20cek" target="_blank">{{$telp}}</a></td>
                <td>{{$report['pengaduan']}}</td>
{{-- <td><a href="https://wa.me/{{$telp}}?text={{$pesanWA}}"
    target="_blank">{{$telp}}</a></td> --}}
{{--yg di tampilkan tag a dengan $telp (data no_telp 08 di ubah menjadi 628)--}}
                <td>

                    {{--menampilkan gambar full layar di tab baru--}}

                    {{-- <td>{{$report['pengaduan']}}</td> --}}
                    <a href="../assets/image/{{$report->foto}}"
                        target="_blank">
                        <img src="{{asset('assets/image/'.$report->foto)}}"
                        width="120">
                    </a>
                    <img src="{{asset('assets/image/'.$report->foto)}}"width="120">
                </td>
                <td>
                    {{--cek apakah data report ini sudah memiliki relasi dengan data dr with ('response')--}}
                      @if ($report->response)
                      {{--kalau ada hasil relasinya , tampilkan bagian status--}}
                      {{ $report->response['status'] }}
                      @else
                      {{--kalu gada tampilan tanda ini--}}
                      -
                      @endif
                          
                  </td>
                          
                  <td>
                      {{--cek apakah data report ini sudah memiliki relasi dengan data dr with ('response')--}}
                                          @if ($report->response)
                                          {{--kalau ada hasil relasinya , tampilkan bagian pesan--}}
                                          {{ $report->response['pesan'] }}
                                          @else
                                          {{--kalu gada tampilan tanda ini--}}
                                          -
                                          @endif
                                              
                                      </td>
                <td>
                    <form action= "{{route('destroy', $report->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Hapus</button>
                    </form>
                    <a href="{{route('print-pdf', $report->id)}}" method="GET" style="margin-top: -33px; margin-right: 3px; margin-left: 5px;">
                        print
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
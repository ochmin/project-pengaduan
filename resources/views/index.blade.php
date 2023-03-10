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
    <header>
        @if (Auth::check())
        @if (Auth::user()->role == 'admin')
        <a href="{{route('data')}}" class="login-btn"> Lihat data</a>
        @elseif (Auth::user()->role == 'petugas')
        <a href="{{route('data.petugas')}}"
        class="login-btn">Lihat data</a>
        @endif
{{--kalau data blm login , button yang dimunculkan button buat ke halaman login --}}
@else
    
@endif
        <a href="{{route('login')}}" class="login-btn">Administrator</a>
    </header>

    <section class="baris">
        <div class="kolom kolom1">
            <h2 style="text-align:left;">Pengaduan Masyarakat</h2>
            <ol>
                <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias modi nemo illum beatae omnis fugit!</li>
                <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aspernatur, debitis?</li>
                <li>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptate eligendi et atque dolores veniam maiores quasi error deserunt ducimus delectus?</li>
                <li>Lorem ipsum dolor sit amet.</li>
            </ol>
        </div>
        <div class="kolom kolom2">
            <img src="{{asset('assets/image/image.png')}}" alt="">
        </div>
    </section>

    <section class="flex-container">
        <div class="item">
            <p>Jumlah Kecamatan <br> 15</p>
        </div>
        <div class="item">
            <p>Jumlah Desa <br> 42</p>
        </div>
        <div class="item">
            <p>Jumlah Penduduk <br> 12.000</p>
        </div>
        <div class="item">
            <p>Data per Tahun <br> 2023</p>
        </div>
    </section>

    <section class="form-container">
        <div class="card form-card">
            <h2 style="text-align: center; margin-bottom: 20px;">Buat Pengaduan</h2>
            {{--menampilkan error validasi--}}
            @if ($errors->any())
            <ul style="width: 100%; background:red; padding: 10px">
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
            @endif

            {{--menampilkan notif tambah data--}}
@if (Session::get('success'))
<div style="width: 100%; background: green; padding: 10px">
    {{Session::get('success') }}
</div>
@endif

            <form action="{{route('store')}}" method="POST" enctype="multipart/form-data">
                @csrf    
                <div class="input-card">
                    <label for="">NIK :</label>
                    <input type="number" name="nik" id="">
                </div>
                <div class="input-card">
                    <label for="">Nama Lengkap :</label>
                    <input type="text" name="nama" id="">
                </div>
                <div class="input-card">
                    <label for="">No Telp :</label>
                    <input type="number" name="no_telp" id="">
                </div>
                <div class="input-card">
                    <label for="">Pengaduan :</label>
                    <textarea rows="5" name="pengaduan"></textarea>
                </div>
                <div class="input-card">
                    <label for="">Upload Gambar Terkait :</label>
                    <input type="file" name="foto">
                </div>
                <button type="submit">Kirim</button>
            </form>
        </div>
        <div class="card laporan-card">
            <h2>Laporan Pengaduan</h2>
            @foreach ($reports as $report)
            <div class="article">

                {{--CARBON : mengelola tanggal. parse untuk ambil data tglnya format untuk mengubah tampilan tglnya--}}
                <p>{{\Carbon\Carbon::parse($report['created_at'])->format('j F, Y') }}:{{$report['nama']}}</p>
                <div class="content">
                    <div class="text">
                        {{$report['pengaduan']}}
                    </div>
                    <div>
                        <img src="{{asset('assets/image/'.$report->foto)}}" alt="">
                    </div>
                </div>
                @endforeach

{{--memunculkan button pagination--}}

<div style="display: flex; justify-content: flex-end; margin-top: 10px">
                {!! $reports->links()!!}
</div>
            </div>
    </section>

    <footer>
        Copyright &copy; 2023;
    </footer>
</body>

</html>




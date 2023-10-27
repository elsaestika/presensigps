<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>
  <style>
    #title {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 18px;
        font-weight: bold;
    }

    .tabeldatakaryawan {
        margin-top: 40px;
    }

    .tabeldatakaryawan td {
        padding: 5px;
    }

    .tabelpresensi {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    .tabelpresensi tr th{
        border: 1px solid #000000 ;
        padding: 8px; 
        background-color: #c7c7c7;
    }

    .tabelpresensi tr td{
        border: 1px solid #000000 ;
        padding: 5px; 
    }

    .foto{
        width: 50px;
        height: 40px;
    }

    .footer{
        position: absolute;
        bottom: 10px;
        
    }
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">
    <?php
    function selisih($jam_masuk, $jam_keluar)
    {
        list($h, $m, $s) = explode(":", $jam_masuk);
            $dtAwal = mktime($h, $m, $s, "1", "1", "1");
            list($h, $m, $s) = explode(":", $jam_keluar);
            $dtAkhir = mktime($h, $m, $s, "1", "1", "1");
            $dtSelisih = $dtAkhir - $dtAwal;
            $totalmenit = $dtSelisih / 60;
            $jam = explode(".", $totalmenit / 60);
            $sisamenit = ($totalmenit / 60) - $jam[0];
            $sisamenit2 = $sisamenit * 60;
            $jml_jam = $jam[0];
            return $jml_jam . ":" . round($sisamenit2);
    }
?>


    <table style="width:100%">
        <tr>
            <td style="width: 30px">
                <?php
                    $path = public_path('assets/img/logopresensi.png');
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                ?>
                <img src="<?php echo $base64; ?>" width="80" height="90" alt="">
                {{-- <img src="{{ asset('assets/img/logopresensi.png') }}" width="80" height="90" alt=""> --}}
            </td>
            <td>
                <span id="title">
                    LAPORAN PRESENSI KARYAWAN <br>
                    PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }} <br>
                    PT. ELSA ESTIKA <br> 
                </span>
                <span><i>Jl. Ir. H. Juanda No.7a, Sukamulya, Kec. Bungursari, Kab. Tasikmalaya, Jawa Barat 46151</i></span>
            </td>
        </tr>
    </table>
    <table class="tabeldatakaryawan">
        <tr>
            <td rowspan="6">
                {{-- @php
                    $path = Storage::url('uploads/karyawan/' .$karyawan->foto);
                @endphp
                <img src="{{ url($path) }}" width="120" height="150" alt=""> --}}
            </td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $karyawan->nik }}</td>
        </tr>
        <tr>
            <td>Nama Karyawan</td>
            <td>:</td>
            <td>{{ $karyawan->nama_lengkap }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ $karyawan->jabatan }}</td>
        </tr>
        <tr>
            <td>Departemen</td>
            <td>:</td>
            <td>{{ $karyawan->nama_dept }}</td>
        </tr>
        <tr>
            <td>No Hp</td>
            <td>:</td>
            <td>{{ $karyawan->no_hp }}</td>
        </tr>
    </table>
    <table class="tabelpresensi">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>

            <th>Jam Pulang</th>
           
            <th>Keterangan</th>
            <th>Jml jam</th>
        </tr>
        @foreach ($presensi as $d)
        @php
           
            $jamterlambat = selisih('08:30:00', $d->jam_in);
        @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ date("d-m-Y",strtotime($d->tgl_presensi)) }}</td>
                <td>{{ $d->jam_in }}</td>
                
                <td>
                    {{ $d->jam_out != null ? $d->jam_out :'Belum Absen' }}
                </td>
                
                <td>
                    @if ($d->jam_in > '08:30')
                        Terlambat {{ $jamterlambat }}
                    @else
                        Tepat Waktu
                    @endif
                </td>
                <td>
                    @if ($d->jam_out != null)
                    @php
                      $jmljamkerja = selisih($d->jam_in,$d->jam_out); 
                    @endphp
                    @else
                    @php
                    $jmljamkerja = 0;  
                    @endphp
                    @endif
                    {{ $jmljamkerja }}
                </td>
            </tr>
        @endforeach

    </table>

    <table width="100%" style="margin-top: 100px">
        <tr>
            <td colspan="2" style="text-align: right">Tasikmalaya, {{ date('d-m-Y') }}</td>
        </tr>
        <tr>
            <td style="text-align: center; vertical-align:bottom" height="100">
                <u>Elsa Estika</u><br>
                <i><b>HRD Manager</i>
            </td>
            <td style="text-align: center; vertical-align:bottom">
                <u>Riyanda</u><br>
                <i><b>Direktur</i>
            </td>
        </tr>
    </table>
    <div class="footer">
        Downloaded by {{ Auth::user()->name }} {{ date("d-m-Y H:i:s") }}
    </div>

</body>

</html>
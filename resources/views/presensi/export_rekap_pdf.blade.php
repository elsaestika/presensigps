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
        font-size: 10px;
    }

    .tabelpresensi tr td{
        border: 1px solid #000000 ;
        padding: 5px; 
    }

    .foto{
        width: 50px;
        height: 40px;
    }
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4 landscape">
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

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
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
                    REKAP PRESENSI KARYAWAN <br>
                    PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }} <br>
                    PT. ELSA ESTIKA <br> 
                </span>
                <span><i>Jl. Ir. H. Juanda No.7a, Sukamulya, Kec. Bungursari, Kab. Tasikmalaya, Jawa Barat 46151</i></span>
            </td>
        </tr>
    </table>
    <table class="tabelpresensi">
        <tr>
            <th rowspan="2">Nik</th>
            <th rowspan="2">Nama Karyawan</th>
            <th colspan="31">Tanggal</th>
            <th rowspan="2">TH</th>
            <th rowspan="2">TT</th>

        </tr>
        <tr>
            <?php
                for($i=1; $i<=31; $i++){
                    $tgl = "tgl_".$i;
            ?>
            <th>{{ $i }}</th>
            <?php
                }
            ?>
            
        </tr>
        @foreach ($rekap as $d)
            <tr>
                <td>{{ $d->nik }}</td>
                <td>{{ $d->nama_lengkap }}</td>
                
                <?php
                $totalhadir = 0;
                $totalterlambat = 0;
                for($i=1; $i<=31; $i++){
                    $tgl = "tgl_".$i;
                    if(empty($d->$tgl)){
                        $hadir = ['',''];
                        $totalhadir += 0;
                    }else{
                        $hadir = explode("-",$d->$tgl);
                        $totalhadir += 1;
                        if($hadir[0] > "08:30"){
                            $totalterlambat += 1;
                        }
                    }
                ?>

                <td class="text-center">
                   <span>{{ !empty($hadir[0]) ? $hadir[0] : '-' }}</span> <br>
                   <span>{{ !empty($hadir[1]) ? $hadir[1] : '-' }}</span> 
                </td>
                <?php
                    }
                ?>
                <td>{{ $totalhadir }}</td>
                <td>{{ $totalterlambat }}</td>

            </tr>
        @endforeach
    </table>
    <table width="100%" style="margin-top: 100px">
        <tr>
            <td></td>
            <td colspan="2" style="text-align: center">Tasikmalaya, {{ date('d-m-Y') }}</td>
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

</body>

</html>
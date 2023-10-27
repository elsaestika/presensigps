@extends('layouts.admin.tabler')
@section('title', 'Dashboard')
@section('content')
    <!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Overview
                </div>
                <h2 class="page-title">
                    Dashboard
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-md-12 col-lg-4 col-xl-3">
                <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="text-white avatar">
                            <!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-fingerprint" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M18.9 7a8 8 0 0 1 1.1 5v1a6 6 0 0 0 .8 3"></path>
                                <path d="M8 11a4 4 0 0 1 8 0v1a10 10 0 0 0 2 6"></path>
                                <path d="M12 11v2a14 14 0 0 0 2.5 8"></path>
                                <path d="M8 15a18 18 0 0 0 1.8 6"></path>
                                <path d="M4.9 19a22 22 0 0 1 -.9 -7v-1a8 8 0 0 1 12 -6.95"></path>
                             </svg> --}}
                             <img src="{{ asset('assets/img/karyawan.webp') }}" alt="">
                        </span>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">
                          {{ $rekappresensi->jmlhadir }}
                        </div>
                        <div class="text-secondary">
                            Karyawan Hadir
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <div class="col-md-12 col-lg-4 col-xl-3">
                <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class=" text-white avatar">
                            <!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-text" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                <path d="M9 9l1 0"></path>
                                <path d="M9 13l6 0"></path>
                                <path d="M9 17l6 0"></path>
                             </svg> --}}
                             <img src="{{ asset('assets/img/izin.webp') }}" alt="">
                        </span>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">
                            {{-- {{ $rekapizin->jmlizin != null ? $rekapizin->jmlizin : 0 }} --}}
                            {{ $rekapizin }}
                        </div>
                        <div class="text-secondary">
                             Karyawan Izin
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <div class="col-md-12 col-lg-4 col-xl-3">
                <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class=" text-white avatar">
                            <!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mood-sick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 21a9 9 0 1 1 0 -18a9 9 0 0 1 0 18z"></path>
                                <path d="M9 10h-.01"></path>
                                <path d="M15 10h-.01"></path>
                                <path d="M8 16l1 -1l1.5 1l1.5 -1l1.5 1l1.5 -1l1 1"></path>
                             </svg> --}}
                             <img src="{{ asset('assets/img/sick.webp') }}" alt="">
                        </span>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">
                          {{-- {{ $rekapizin->jmlsakit != null ? $rekapizin->jmlsakit : 0 }} --}}
                          {{ $rekapsakit }}

                        </div>
                        <div class="text-secondary">
                            Karyawan Sakit
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-lg-4 col-xl-3">
                <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="text-white avatar">
                            <!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alarm-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M16 6.072a8 8 0 1 1 -11.995 7.213l-.005 -.285l.005 -.285a8 8 0 0 1 11.995 -6.643zm-4 2.928a1 1 0 0 0 -1 1v3l.007 .117a1 1 0 0 0 .993 .883h2l.117 -.007a1 1 0 0 0 .883 -.993l-.007 -.117a1 1 0 0 0 -.993 -.883h-1v-2l-.007 -.117a1 1 0 0 0 -.993 -.883z" stroke-width="0" fill="currentColor"></path>
                                <path d="M6.412 3.191a1 1 0 0 1 1.273 1.539l-.097 .08l-2.75 2a1 1 0 0 1 -1.273 -1.54l.097 -.08l2.75 -2z" stroke-width="0" fill="currentColor"></path>
                                <path d="M16.191 3.412a1 1 0 0 1 1.291 -.288l.106 .067l2.75 2a1 1 0 0 1 -1.07 1.685l-.106 -.067l-2.75 -2a1 1 0 0 1 -.22 -1.397z" stroke-width="0" fill="currentColor"></path>
                             </svg> --}}
                             <img src="{{ asset('assets/img/terlambat.webp') }}" alt="">
                        </span>
                      </div>
                      <div class="col">
                        <div class="font-weight-medium">
                            {{  $rekappresensi->jmlterlambat != null ? $rekappresensi->jmlterlambat : 0 }}
                        </div>
                        <div class="text-secondary">
                            Karyawan Terlambat
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 col-lg-4 col-xl-3">
                    <div class="card">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="avatar">
                                <!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                 </svg> --}}
                                 <img src="{{ asset('assets/img/people.webp') }}" alt="" width="100%">
                            </span>
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                              {{-- {{ $rekappresensi->jmlhadir }} --}}
                              {{ $karyawan }}
                            </div>
                            <div class="text-secondary">
                                Jumlah Karyawan
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
            <div class="row">
              <div class="col-12">
                <canvas id="myChart" width="600" height="250"  ></canvas>
              </div>
            </div>
        </div>
    </div>

@endsection
@push('myscript')
    <script>
      var tgl_1 = "{{ $datagrafik->tgl_1 }}";
      var tgl_2 = "{{ $datagrafik->tgl_2 }}";
      var tgl_3 = "{{ $datagrafik->tgl_3 }}";
      var tgl_4 = "{{ $datagrafik->tgl_4 }}";
      var tgl_5 = "{{ $datagrafik->tgl_5 }}";
      var tgl_6 = "{{ $datagrafik->tgl_6 }}";
      var tgl_7 = "{{ $datagrafik->tgl_7 }}";
      var tgl_8 = "{{ $datagrafik->tgl_8 }}";
      var tgl_9 = "{{ $datagrafik->tgl_9 }}";
      var tgl_10 = "{{ $datagrafik->tgl_10 }}";
      var tgl_11 = "{{ $datagrafik->tgl_11 }}";
      var tgl_12 = "{{ $datagrafik->tgl_12 }}";
      var tgl_13 = "{{ $datagrafik->tgl_13 }}";
      var tgl_14 = "{{ $datagrafik->tgl_14 }}";
      var tgl_15 = "{{ $datagrafik->tgl_15 }}";
      var tgl_16 = "{{ $datagrafik->tgl_16 }}";
      var tgl_17 = "{{ $datagrafik->tgl_17 }}";
      var tgl_18 = "{{ $datagrafik->tgl_18 }}";
      var tgl_19 = "{{ $datagrafik->tgl_19 }}";
      var tgl_20 = "{{ $datagrafik->tgl_20 }}";
      var tgl_21 = "{{ $datagrafik->tgl_21 }}";
      var tgl_22 = "{{ $datagrafik->tgl_22 }}";
      var tgl_23 = "{{ $datagrafik->tgl_23 }}";
      var tgl_24 = "{{ $datagrafik->tgl_24 }}";
      var tgl_25 = "{{ $datagrafik->tgl_25 }}";
      var tgl_26 = "{{ $datagrafik->tgl_26 }}";
      var tgl_27 = "{{ $datagrafik->tgl_27 }}";
      var tgl_28 = "{{ $datagrafik->tgl_28 }}";
      var tgl_29 = "{{ $datagrafik->tgl_29 }}";
      var tgl_30 = "{{ $datagrafik->tgl_30 }}";
      aDatasets1 = [tgl_1,tgl_2,tgl_3,tgl_4,tgl_5,tgl_6,tgl_7,tgl_8,tgl_9,tgl_10,tgl_11,tgl_12,tgl_13,
      tgl_14,tgl_15,tgl_16,tgl_17,tgl_18,tgl_19,tgl_20,tgl_21,tgl_22,tgl_23,tgl_24,tgl_25,tgl_26,tgl_27,
      tgl_28,tgl_29,tgl_30];
      datatanggal = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30];
      var ctx = document.getElementById("myChart");
      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: datatanggal,

              datasets: [ {
                    label: 'Hadir',
                    fill:false,
                  data: aDatasets1,
                  backgroundColor: '#8FBC8F',
                  borderColor: [
                      'rgb(143, 188, 144)',
                      // 'rgb(143, 188, 144)',
                      // 'rgb(143, 188, 144)',
                      // 'rgb(143, 188, 144)',
                      // 'rgb(143, 188, 144)',
                      // 'rgb(143, 188, 144)',
                  ],
                  borderWidth: 1
              }, ]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero:true
                      }
                  }]
              },
              title: {
                  display: true,
                  text: 'Data Karyawan'
              },
              responsive: true,

            tooltips: {
                  callbacks: {
                      labelColor: function(tooltipItem, chart) {
                          return {
                              borderColor: 'rgb(143, 188, 144)',
                              backgroundColor: 'rgb(143, 188, 144)'
                          }
                      }
                  }
              },
              legend: {
                  labels: {
                      // This more specific font property overrides the global property
                      // fontColor: 'red',

                  }
              }
          }
      });
    </script>
@endpush

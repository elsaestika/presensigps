@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                    Data Pengajuan
                </h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body ">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <form action="/presensi/izinsakit" method="GET" autocomplete="off">


                </form>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-body">
            <div class="col-12">
                <table class="table table-hover" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode izin</th>
                            <th>Tanggal</th>
                            <th>Nik</th>
                            <th>Nama Karyawan</th>
                            <th>Jabatan</th>
                            <th>Dept</th>
                            <th>Kantor</th>
                            <th>Status</th>
                            <th>Ket</th>
                            <th>Status Approve</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($izinsakit as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->kode_izin }}</td>
                                <td>{{ date('d-m-Y',strtotime( $d->tgl_izin_dari)) }}/{{ date('d-m-Y',strtotime( $d->tgl_izin_sampai)) }}</td>
                                <td>{{ $d->nik  }}</td>
                                <td>{{ $d->nama_lengkap }}</td>
                                <td>{{ $d->jabatan }}</td>
                                <td>{{ $d->kode_dept }}</td>
                                <td>{{ $d->kode_cabang }}</td>
                                {{-- <td>{{ $d->status =="i" ? "Izin" : "s" ? "Sakit" : "Cuti" }}</td> --}}
                                    @if ($d->status == "i")
                                    <td>Izin</td>
                                    @elseif($d->status == "s")
                                    <td>Sakit</td>
                                    @else
                                    <td>Cuti</td>
                                    @endif
                                <td>{{ $d->keterangan }}</td>
                                <td>
                                    @if ($d->status_approved == 1)
                                        <span class="badge bg-success">Disetujui</span>
                                    @elseif($d->status_approved == 2)
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($d->status_approved == 0)
                                    <a href="/presensi/approveizinsakit" class="btn btn-primary btn-sm" id="approve" kode_izin_izinsakit = "{{ $d->kode_izin }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-external-link" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6"></path>
                                            <path d="M11 13l9 -9"></path>
                                            <path d="M15 4h5v5"></path>
                                         </svg>
                                    </a>
                                    @else
                                    <a href="/presensi/{{ $d->kode_izin }}/batalkanizinsakit" class="btn btn-sm bg-danger text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-rounded-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M10 10l4 4m0 -4l-4 4"></path>
                                            <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z"></path>
                                         </svg>
                                         Batalkan
                                    </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{ $izinsakit->links('vendor.pagination.bootstrap-4') }} --}}
            </div>
        </div>
    </div>
</div>
    </div>
</div>
<div class="modal modal-blur fade" id="modal-izinsakit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Aksi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/presensi/approveizinsakit" method="POST">
                @csrf
                <input type="hidden" id="kode_izin" name="kode_izin">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <select name="status_approved" id="status_approved" class="form-select">
                                <option value="1">Disetujui</option>
                                <option value="2">Ditolak</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="form-group">
                            <button class="btn btn-primary w-100" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10 14l11 -11"></path>
                                    <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5"></path>
                                 </svg>
                                 Submit
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('myscript')
    <script>
        $(function(){
            $("#approve").click(function(e){
                e.preventDefault();
                var kode_izin_izinsakit = $(this).attr("kode_izin_izinsakit");
                $("#kode_izin").val(kode_izin_izinsakit);
                $("#modal-izinsakit").modal("show");
            });

            $("#dari, #sampai").datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });
        });
    </script>
@endpush

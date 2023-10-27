@extends('layouts.presensi')
@section('title','Edit Profile')
@section('header')
 <!-- App Header -->
 <div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTittle">Edit Profile</div>
    <div class="right">
    </div>
 </div>
 <!-- App Header -->
@endsection

@section('content')
<div class="row py-0" style="margin-top: 2rem">
    <div class="col mt-2 pt-2">
        @php
            $messagesuccess = Session::get('success');
            $messageerror = Session::get('error');
        @endphp
        @if (Session::get('success'))
            <div class="alert alert-success">
                {{ $messagesuccess }}
            </div>
        @endif
        @if (Session::get('error'))
            <div class="alert alert-danger">
                {{ $messageerror }}
            </div>
        @endif

        @error('foto')
            <div class="alert alert-warning">
                <p>{{ $message }}</p>
            </div>
        @enderror
    </div>
</div>
<form action="/presensi/{{ $karyawan->nik }}/updateprofile" method="POST" enctype="multipart/form-data" style="margin-top: 4rem">
    @csrf
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label for="form" class="form-label fw-bold">Nama lengkap</label>
                        <input type="text" class="form-control" value="{{ $karyawan->nama_lengkap }}" name="nama_lengkap" placeholder="Nama Lengkap" autocomplete="off">
                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label for="form" class="form-label fw-bold">No hp</label>
                        <input type="text" class="form-control" value="{{ $karyawan->no_hp }}" name="no_hp" placeholder="No. HP" autocomplete="off">
                    </div>
                </div>
                    <div class="form-group boxed">
                <div class="input-wrapper">
                    <label for="form" class="form-label fw-bold">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off" value="{{ $karyawan->password }}">
                </div>
                </div>
                <div class="custom-file-upload" id="fileUpload1">
                    <input type="file" name="foto" id="fileuploadInput" accept=".png, .jpg, .jpeg">
                    <label for="fileuploadInput">
                        <span>
                            <strong>
                                <p class="text-danger">*foto harus ukuran 1:1</p>
                                <ion-icon name="cloud-upload-outline" role="img" class="md hydrated" aria-label="cloud upload outline"></ion-icon>
                                <i>Tap to Upload</i>
                            </strong>
                        </span>
                    </label>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <button type="submit" class="btn btn-primary btn-block">
                            <ion-icon name="refresh-outline"></ion-icon>
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

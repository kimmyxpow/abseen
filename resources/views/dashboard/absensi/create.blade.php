@extends('layouts.app')

@section('title', 'Tambah Data Absensi | Abseen')

@section('heading')
   <div class="pt-4 pb-2">
      <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
         <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
               <a href="/dashboard">
                  <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                     </path>
                  </svg>
               </a>
            </li>
            <li class="breadcrumb-item"><a href="/dashboard/absensi">Absensi</a></li>
            <li class="breadcrumb-item active"><a href="/dashboard/absensi/create">Tambah Data Absensi</a></li>
         </ol>
      </nav>
      <div class="d-flex justify-content-between align-items-center w-100 flex-wrap">
         <h1 class="h4 mb-3 mb-lg-0">Tambah Data Absensi</h1>
         <a href="/dashboard/absensi/" class="btn btn-primary">
            &leftarrow; Kembali
         </a>
      </div>
   </div>
@endsection

@section('content')
   <div class="card border-0 shadow mb-4">
      <div class="card-header">
         <p class="m-0">Silakan isi form berikut ini!</p>
         <b class="text-danger"><em>Data {{ $create }} tidak bisa di edit setelah di submit! Maka dari itu pastikan sudah tepat sebelum di submit!</em></b>
      </div>
      <div class="card-body">
         <form action="/dashboard/absensi/create" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
               <div class="col-sm-6">
                  <div class="mb-4">
                     <label for="name">Nama Absensi:</label>
                     <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                        autofocus required autocomplete="off" value="{{ old('name') }}">
                     @error('name')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="mb-4">
                     <label for="{{ $create }}">Diperuntukkan Untuk {{ $create }}:</label>
                     <select class="form-select @error($create) is-invalid @enderror" name="{{ $create }}" id="{{ $create }}" required
                        autocomplete="off">
                        <option value="" disabled selected>- Pilih -</option>
                        @foreach ($data as $row)
                           <option {{ $row->id == old($create) ? 'selected' : '' }} value="{{ $row->id }}">
                              {{ $row->name }}</option>
                        @endforeach
                     </select>
                     @error($create)
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
         </form>
      </div>
   </div>
@endsection

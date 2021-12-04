@extends('layouts.app')

@section('title', 'Edit Data Siswa ' . $data->name . ' | Abseen')

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
            <li class="breadcrumb-item"><a href="/dashboard/user">User</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/user/siswa">Siswa</a></li>
            <li class="breadcrumb-item active"><a href="/dashboard/user/siswa/{{ $data->id }}/edit">Edit Data Siswa
                  {{ $data->name }}</a></li>
         </ol>
      </nav>
      <div class="d-flex justify-content-between align-items-center w-100 flex-wrap">
         <h1 class="h4 mb-3 mb-lg-0">Edit Data Siswa {{ $data->name }}</h1>
         <a href="/dashboard/user/siswa/" class="btn btn-primary">
            &leftarrow; Kembali
         </a>
      </div>
   </div>
@endsection

@section('content')
   <div class="card border-0 shadow mb-4">
      <div class="card-header">
         Silakan isi form berikut ini!
      </div>
      <div class="card-body">
         <form action="/dashboard/user/siswa/{{ $data->id }}/edit" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
               <div class="col-sm-6">
                  <div class="mb-4">
                     <label for="name">Nama Siswa:</label>
                     <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                        autofocus required autocomplete="off" value="{{ old('name', $data->name) }}">
                     @error('name')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="mb-4">
                     <label for="nis">NIS Siswa:</label>
                     <input type="number" class="form-control @error('nis') is-invalid @enderror" name="nis" id="nis"
                        required autocomplete="off" value="{{ old('nis', $data->nis) }}">
                     @error('nis')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="mb-4">
                     <label for="rombel">Rombel Siswa:</label>
                     <select class="form-select @error('rombel') is-invalid @enderror" name="rombel" id="rombel" required
                        autocomplete="off">
                        <option disabled selected>- Pilih -</option>
                        @foreach ($rombel as $row)
                           <option {{ $row->id == old('rombel', $data->rombel_id) ? 'selected' : '' }}
                              value="{{ $row->id }}">
                              {{ $row->name }}</option>
                        @endforeach
                     </select>
                     @error('rombel')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="mb-4">
                     <label for="rayon">Rayon Siswa:</label>
                     <select class="form-select @error('rayon') is-invalid @enderror" name="rayon" id="rayon" required
                        autocomplete="off">
                        <option disabled selected>- Pilih -</option>
                        @foreach ($rayon as $row)
                           <option {{ $row->id == old('rayon', $data->rayon_id) ? 'selected' : '' }}
                              value="{{ $row->id }}">
                              {{ $row->name }}</option>
                        @endforeach
                     </select>
                     @error('rayon')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="mb-4">
                     <label for="username">Username Siswa:</label>
                     <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                        id="username"
                        required autocomplete="off" value="{{ old('username', $data->username) }}">
                     @error('username')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="mb-4">
                     <label for="email">Email Siswa:</label>
                     <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                        required autocomplete="off" value="{{ old('email', $data->email) }}">
                     @error('email')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="mb-4">
                     <label for="password">Password Baru Siswa (Tidak Wajib):</label>
                     <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                        id="password" autocomplete="new-password">
                     @error('password')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="mb-4">
                     <label for="password_confirmation">Konfirmasi Password Baru Siswa (Tidak Wajib):</label>
                     <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                        name="password_confirmation" id="password_confirmation">
                     @error('password_confirmation')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
            </div>
            <div class="mb-3">
               <label for="avatar" class="form-label">Avatar Siswa (Tidak Wajib)</label>
               <input class="form-control @error('avatar') is-invalid @enderror" name="avatar" type="file" id="avatar">
               @error('avatar')
                  <div class="invalid-feedback">
                     {{ $message }}
                  </div>
               @enderror
            </div>
            <img class="img-preview img-thumbnail mb-3" style="display: block;" src="{{ $data->avatar }}" alt="">
            <button class="btn btn-primary" type="submit">Submit</button>
         </form>
      </div>
   </div>
   <script>
      document.querySelector('#avatar').addEventListener('change', function(event) {
         if (event.target.files.length > 0) {
            const src = URL.createObjectURL(event.target.files[0]);
            const preview = document.querySelector(".img-preview");
            preview.src = src;
            preview.style.display = "block";
         }
      });
   </script>
@endsection

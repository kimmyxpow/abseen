@extends('layouts.app')

@section('title', 'Tambah Data Admin | Abseen')

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
            <li class="breadcrumb-item"><a href="/dashboard/user/admin">Admin</a></li>
            <li class="breadcrumb-item active"><a href="/dashboard/user/admin/create">Tambah Data Admin</a></li>
         </ol>
      </nav>
      <div class="d-flex justify-content-between align-items-center w-100 flex-wrap">
         <h1 class="h4 mb-3 mb-lg-0">Tambah Data Admin</h1>
         <a href="/dashboard/user/admin/" class="btn btn-primary">
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
         <form action="/dashboard/user/admin/create" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
               <label for="name">Nama Admin:</label>
               <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                  autofocus required autocomplete="off" value="{{ old('name') }}">
               @error('name')
                  <div class="invalid-feedback">
                     {{ $message }}
                  </div>
               @enderror
            </div>
            <div class="row">
               <div class="col-sm-6">
                  <div class="mb-4">
                     <label for="username">Username Admin:</label>
                     <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                        id="username"
                        required autocomplete="off" value="{{ old('username') }}">
                     @error('username')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="mb-4">
                     <label for="email">Email Admin:</label>
                     <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                        required autocomplete="off" value="{{ old('email') }}">
                     @error('email')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="mb-4">
                     <label for="password">Password Admin:</label>
                     <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                        id="password"
                        required autocomplete="new-password">
                     @error('password')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="mb-4">
                     <label for="password_confirmation">Konfirmasi Password Admin:</label>
                     <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                        name="password_confirmation" id="password_confirmation"
                        required>
                     @error('password_confirmation')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
            </div>
            <div class="mb-3">
               <label for="avatar" class="form-label">Avatar Admin (Tidak Wajib)</label>
               <input class="form-control @error('avatar') is-invalid @enderror" name="avatar" type="file" id="avatar">
               @error('avatar')
                  <div class="invalid-feedback">
                     {{ $message }}
                  </div>
               @enderror
            </div>
            <img class="img-preview img-thumbnail mb-3" src="" style="display: none;" alt="">
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

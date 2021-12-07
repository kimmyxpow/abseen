@extends('layouts.app')

@section('title', 'All User | Abseen')

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
         </ol>
      </nav>
      <div class="d-flex justify-content-between align-items-center w-100 flex-wrap">
         <h1 class="h4 mb-3 mb-lg-0">Data All Users</h1>
      </div>
   </div>
@endsection

@section('content')
   <div class="card border-0 shadow mb-4">
      <div class="card-header">
         <div class="input-group input-group-merge search-bar">
            <span class="input-group-text" id="topbar-addon">
               <svg class="icon icon-xs" x-description="Heroicon name: solid/search"
                  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd"
                     d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                     clip-rule="evenodd"></path>
               </svg>
            </span>
            <input type="text" class="form-control" id="topbarInputIconLeft" placeholder="Cari user..."
               aria-label="Search" aria-describedby="topbar-addon">
         </div>
      </div>
      <div class="card-body">
         <div class="table-responsive mb-3">
            <table class="table table-centered table-nowrap mb-0 rounded">
               <thead class="thead-light">
                  <tr>
                     <th class="border-0 rounded-start">#</th>
                     <th class="border-0">Avatar</th>
                     <th class="border-0">Nama</th>
                     <th class="border-0">Role</th>
                     <th class="border-0">NIS</th>
                     <th class="border-0">Username</th>
                     <th class="border-0">Email</th>
                     <th class="border-0">Rayon</th>
                     <th class="border-0">Rombel</th>
                  </tr>
               </thead>
               <tbody>
                  @if (count($data))
                     @foreach ($data as $row)
                        <tr>
                           <td class="text-primary fw-bold">
                              {{ ++$i }}
                           </td>
                           <td>
                              <img width="60" height="60" style="min-height: 60px; min-width: 60px;"
                                 class="rounded-circle img-thumbnail" src="{{ $row->avatar }}"
                                 alt="{{ $row->name }}">
                           </td>
                           <td class="fw-bold">
                              {{ $row->name }}
                           </td>
                           <td class="fw-bold">
                              {{ $row->role }}
                           </td>
                           <td class="fw-bold">
                              {{ $row->nis ?? '-' }}
                           </td>
                           <td class="fw-bold">
                              {{ $row->username }}
                           </td>
                           <td class="fw-bold">
                              {{ $row->email }}
                           </td>
                           <td class="fw-bold">
                              {{ $row->rayon->name ?? '-' }}
                           </td>
                           <td class="fw-bold">
                              {{ $row->rombel->name ?? '-' }}
                           </td>
                        </tr>
                     @endforeach
                  @else
                     <tr>
                        <td colspan="7">
                           Data Kosong
                        </td>
                     </tr>
                  @endif
               </tbody>
            </table>
         </div>
         {{ $data->links() }}
      </div>
   </div>
@endsection

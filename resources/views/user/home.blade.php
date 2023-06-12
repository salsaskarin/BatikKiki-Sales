<x-app-layout>
    <x-slot name="header">
    @section('title','Pegawai | Batik Kiki Sales')
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h4 class="font-semibold text-gray-800 leading-tight">
            {{ __('Daftar Pegawai') }}
        </h4>
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div> 
        @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <div class="row justify-content-between">
                    <div class="col-3">
                    <a href="/user/tambahUser" class="btn btn-outline-primary mb-4">Tambah Pegawai</a>
                    </div>
                    <div class="col-3">
                    <form class="form" method="get" action="{{ route('searchUser') }}">
                        <div class="form-group w-100 mb-3">
                            <input type="text" name="search" class="form-control w-75 d-inline" id="search" placeholder="Nama Pegawai">
                            <button type="submit" class="btn btn-outline-secondary mb-1">Cari</button>
                            <a class="btn btn-outline-danger" href="/user">Reset filter</a>
                        </div>
                    </form>
                    </div>
                </div>
                
                <div class="table-responsive">
                <table class="table table-bordered table-hover text-center">
                                <thead class="border-success">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Nomor Telepon</th>
                                        <th>Alamat</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($user as $user)
                                    <tr>
                                        <th>{{$loop->index+1}}</th>
                                        <th>{{$user->name}}</th>
                                        <th>{{$user->email}}</th>
                                        <th>{{$user->phone}}</th>
                                        <th>{{$user->address}}</th>
                                        @if($user->is_Admin == 1 )
                                        <th>Admin</th>
                                        @else
                                        <th>Pegawai</th>
                                        @endif
                                    <th class="col-md-3">
                                        <div class="row justify-content-center">
                                        <div class="col-2">
                                                <a href="/user/editUser/{{$user->id}}" class="btn btn-warning btn-sm">Edit</a>
                                            </div>
                                            <div class="col-6">
                                                <form action="/user/makeAdmin/{{$user->id}}" method="POST">
                                                    {{ csrf_field() }}
                                                    <!-- <input type="hidden" name="id" value=""> -->
                                                    <input type="hidden" name="isAdmin" value=1>
                                                    <button type="submit" class="btn btn-success btn-sm">Jadikan admin</button>
                                                </form>
                                                
                                            </div>
                                        </div>
                                        <div class="row justify-content-center mt-1">
                                            <div class="col-2">
                                                <a href="/user/hapusUser/{{$user->id}}" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin akan menghapus data pegawai ini?');">Delete</a>
                                            </div>                                        
                                            <div class="col-6">
                                                <form action="user/makeAdmin/{{$user->id}}" method="POST">
                                                    {{ csrf_field() }}
                                                    <!-- <input type="hidden" name="id" value=""> -->
                                                    <input type="hidden" name="isAdmin" value=0>
                                                    <button type="submit" class="btn btn-info btn-sm">Hapus admin</button>
                                                </form>
                                            </div>
                                        </div>
                                    </th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

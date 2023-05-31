<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <a href="/user/tambahUser" class="btn btn-primary mb-4">Tambah Pegawai</a>
                <table class="table table-bordered table-hover text-center">
                                <thead>
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
                                    <th class="col-md-4">
                                        <div class="row justify-content-center">
                                        <div class="col-sm-auto">
                                                <a href="/user/editUser/{{$user->id}}" class="btn btn-warning">Edit</a>
                                            </div>
                                            <div class="col-sm-auto">
                                                <a href="/user/hapusUser/{{$user->id}}" class="btn btn-danger">Delete</a>
                                            </div>
                                            <div class="col-sm-auto">
                                                <form action="/user/makeAdmin/{{$user->id}}" method="POST">
                                                    {{ csrf_field() }}
                                                    <!-- <input type="hidden" name="id" value=""> -->
                                                    <input type="hidden" name="isAdmin" value=1>
                                                    <button type="submit" class="btn btn-success">Jadikan admin</button>
                                                </form>
                                            </div>                                        <div class="col-sm-auto">
                                                <form action="user/makeAdmin/{{$user->id}}" method="POST">
                                                    {{ csrf_field() }}
                                                    <!-- <input type="hidden" name="id" value=""> -->
                                                    <input type="hidden" name="isAdmin" value=0>
                                                    <button type="submit" class="btn btn-info">Hapus admin</button>
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
</x-app-layout>

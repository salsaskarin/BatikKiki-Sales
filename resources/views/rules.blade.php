<x-app-layout>
    <x-slot name="header">
    @section('title','Petunjuk | Batik Kiki Sales')
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h4 class="font-semibold text-gray-800 leading-tight">
            {{ __('Petunjuk dan Peraturan untuk Pegawai') }}
        </h4>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <small class="font-semibold text-gray-600 leading-tight" >Perhatikan semua keterangan di bawah ini.</small>
                    <h5 class="font-semibold text-gray-800 leading-tight mt-4" >1. Pegawai wajib untuk mecatat semua transaksi yang dilakukan.</h5>
                    <small class="font-semibold text-gray-600 leading-tight" >- Akses halaman menu "Penjualan" pada sidebar</small><br>
                    <small class="font-semibold text-gray-600 leading-tight" >- Tombol "Tambah Penjualan" untuk menambah catatan transaksi penjualan</small><br>
                    <small class="font-semibold text-gray-600 leading-tight" >- Tombol "Edit" untuk mengubah catatan transaksi penjualan</small><br>
                    <small class="font-semibold text-gray-600 leading-tight" >- Tombol "Delete" untuk menghapus catatan transaksi penjualan</small><br>
                    <small class="font-semibold text-gray-600 leading-tight" >- Gunakan kotak filter tanggal untuk melihat transaksi penjualan dalam rentang waktu yang diinginkan</small><br><br>
                    <small class="font-semibold text-gray-600 leading-tight" >Jika transaksi tidak dapat dihitung per satuan, form "Harga" tidak perlu diisi, cukup isi jumlah harga keseluruhan dalam form "Total Harga"</small><br>

                    <h5 class="font-semibold text-gray-800 leading-tight mt-4" >2. Perbarui data produk.</h5>
                    <small class="font-semibold text-gray-600 leading-tight" >- Akses halaman menu "Produk" pada sidebar</small><br>
                    <small class="font-semibold text-gray-600 leading-tight" >- Tombol "Details" untuk melihat informasi lengkap tentang produk</small><br>
                    <small class="font-semibold text-gray-600 leading-tight" >- Tombol "Tambah Produk" untuk menambah data produk</small><br>
                    <small class="font-semibold text-gray-600 leading-tight" >- Tombol "Edit" untuk mengubah data produk</small><br>
                    <small class="font-semibold text-gray-600 leading-tight" >- Tombol "Delete" untuk menghapus data produk</small><br>
                    <small class="font-semibold text-gray-600 leading-tight" >- Gunakan kotak pencarian untuk mmencari nama produk</small><br>

                    <h5 class="font-semibold text-gray-800 leading-tight mt-4" >3. Dilarang untuk manipulasi data.</h5>
                    <small class="font-semibold text-gray-600 leading-tight" >Bagi pegawai yang melakukan manipulasi data baik data pribadi, produk, dan transaksi akan diberikan sanksi tegas SP 1 sampai surat pengeluaran</small><br>

                    <h5 class="font-semibold text-gray-800 leading-tight mt-4" >4. Jaga data pribadi.</h5>
                    <small class="font-semibold text-gray-600 leading-tight" >Data akun seperti email dan kata sandi tidak boleh diketahui oleh orang lain. Jika kata sandi telah bocor, ubah kata sandi anda pada menu "Profil" pada navigation bar</small><br>

                    <h5 class="font-semibold text-gray-800 leading-tight mt-4" >5. Lupa kata sandi.</h5>
                    <small class="font-semibold text-gray-600 leading-tight" >Jika anda lupa kata sandi, klik tombol "Lupa kata sandi" pada halaman login, lalu memasukkan email aktif anda dan cek inbox email untuk reset password</small><br>
                    <small class="font-semibold text-gray-600 leading-tight" >Jika anda tidak memiliki email aktif, hubungi pihak admin untuk ditindak lanjut</small><br>
                
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

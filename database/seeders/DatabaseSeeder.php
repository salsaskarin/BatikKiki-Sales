<?php


namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = new User;
        $user->name = "Admin";
        $user->email = "admin@mail.com";
        $user->password = Hash::make('12341234');
        $user->phone = "081284423527";
        $user->is_Admin = "1";
        $user->save();
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallets;
use App\Models\Category;
use App\Models\Products;
use App\Models\Students;
use App\Models\Transactions;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FirstSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "Admin",
            'username' => "admin",
            'password' => Hash::make('123'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => "Tenizen Bank",
            'username' => "bank",
            'password' => Hash::make('123'),
            'role' => 'bank'
        ]);
        User::create([
            'name' => "Tenizen Kantin",
            'username' => "kantin",
            'password' => Hash::make('123'),
            'role' => 'kantin'
        ]);
        User::create([
            'name' => "Nadiyah",
            'username' => "nadiyah",
            'password' => Hash::make('1234'),
            'role' => 'siswa'
        ]);

        Students::create([
            'user_id' => "4",
            'nis' => 12345,
            'classroom' => "XII RPL"
        ]);

        Category::create([
            'name' => "Minuman"
        ]);

        Category::create([
            'name' => "Makanan"
        ]);

        Category::create([
            'name' => "Snack"
        ]);

        Products::create([
            'name' => "Lemon Tea",
            'price' => "5000",
            'stock' => 100,
            'photo' => "images/lemontea.jpeg",
            'description' => "Es Teh Lemon",
            'category_id' => 3,
            'stand' => 2
        ]);

        Products::create([
            'name' => "Meat Ball",
            'price' => "10000",
            'stock' => 50,
            'photo' => "images/bakso.jpeg",
            "description" => "Bakso Daging",
            'category_id' => 3,
            'stand' => 1,
           
        ]);

        Products::create([
            'name' => "Risoles",
            'price' => "3000",
            'stock' => 50,
            'photo' => "images/risol.jpeg",
            "description" => "Risol Mayo",
            'category_id' => 3,
            'stand' => 1,
           
        ]);

        Products::create([
            'name' => "Pisang Naget",
            'price' => "15000",
            'stock' => 50,
            'photo' => "images/pisangnaget.jpeg",
            "description" => "Pisang Naget Mantap",
            'category_id' => 3,
            'stand' => 1,
           
        ]);

        Products::create([
            'name' => "Boba",
            'price' => "8000",
            'stock' => 50,
            'photo' => "images/boba.jpeg",
            "description" => "Boba Tea",
            'category_id' => 3,
            'stand' => 2,
           
        ]);

        Products::create([
            'name' => "Donat",
            'price' => "3000",
            'stock' => 50,
            'photo' => "images/donatsagu.jpeg",
            "description" => "Donat Sagu",
            'category_id' => 3,
            'stand' => 2,
           
        ]);

        Wallets::create([
            'user_id' => 4,
            'credit' => 100000,
            'debit' => null,
            'description' => "Pembukaan tabungan"
        ]);

        Wallets::create([
            'user_id' => 4,
            'credit' => 15000,
            'debit' => null,
            'description' => "Pembelian"
        ]);

        Wallets::create([
            'user_id' => 4,
            'credit' => null,
            'debit' => 21000,
            'description' => "Pembelian"
        ]);

        Transactions::create([
            'user_id' =>  4,
            'product_id' => 1,
            'status' => 'di keranjang',
            'order_id' => 'INV_12345',
            'price' => 5000,
            'quantity' => 1
        ]);

        Transactions::create([
            'user_id' =>  4,
            'product_id' => 2,
            'status' => 'di keranjang',
            'order_id' => 'INV_12345',
            'price' => 10000,
            'quantity' => 1
        ]);

        Transactions::create([
            'user_id' =>  4,
            'product_id' => 3,
            'status' => 'di keranjang',
            'order_id' => 'INV_12345',
            'price' => 3000,
            'quantity' => 2
        ]);

        $total_debit = 0;

        $transaktions = Transactions::where('order_id' ==
        'INV_12345');

        foreach($transaktions as $transaction)
        {
            $total_price = $transaction->price * $transaction->quantity;
            $total_debit += $total_price;
        }

        Wallets::create([
            'user_id' => 4,
            'debit' => $total_debit,
            'description' => "Pembelian Product"
        ]);

        foreach($transaktions as $transaction)
        {
            Transactions::find($transaction->id)->update([
                'status' => 'dibayar'
            ]);
        }
        foreach($transaktions as $transaction)
        {
            Transactions::find($transaction->id)->update([
                'status' => 'diambil'
            ]);
        }
        foreach($transaktions as $transaction)
        {
            Transactions::find($transaction->id)->update([
                'status' => 'di keranjang'
            ]);
        }
    }
}

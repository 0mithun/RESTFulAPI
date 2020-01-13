<?php

use App\User;
use App\Product;
use App\Category;
use App\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         //$this->call(UsersTableSeeder::class);

        //DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        //User::turncate();
        // Category::turncate();
        // Product::turncate();
        // Transaction::turncate();
        // DB::table('category_product')->turncate();

        $userQuantity = 200;
        $categoryQuantity = 30;
        $productQuantity = 200;
        $transactionQuantity = 20;

        
        factory(User::class, $userQuantity)->create();
        factory(Category::class, $categoryQuantity)->create();
        factory(Product::class, $productQuantity)->create()->each(
            function($product){
                $categories = Category::all()->random(mt_rand(1, 5))->pluck('id');
                $product->categories()->attach($categories);
            }
        );
        factory(Transaction::class, $transactionQuantity)->create();


    }
}

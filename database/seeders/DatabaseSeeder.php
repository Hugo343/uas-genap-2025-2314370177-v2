<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Favorite;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductReview;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Users
        $user1 = User::create([
            'name' => 'Hugo0 Gabriel',
            'email' => 'jon@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $user2 = User::create([
            'name' => 'Alya Prameswari',
            'email' => 'alyas@example.com',
            'password' => bcrypt('password'),
        ]);

        // 2. Categories
        $cat1 = Category::create(['name' => 'Elektronik']);
        $cat2 = Category::create(['name' => 'Aksesoris']);
        $cat3 = Category::create(['name' => 'Fashion']);

        // 3. Products
        $p1 = Product::create([
            'name' => 'Laptop Gaming',
            'description' => 'Laptop cepat dan bertenaga.',
            'price' => 12000000,
            'stock' => 10,
            'is_publish' => true,
            'category_id' => $cat1->id
        ]);

        $p2 = Product::create([
            'name' => 'Mouse Wireless',
            'description' => 'Mouse tanpa kabel.',
            'price' => 250000,
            'stock' => 20,
            'is_publish' => true,
            'category_id' => $cat2->id
        ]);

        $p3 = Product::create([
            'name' => 'Kaos Polos',
            'description' => 'Kaos nyaman dan adem.',
            'price' => 85000,
            'stock' => 50,
            'is_publish' => true,
            'category_id' => $cat3->id
        ]);

        // 4. Wishlist
        Favorite::create([
            'user_id' => $user1->id,
            'product_id' => $p1->id
        ]);

        Favorite::create([
            'user_id' => $user1->id,
            'product_id' => $p2->id
        ]);

        // 5. Orders
        $order = Order::create([
            'user_id' => $user1->id,
            'total_price' => $p1->price + $p2->price,
            'status' => 'completed'
        ]);

        // 6. Order Items
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $p1->id,
            'quantity' => 1,
            'price' => $p1->price,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $p2->id,
            'quantity' => 1,
            'price' => $p2->price,
        ]);

        // 7. Review
        ProductReview::create([
            'user_id' => $user1->id,
            'product_id' => $p1->id,
            'comment' => 'Laptop keren, performa mantap!',
            'rating' => 5
        ]);

        ProductReview::create([
            'user_id' => $user1->id,
            'product_id' => $p2->id,
            'comment' => 'Mouse sangat responsif.',
            'rating' => 4
        ]);
        $this->call([
        UserSeeder::class,
        ProductSeeder::class,
        OrderSeeder::class,
    ]);
    }
}

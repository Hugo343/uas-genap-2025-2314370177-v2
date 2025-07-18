<?
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $users = User::where('is_admin', false)->pluck('id');
        $products = Product::pluck('id');

        foreach (range(1, 10) as $i) {
            Order::create([
                'user_id' => $users->random(),
                'product_id' => $products->random(),
                'quantity' => rand(1, 3),
                'status' => 'pending',
                'total_price' => rand(15000, 60000),
            ]);
        }
    }
}

<?
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'name' => "Produk $i",
                'description' => "Deskripsi untuk produk $i",
                'price' => rand(10000, 50000),
                'stock' => rand(1, 20),
            ]);
        }
    }
}

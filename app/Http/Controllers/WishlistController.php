<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Tampilkan semua wishlist milik user login
    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())
            ->with('product')
            ->get();

        return view('wishlist.index', compact('favorites'));
    }

    // Tambahkan produk ke wishlist
    public function store($productId)
    {
        Favorite::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $productId,
        ]);

        return redirect()->back()->with('success', 'Produk ditambahkan ke wishlist.');
    }

    // Hapus produk dari wishlist
    public function destroy($id)
    {
        $fav = Favorite::where('user_id', Auth::id())
                      ->where('id', $id)->first();

        if ($fav) {
            $fav->delete();
        }

        return redirect()->route('wishlist.index')->with('success', 'Wishlist dihapus.');
    }
}


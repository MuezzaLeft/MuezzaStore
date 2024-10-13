<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
Use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Flash;

class UserController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $flashes = Flash::all();
        return view('pages.user.index', compact('products','flashes'));
    }

    public function detail_product($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.user.detail' , compact('product'));

    }
    public function detail_flash($id)
    {
        $flash = Flash::findOrFail($id);
        return view('pages.user.detailflash' , compact('flash'));

    }

    public function purchase($productId, $userId)
    {
        $product = Product::findOrFail($productId);
        $user = User::findOrFail($userId);

        if($user->point >= $product->price) {
            $totalPoints = $user->point - $product->price;

            $user->update([
                'point' => $totalPoints,
            ]);

            Alert::success('Berhasil!' , 'Produk berhasil dibeli!');
            return redirect()->back();  
        } else {
            Alert::error('Gagal' , 'Point anda tidak cukup');
        
        }
    }
    public function purchaseSale($flashId, $userId)
    {
        $flash = Flash::findOrFail($flashId);
        $user = User::findOrFail($userId);

        if($user->point > $flash->priceDiskon) {
            $totalPoints = $user->point - $flash->priceDiskon;

            $user->update([
                'point' => $totalPoints,
            ]);

            Alert::success('Berhasil!' , 'Produk berhasil dibeli!');
            return redirect()->back();  
        } else {
            Alert::error('Gagal' , 'Point anda tidak cukup');
        
        }
    }
}

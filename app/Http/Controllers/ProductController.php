<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Menampilkan semua produk
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|integer',
            'picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Simpan gambar ke folder public/img
        $imageName = time() . '.' . $request->picture->extension();
        $request->picture->move(public_path('img'), $imageName);

        // Simpan data ke database
        $product = Product::create([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'picture' => $imageName,
        ]);

        return redirect()->route('products.index')->with('success', 'Product added!');
    }

    // Update produk
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'product_name' => $request->product_name,
            'price' => $request->price,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated!');
    }

    // Hapus produk
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus gambar dari folder img
        $imagePath = public_path('img/' . $product->picture);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted!');
    }
}

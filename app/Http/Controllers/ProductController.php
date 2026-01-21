<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

/**
 * ProductController
 * Menangani seluruh logic bisnis terkait inventaris produk
 */

class ProductController extends Controller
{
    /**
     * GET /api/products
     * API: menampilkan data produk (JSON)
     */
    public function apiIndex()
    {
        return Product::orderBy('stock')->get();
    }

    /**
     * GET /inv entaris
     * Halaman inventaris (VIEW)
     */
    public function index()
    {
        return view('inventaris');
    }


    /**
     * POST /api/products
     * Menyimpan produk baru ke database
     */
    public function store(Request $request)
    {
        //Validasi input
        $request->validate([
            'name'  => 'required|string',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        //Return data produk
        return Product::create($request->only('name', 'stock', 'price'));
    }


    /**
     * POST /api/products/{id}/sell
     * Proses transaksi penjualan produk
     */
    public function sell(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($id);

        // Validasi agar stok tidak negatif
        if ($product->stock < $request->quantity) {
            return response()->json([
                'message' => 'Stok tidak mencukupi'
            ], 400);
        }

        // Kurangi stok sesuai quantity
        // Validasi stok dilakukan di backend untuk menjaga konsistensi data walaupun frontend sudah melakukan validasi.”
        $product->decrement('stock', $request->quantity);

        return response()->json([
            'message' => 'Transaksi berhasil',
            'remaining_stock' => $product->stock
        ]);
    }

    /**
     * PUT /api/products/{id}
     * Edit dan Update data produk (koreksi data)
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $products = Product::orderBy('stock')->get();

        return view('edit', compact('product', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only('name', 'price', 'stock'));

        return redirect('/inventaris')
            ->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * DELETE /api/products/{id}
     * Menghapus produk dari database
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'message' => 'Produk berhasil dihapus'
        ]);
    }
}

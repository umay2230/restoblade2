<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('produk.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Maks 2MB
        ]);

       // try {
            $imageName = time() . '.' . $request->image->extension();  
            $upload = $request->image->move(public_path('images'), $imageName);

            if ($upload) {
               // DB::beginTransaction();

                $produkData = [
                    'title' => $validated['title'],
                    'description' => $validated['description'],
                    'category' => $validated['category'],
                    'price' => $validated['price'],
                    'stock' => $validated['stock'],
                    'image' => $imageName,
                ];

                Product::create($produkData);

              //  DB::commit();

                return redirect()->route('produkindex')
                    ->with('success', 'Produk berhasil disimpan.');
            } else {
                return redirect()->back()
                    ->with('error', 'Gagal mengunggah gambar.')
                    ->withInput();
            }
       /* } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi Kesalahan dalam input produk: ' . $e->getMessage())
                ->withInput();
        }*/
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produk = Product::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Maks 2MB
        ]);

        $produk = Product::findOrFail($id);

        try {
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();  
                $upload = $request->image->move(public_path('images'), $imageName);

                if ($upload) {
                    $produkData = [
                        'title' => $validated['title'],
                        'description' => $validated['description'],
                        'category' => $validated['category'],
                        'price' => $validated['price'],
                        'stock' => $validated['stock'],
                        'image' => $imageName,
                    ];
                } else {
                    return redirect()->back()
                        ->with('error', 'Gagal mengunggah gambar.')
                        ->withInput();
                }
            } else {
                $produkData = [
                    'title' => $validated['title'],
                    'description' => $validated['description'],
                    'category' => $validated['category'],
                    'price' => $validated['price'],
                    'stock' => $validated['stock'],
                ];
            }

            DB::beginTransaction();
            $produk->update($produkData);
            DB::commit();

            return redirect()->route('produkindex')
                ->with('success', 'Produk berhasil disimpan.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi Kesalahan dalam input produk: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            $product = Product::findOrFail($id);

            if ($product) {
                $productImage = $product->image;
                if ($productImage && file_exists(public_path('images/' . $productImage))) {
                    unlink(public_path('images/' . $productImage));
                }

                $product->delete();

                DB::commit();

                return redirect()->route('produkindex')
                    ->with('success', 'Produk berhasil dihapus.');
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Produk gagal dihapus' . $e->getMessage());
        }
    }
 

}
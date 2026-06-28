<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Daftar kendaraan
     */
    public function index()
    {
        $products = Product::with('images')
            ->latest()
            ->paginate(10);

        return view('admin.product.index', compact('products'));
    }

    /**
     * Form tambah kendaraan
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Simpan kendaraan
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'        => 'required|max:255',
            'harga'       => 'required',
            'deskripsi'   => 'nullable',
            'gambar'      => 'required|array|max:20',
            'gambar.*'    => 'image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        DB::beginTransaction();

        try {

            $harga = preg_replace('/[^0-9]/', '', $request->harga);

            $product = Product::create([
                'nama'       => $request->nama,
                'slug'       => Str::slug($request->nama . '-' . time()),
                'harga'      => $harga,
                'deskripsi'  => $request->deskripsi,
                'status'     => true,
            ]);

            $uploadPath = public_path('uploads/product');

            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            $cover = true;

            foreach ($request->file('gambar') as $index => $file) {

                $namaFile = time() . '_' . ($index + 1) . '.' . $file->extension();

                $file->move($uploadPath, $namaFile);

                ProductImage::create([
                    'product_id' => $product->id,
                    'gambar'     => $namaFile,
                    'is_cover'   => $cover,
                    'urutan'     => $index + 1,
                ]);

                $cover = false;
            }

            DB::commit();

            return redirect()
                ->route('product.index')
                ->with('success', 'Kendaraan berhasil ditambahkan.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

        /**
     * Form edit kendaraan
     */
    public function edit(Product $product)
    {
        $product->load('images');

        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update kendaraan
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama'      => 'required|max:255',
            'harga'     => 'required',
            'deskripsi' => 'nullable',
            'gambar.*'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        DB::beginTransaction();

        try {

            $harga = preg_replace('/[^0-9]/', '', $request->harga);

            $product->update([
                'nama'      => $request->nama,
                'slug'      => Str::slug($request->nama . '-' . $product->id),
                'harga'     => $harga,
                'deskripsi' => $request->deskripsi,
            ]);

            if ($request->hasFile('gambar')) {

                $cover = $product->images()->count() == 0;

                $urut = $product->images()->count() + 1;

                $uploadPath = public_path('uploads/product');

                if (!File::exists($uploadPath)) {
                    File::makeDirectory($uploadPath, 0755, true);
                }

                foreach ($request->file('gambar') as $file) {

                    $namaFile = time() . '_' . $urut . '.' . $file->extension();

                    $file->move($uploadPath, $namaFile);

                    ProductImage::create([
                        'product_id' => $product->id,
                        'gambar'     => $namaFile,
                        'is_cover'   => $cover,
                        'urutan'     => $urut,
                    ]);

                    $cover = false;
                    $urut++;
                }
            }

            DB::commit();

            return redirect()
                ->route('product.index')
                ->with('success', 'Kendaraan berhasil diperbarui.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Hapus kendaraan
     */

public function destroy(Product $product)
{
    DB::beginTransaction();

    try {

        foreach ($product->images as $image) {

            $file = public_path('uploads/product/'.$image->gambar);

            if (File::exists($file)) {
                File::delete($file);
            }

            $image->delete();

        }

        $product->delete();

        DB::commit();

        return redirect()
            ->route('product.index')
            ->with('success','Kendaraan berhasil dihapus.');

    } catch (\Exception $e) {

        DB::rollBack();

        return back()->with('error',$e->getMessage());

    }
}

public function setCover(ProductImage $image)
{
    ProductImage::where(
        'product_id',
        $image->product_id
    )->update([

        'is_cover'=>false

    ]);

    $image->update([

        'is_cover'=>true

    ]);

    return back()->with(
        'success',
        'Foto cover berhasil diubah.'
    );
}

public function destroyImage(ProductImage $image)
{
    DB::beginTransaction();

    try {

        $product = $image->product;

        $file = public_path('uploads/product/'.$image->gambar);

        if (File::exists($file)) {
            File::delete($file);
        }

        $image->delete();

        // Jika cover dihapus, jadikan foto pertama sebagai cover
        if (!$product->images()->where('is_cover', true)->exists()) {

            $cover = $product->images()
                ->orderBy('urutan')
                ->first();

            if ($cover) {

                $cover->update([
                    'is_cover' => true
                ]);

            }

        }

        DB::commit();

        return back()->with(
            'success',
            'Foto berhasil dihapus.'
        );

    } catch (\Exception $e) {

        DB::rollBack();

        return back()->with(
            'error',
            $e->getMessage()
        );

    }
}

}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class HomepageBannerController extends Controller
{
    /**
     * Daftar Banner
     */
    public function index()
    {
        $banners = HomepageBanner::orderBy('sort_order')
            ->latest()
            ->get();

        return view('admin.banner.index', compact('banners'));
    }

    /**
     * Form tambah banner
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Simpan banner
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|max:255',
            'subtitle'    => 'nullable|max:255',
            'button_text' => 'nullable|max:100',
            'button_link' => 'nullable|max:255',
            'sort_order'  => 'required|integer|min:1',
            'status'      => 'required|boolean',
            'image'       => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        DB::beginTransaction();

        try {

            $uploadPath = public_path('uploads/banner');

            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            $filename = null;

            if ($request->hasFile('image')) {

                $filename = time() . '.' . $request->image->extension();

                $request->image->move(
                    $uploadPath,
                    $filename
                );
            }

            HomepageBanner::create([

                'title'       => $request->title,
                'subtitle'    => $request->subtitle,
                'image'       => $filename,
                'button_text' => $request->button_text,
                'button_link' => $request->button_link,
                'sort_order'  => $request->sort_order,
                'status'      => $request->status,

            ]);

            DB::commit();

            return redirect()
                ->route('banner.index')
                ->with(
                    'success',
                    'Banner berhasil ditambahkan.'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );

        }
    }

    /**
     * Form edit banner
     */
    public function edit(HomepageBanner $banner)
    {
        return view(
            'admin.banner.edit',
            compact('banner')
        );
    }

    /**
     * Update banner
     */
    public function update(
        Request $request,
        HomepageBanner $banner
    ) {

        $request->validate([

            'title'       => 'required|max:255',
            'subtitle'    => 'nullable|max:255',
            'button_text' => 'nullable|max:100',
            'button_link' => 'nullable|max:255',
            'sort_order'  => 'required|integer|min:1',
            'status'      => 'required|boolean',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',

        ]);

        DB::beginTransaction();

        try {

            $data = [

                'title'       => $request->title,
                'subtitle'    => $request->subtitle,
                'button_text' => $request->button_text,
                'button_link' => $request->button_link,
                'sort_order'  => $request->sort_order,
                'status'      => $request->status,

            ];

            if ($request->hasFile('image')) {

                $uploadPath = public_path('uploads/banner');

                if (!File::exists($uploadPath)) {

                    File::makeDirectory(
                        $uploadPath,
                        0755,
                        true
                    );

                }

                if (
                    $banner->image &&
                    File::exists(
                        $uploadPath.'/'.$banner->image
                    )
                ) {

                    File::delete(
                        $uploadPath.'/'.$banner->image
                    );

                }

                $filename = time().'.'.$request->image->extension();

                $request->image->move(
                    $uploadPath,
                    $filename
                );

                $data['image'] = $filename;

            }

            $banner->update($data);

            DB::commit();

            return redirect()
                ->route('banner.index')
                ->with(
                    'success',
                    'Banner berhasil diperbarui.'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );

        }

    }

    /**
     * Hapus banner
     */
    public function destroy(
        HomepageBanner $banner
    ) {

        DB::beginTransaction();

        try {

            $file = public_path(
                'uploads/banner/'.$banner->image
            );

            if (File::exists($file)) {

                File::delete($file);

            }

            $banner->delete();

            DB::commit();

            return redirect()
                ->route('banner.index')
                ->with(
                    'success',
                    'Banner berhasil dihapus.'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );

        }

    }

    /**
     * Tidak dipakai
     */
    public function show(
        HomepageBanner $banner
    ) {
        return redirect()->route('banner.index');
    }

}
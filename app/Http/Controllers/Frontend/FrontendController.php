<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\HomepageBanner;
use App\Models\Product;

class FrontendController extends Controller
{
    /**
     * Homepage
     */
    public function index()
    {
        $company = CompanyProfile::first();

        $banners = HomepageBanner::where('status', true)
            ->orderBy('sort_order')
            ->get();

        $products = Product::with('images')
            ->latest()
            ->get();

        return view('frontend.home', compact(

            'company',

            'banners',

            'products'

        ));
    }

    /**
     * Detail Mobil
     */
    public function detail(Product $product)
    {
        $company = CompanyProfile::first();

        $product->load('images');

        $relatedProducts = Product::with('images')
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(8)
            ->get();

        return view('frontend.detail', compact(

            'company',

            'product',

            'relatedProducts'

        ));
    }
}
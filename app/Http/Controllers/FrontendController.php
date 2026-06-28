<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\Product;
use App\Models\HomepageBanner;

class FrontendController extends Controller
{
    public function index()
    {
        $company = CompanyProfile::first();

        $products = Product::with('images')
            ->latest()
            ->get();

        $banners = HomepageBanner::where('status', true)
            ->orderBy('sort_order')
            ->get();

        return view(
            'frontend.home',
            compact(
                'company',
                'products',
                'banners'
            )
        );
    }

    public function detail(Product $product)
    {
        $company = CompanyProfile::first();

        $product->load('images');

        $relatedProducts = Product::with('images')
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(8)
            ->get();

        return view(
            'frontend.detail',
            compact(
                'company',
                'product',
                'relatedProducts'
            )
        );
    }
}
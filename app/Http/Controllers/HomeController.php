<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Location;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy BĐS nổi bật (is_featured = true)
        $featuredProperties = Property::with(['images', 'location', 'propertyType'])
            ->where('status', 'published')
            ->where('is_featured', true)
            ->limit(6)
            ->get();

        // Nếu không có BĐS featured, lấy BĐS mới nhất
        if ($featuredProperties->isEmpty()) {
            $featuredProperties = Property::with(['images', 'location', 'propertyType'])
                ->where('status', 'published')
                ->orderBy('created_at', 'desc')
                ->limit(6)
                ->get();
        }

        // Lấy danh sách thành phố cho form search
        $cities = Location::where('type', 'city')
            ->where('is_active', true)
            ->get();

        // Lấy loại BĐS cho form search
        $types = PropertyType::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('frontend.home', compact(
            'featuredProperties',
            'cities',
            'types'
        ));
    }
}

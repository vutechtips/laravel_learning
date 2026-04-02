<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Location;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Hiển thị danh sách BĐS + Filter
     */
    public function index(Request $request)
    {
        // Query cơ bản
        $query = Property::with(['images', 'location', 'propertyType'])
            ->where('status', 'published');

        // Filter theo vị trí
        if ($request->filled('location')) {
            $query->where('location_id', $request->location);
        }

        // Filter theo loại BĐS
        if ($request->filled('type')) {
            $query->where('property_type_id', $request->type);
        }

        // Filter theo giá min
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        // Filter theo giá max
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter theo số phòng ngủ
        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', '>=', $request->bedrooms);
        }

        // Sort
        $sortBy = $request->get('sort', 'created_at');
        $order = $request->get('order', 'desc');
        $query->orderBy($sortBy, $order);

        // Phân trang 12 BĐS/trang
        $properties = $query->paginate(12);

        // Lấy data cho filter dropdown
        $cities = Location::where('type', 'city')->where('is_active', true)->get();
        $types = PropertyType::where('is_active', true)->get();

        return view('frontend.properties.index', compact(
            'properties',
            'cities',
            'types'
        ));
    }

    /**
     * Tìm kiếm nâng cao (redirect từ form search)
     */
    public function search(Request $request)  // ← THÊM METHOD NÀY
    {
        // Validate input
        $validated = $request->validate([
            'location' => 'nullable|exists:locations,id',
            'type' => 'nullable|exists:property_types,id',
            'min_price' => 'nullable|numeric',
            'max_price' => 'nullable|numeric|gte:min_price',
            'bedrooms' => 'nullable|integer|min:1',
        ]);

        // Redirect đến trang index với query params
        return redirect()->route('properties.index', $request->all());
    }

    /**
     * Hiển thị trang chi tiết BĐS
     */
    public function show($slug)
    {
        // Lấy BĐS theo slug
        $property = Property::with(['images', 'location', 'propertyType', 'user'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Tăng view count
        $property->increment('views_count');

        // Lấy BĐS liên quan (cùng loại, cùng vị trí)
        $relatedProperties = Property::with(['images', 'location'])
            ->where('status', 'published')
            ->where('id', '!=', $property->id)
            ->where('property_type_id', $property->property_type_id)
            ->limit(4)
            ->get();

        return view('frontend.properties.show', compact('property', 'relatedProperties'));
    }
}

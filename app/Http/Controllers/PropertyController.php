<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{
    public function search(Request $request)
    {
        $query = Property::query();

        $this->applyAttributeFilters($query, $request);

        $this->applyPriceRangeFilter($query, $request);

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        $results = $query->get();

        return response()->json($results);
    }

    public function searchByAttribute(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'attribute' => 'required|in:bedrooms,bathrooms,storeys,garages,name',
                'value'     => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid input'], 400);
        }

        $query = Property::query();
        $attribute = $request->input('attribute');
        $value = $request->input('value');

        if ($attribute === 'name') {
            $query->where('name', 'like', '%' . $value . '%');
        } else {
            $query->where($attribute, $value);
        }

        $results = $query->get();
        return response()->json($results);
    }

    public function searchByPriceRange(Request $request, $priceRange)
    {
        list($minPrice, $maxPrice) = explode('-', $priceRange);

        $query = Property::query();
        $this->applyPriceRangeFilter($query, $request, $minPrice, $maxPrice);

        $results = $query->get();
        return response()->json($results);
    }

    protected function applyAttributeFilters($query, $request)
    {
        $attributeMap = ['bedrooms', 'bathrooms', 'storeys', 'garages'];
        foreach ($attributeMap as $attribute) {
            if ($request->has($attribute)) {
                $query->where($attribute, $request->input($attribute));
            }
        }
    }

    protected function applyPriceRangeFilter($query, $request, $minPrice = null, $maxPrice = null)
    {
        if ($request->has('min_price')) {
            $minPrice = $request->input('min_price');
        }
        if ($request->has('max_price')) {
            $maxPrice = $request->input('max_price');
        }

        if ($minPrice) {
            $query->where('price', '>=', $minPrice);
        }
        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        }
    }
}

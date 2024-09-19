<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function __construct() 
    {
        $this->authorizeResource(Listing::class,'listing');
    }

    public function index()
    {
        $filters = request()->only([
            'priceFrom','priceTo','beds','baths','areaFrom','areaTo'
        ]);

        return Inertia::render('Listing/Index',
        [
            'filters' => $filters,
            'listings' => Listing::latest()                
                ->filter($filters)
                ->paginate(9)
                ->withQueryString()
        ]);
    }

    public function show(Listing $listing)
    {
        $listing->load(['images']);
        return Inertia::render('Listing/Show',[
            'list' => $listing
        ]);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    // Display all listings with optional filtering
    public function index(Request $request)
    {
        // Initialize a query builder
        $query = Listing::query();

        // Search across multiple fields
        if ($request->has('search_any') && !empty($request->search_any)) {
            $searchTerm = $request->search_any;
            $query->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', '%' . $searchTerm . '%')
                      ->orWhere('description', 'like', '%' . $searchTerm . '%')
                      ->orWhere('location', 'like', '%' . $searchTerm . '%')
                      ->orWhere('sqft', 'like', '%' . $searchTerm . '%')
                      ->orWhere('bedrooms', '=', $searchTerm)
                      ->orWhere('bathrooms', '=', $searchTerm)
                      ->orWhere('garage', '=', $searchTerm);
                // Add more fields as needed
            });
        }
        
        // Filter by location name
        if ($request->has('location_name') && !empty($request->location_name)) {
            $query->where('location', 'like', '%' . $request->location_name . '%');
        }
        
        // Sorting the results
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                // Add other sort criteria
            }
        }

        // Fetch the results

        $listings = $query->paginate(10);

        return view('listings.index', compact('listings'));
    }

    // Display the form for creating a new listing
    public function create()
    {
        return view('listings.create');
    }

    // Store a new listing
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            // Add other fields as necessary
        ]);

        Listing::create($data);
        return redirect()->route('listings.index');
    }

    // Show a specific listing
    public function show(Listing $listing)
    {
        return view('listings.show', compact('listing'));
    }

    // Edit a listing
    public function edit(Listing $listing)
    {
        return view('listings.edit', compact('listing'));
    }

    // Update a listing
    public function update(Request $request, Listing $listing)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            // Add other fields
        ]);

        $listing->update($data);
        return redirect()->route('listings.show', $listing);
    }

    // Delete a listing
    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect()->route('listings.index');
    }
}

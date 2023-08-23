@extends('app')

@section('title', 'Listings Page')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Filters Column -->
        <div class="col-md-3">
            <form action="{{ route('listings.index') }}" method="GET">
                <div class="form-group">
                    <label for="search_any">Search by Any</label>
                    <input type="text" name="search_any" id="search_any" class="form-control" placeholder="Search...">
                </div>

                <div class="form-group">
                    <label for="location_name">Location Name</label>
                    <input type="text" name="location_name" id="location_name" class="form-control" placeholder="Location...">
                </div>

                <div class="form-group">
                    <label for="sort">Sort By</label>
                    <select name="sort" id="sort" class="form-control">
                        <option value="price_asc">Price Low to High</option>
                        <option value="price_desc">Price High to Low</option>
                        <option value="footage_asc">Footage Low to High</option>
                        <!-- Add other sort options as needed -->
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary">Apply Filters</button>
                <a href="{{ route('listings.index') }}" class="btn btn-secondary">Reset Filters</a>
            </form>
        </div>

        <!-- Right Column: Listings -->
        <div class="col-md-9">
            <h3>Listings</h3>
            @foreach($listings as $listing)
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        {{ $listing->title }}
                    </div>
                    <div class="card-body">
                        <p class="font-weight-bold">{{ Str::limit($listing->description, 100) }}</p> <!-- Limiting description to 100 characters for brevity. Adjust as needed. -->
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Price:</strong> ${{ number_format($listing->price, 2) }}</p>
                                <p><strong>Location:</strong> {{ $listing->location }}</p>
                                <p><strong>Bedrooms:</strong> {{ $listing->bedrooms }}</p>
                                <p><strong>Bathrooms:</strong> {{ $listing->bathrooms }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Garage:</strong> {{ $listing->garage }} cars</p>
                                <p><strong>Sqft:</strong> {{ number_format($listing->sqft) }} sq. ft.</p>
                                <p><strong>Lot Size:</strong> {{ number_format($listing->lot_size, 2) }} acres</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        
            <!-- Pagination Links -->
            <div class="d-flex justify-content-center mt-4">
                {{ $listings->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

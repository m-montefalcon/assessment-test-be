<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGeoRequest;
use App\Http\Requests\UpdateGeoRequest;
use App\Models\Geo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GeoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch only the desired fields from the database
        $geos = Geo::select('ip', 'city', 'region', 'country', 'loc', 'org', 'postal', 'timezone', 'user_ip', 'user_city', 'user_region', 'user_country', 'user_loc', 'user_org', 'user_postal', 'user_timezone')->get();

        return response()->json(['message' => 'Geo data fetched successfully', 'data' => $geos], 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Extract the search value from the request
        $searchValue = $request->input('searchValue');
        $geoApiKey = env('GEO_API_KEY');
        $geoBaseUrl = env('GEO_BASE_URL');
        // Make the HTTP request to the third-party service
        $response = Http::get("{$geoBaseUrl}/{$searchValue}?token={$geoApiKey}");
        $userResponse = Http::get("{$geoBaseUrl}?token={$geoApiKey}");
        // Check if the request was successful
        if ($response->successful() && $userResponse->successful()) {
            // Process the response data
            $data = $response->json();
            $userData = $userResponse->json();

            // You can now use $data to store in your database or perform other actions
            // For example, you might want to create a new Geo record
            $geo = Geo::create([
                'ip' => $data['ip'] ?? $searchValue,
                'loc' => $data['loc'] ?? null,
                'city' => $data['city'] ?? null,
                'region' => $data['region'] ?? null,
                'country' => $data['country'] ?? null,
                'org' => $data['org'] ?? null,
                'postal' => $data['postal'] ?? null,
                'timezone' => $data['timezone'] ?? null,
                'user_ip' => $userData['ip'] ?? null,
                'user_loc' => $userData['loc'] ?? null,
                'user_city' => $userData['city'] ?? null,
                'user_region' => $userData['region'] ?? null,
                'user_country' => $userData['country'] ?? null,
                'user_org' => $userData['org'] ?? null,
                'user_postal' => $userData['postal'] ?? null,
                'user_timezone' => $userData['timezone'] ?? null,
            ]);

            return response()->json(['message' => 'Geo data stored successfully', 'data' => $geo], 200);
        } else {
            // Handle the error
            return response()->json(['message' => 'Failed to fetch geo data'], $response->status());
        }
    }

   
}

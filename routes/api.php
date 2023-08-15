<?php

use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('properties')->group(function () {
    Route::get('', [PropertyController::class, 'search']);
    Route::get('/attribute', [PropertyController::class, 'searchByAttribute']);
    Route::get('/price/{priceRange}', [PropertyController::class, 'searchByPriceRange']);
});

/**
 * Routes for all filters:
 * http://localhost:8000/api/properties - get all records
 * http://localhost:8000/api/properties?name=Victoria&bedrooms=4&bathrooms=2&storeys=2&garages=2&min_price=300000&max_price=500000 - universal search
 * http://localhost:8000/api/properties/attribute?attribute=name&value=Geneva - search by name attribute
 * http://localhost:8000/api/properties/attribute?attribute=bedrooms&value=5 - search by bedroom attribute
 * http://localhost:8000/api/properties/attribute?attribute=bathrooms&value=3 - search by bathroom attribute
 * http://localhost:8000/api/properties/attribute?attribute=storeys&value=1 - search by storey attribute
 * http://localhost:8000/api/properties/attribute?attribute=garages&value=1 - search by garage attribute
 * http://localhost:8000/api/properties/price/100000-300000 - search by price range
 */

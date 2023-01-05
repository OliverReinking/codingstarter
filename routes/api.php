<?php

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});


Route::middleware(['auth:sanctum'])->group(function () {
  // -----
  // Blogs
  // -----
  // Liste der Blogartikel (blogs)
  Route::get('articles', function () {
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure. This will be cleaned up later.
    return Blog::all();
  });
});

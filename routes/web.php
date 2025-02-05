<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index'])->name('product.index');

Route::get('products/show/{product_id}', [ProductController::class, 'show'])->name('product.show');
Route::get('products/edit/{product_id}', [ProductController::class, 'edit'])->name('product.edit');

Route::put('products/{product}', [ProductController::class, 'update'])->name('product.update');

Route::get('products/create', [ProductController::class, 'create'])->name('product.create');
Route::post('products', [ProductController::class, 'store'])->name('product.store');

Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

Route::get('products/search', [ProductController::class, 'search'])->name('product.search');
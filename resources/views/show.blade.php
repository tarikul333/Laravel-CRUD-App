@extends('layouts.app')

@section('content')

<div class="flex justify-end items-center mb-6">
    <a href="{{ route('product.index') }}" class="bg-green-500 text-white py-2 px-4 rounded">< Back</a>
</div>

<div class="bg-white shadow rounded-lg p-6">
    <!-- Product Name -->
    <div class="mb-4">
        <p class="text-gray-600 font-medium text-xl">Product Name:</p>
        <p class="text-gray-800">{{ $product->name }}</p>
    </div>

    <!-- Product Details -->
    <div class="mb-4">
        <p class="text-gray-600 font-medium text-xl">Details:</p>
        <p class="text-gray-800">{{ $product->details }}</p>
    </div>

    <!-- Product Image -->
    <div class="mb-4">
        <p class="text-gray-600 font-medium text-xl">Image:</p>
        <img src="/images/{{ $product->image }}" class="rounded shadow-md">
    </div>
</div>

@endsection


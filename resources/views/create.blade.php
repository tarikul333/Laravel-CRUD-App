@extends('layouts.app')

@section('content')

<div class="container mx-auto my-8">
    <h1 class="text-lg font-bold text-gray-800 mb-6 flex justify-center">Create Product</h1>
    <div class="flex justify-end items-center mb-6">
        <a href="{{ route('product.index') }}" class="bg-green-500 text-white py-2 px-4 rounded">< Back</a>
    </div>
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded-lg p-6 w-full mx-auto">
        @csrf
        
        <!-- Name Field -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Name:</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                placeholder="Inter Name"
            >
        </div>

        <!-- Details Field -->
        <div class="mb-4">
            <label for="details" class="block text-gray-700 font-medium mb-2">Detail:</label>
            <textarea 
                id="details" 
                name="details" 
                rows="4"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                placeholder="Inter Detail"
            ></textarea>
        </div>

        <div class="mb-4">
            <label for="price" class="block text-gray-700 font-medium mb-2">Price:</label>
            <input 
                type="text" 
                id="price" 
                name="price" 
                class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                placeholder="Inter Price"
            >
        </div>

        <div class="mb-4">
            <label for="stock" class="block text-gray-700 font-medium mb-2">Stock:</label>
            <input 
                type="text" 
                id="stock" 
                name="stock" 
                class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                placeholder="Inter Stock"
            >
        </div>

        <!-- File Upload -->
        <div class="mb-4">
            <label for="file" class="block text-gray-700 font-medium mb-2">Image:</label>
            <input 
                type="file" 
                id="file" 
                name="image" 
                class="w-full text-gray-700 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
            >
        </div>

        <!-- Submit Button -->
        <div>
            <button 
                type="submit" 
                class="w-full bg-green-600 text-white font-medium py-2 px-4 rounded-lg shadow hover:bg-green-700"
            >
                Submit
            </button>
        </div>
    </form>
</div>

@endsection

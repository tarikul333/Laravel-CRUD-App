@extends('layouts.app')

@section('content')
<div class="mb-4">
    <input type="text" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300" name="search" placeholder="Search">
</div>

<div class="flex justify-end items-center mb-6">
    <a href="{{ route('product.create') }}" class="bg-green-500 text-white py-2 px-4 rounded">+ Create New Product</a>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif
@if(session('delete'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
        {{ session('delete') }}
    </div>
@endif

<table class="table-auto w-full border-collapse border border-gray-200">
    <thead class="bg-gray-100">
        <tr>
            <th class="w-1/12 border px-4 py-2">No</th>
            <th class="w-2/12 border px-4 py-2">Image</th>
            <th class="w-2/12 border px-4 py-2">
                <a href="{{ route('product.index', ['sortBy' => 'name', 'sort' => request('sort') == 'asc' ? 'desc' : 'asc']) }}" class="text-blue-900 {{ request('sortBy') == 'name' && request('sort') == 'asc' ? 'underline' : '' }}">Name</a>
            </th>
            <th class="w-4/12 border px-4 py-2">
                <a href="{{ route('product.index', ['sortBy' => 'details', 'sort' => request('sort') == 'asc' ? 'desc' : 'asc']) }}" class="text-blue-900 {{ request('sortBy') == 'details' && request('sort') == 'asc' ? 'underline' : '' }}">Detail</a>
            </th>
            <th class="w-3/12 border px-4 py-2">Action</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($products as $product)
            <tr>
                <td class="border py-2 px-8">{{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}</td>
                <td class="border px-4 py-2">
                    <img src="/images/{{ $product->image }}" class="h-24 w-28 mx-auto">
                </td>
                <td class="border px-4 py-2">{{ $product->name }}</td>
                <td class="border px-4 py-2">{{ $product->details }}</td>
                <td class="border px-4 py-2 space-x-2">
                    <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline;">
                        <a href="{{ route('product.show', $product->id) }}" class="bg-blue-500 text-white py-1 px-3 rounded">Show</a>
                        <a href="{{ route('product.edit', $product->id) }}" class="bg-yellow-500 text-white py-1 px-3 rounded">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="border px-4 py-2 text-center">No products found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-6">
    <!-- Render pagination links -->
    {{ $products->links('pagination::tailwind') }}
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search').on('input', function() {
            // debugger;
            let query = $(this).val();
            $.ajax({
                url: "{{ route('product.search') }}",
                method: 'GET',
                data: { 'query': query },
                success: function(data) {
                    $('tbody').html(data);
                },
                error: function() {
                    alert('Search failed.Please try again.');
                }
            });
        });
    })
</script>

@endsection


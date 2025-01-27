
@forelse ($products as $product)
    <tr>
        <td class="border py-2 px-4 text-center">{{ $loop->iteration }}</td>
        <td class="border py-2 px-4 text-center">{{ $product->product_id }}</td>
        <td class="border px-4 py-2">
            <img src="/images/{{ $product->image }}" class="h-24 w-28 mx-auto">
        </td>
        <td class="border px-4 py-2 text-center">{{ $product->name }}</td>
        <td class="border px-4 py-2 text-center">{{ $product->details }}</td>
        <td class="border px-4 py-2 text-center">{{ $product->price }}</td>
        <td class="border px-4 py-2 text-center">{{ $product->stock }}</td>
        <td class="border px-4 py-2 space-x-2">
            <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline;">
                <a href="{{ route('product.show', $product->id) }}" class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-700">Show</a>
                <a href="{{ route('product.edit', $product->id) }}" class="bg-yellow-500 text-white py-1 px-3 rounded hover:bg-yellow-700">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-700">Delete</button>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="border px-4 py-2 text-center">No products found.</td>
    </tr>
@endforelse

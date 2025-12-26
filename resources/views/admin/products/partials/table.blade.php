@forelse ($products as $index => $product)
    <tr class="hover:bg-gray-50">
        <td class="px-4 py-3 border-b">
            {{ $index + 1 }}
        </td>
        <td class="px-4 py-3 border-b font-medium">
            {{ $product->name }}
        </td>
        <td class="px-4 py-3 border-b">
            {{ $product->category->name ?? '-' }}
        </td>
        <td class="px-4 py-3 border-b">
            Rp {{ number_format($product->price,0,',','.') }}
        </td>
        <td class="px-4 py-3 border-b">
            {{ $product->stock }}
        </td>
        <td class="px-4 py-3 border-b text-center">
            <div class="flex justify-center gap-2">
                <a href="{{ route('admin.products.edit', $product->id) }}"
                   class="px-3 py-1.5 text-xs font-medium text-yellow-500 border border-yellow-500 rounded-md hover:bg-yellow-50 transition">
                    Edit
                </a>
                <form action="{{ route('admin.products.destroy', $product->id) }}"
                      method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-3 py-1.5 text-xs font-medium text-red-600 border border-red-600 rounded-md hover:bg-red-50 transition">
                        Hapus
                    </button>
                </form>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="px-4 py-6 text-center text-gray-500">
            Data produk belum tersedia
        </td>
    </tr>
@endforelse

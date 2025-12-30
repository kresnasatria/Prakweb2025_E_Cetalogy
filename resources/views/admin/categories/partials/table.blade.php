@forelse ($categories as $category)
    <tr class="hover:bg-gray-50">
        <td class="px-6 py-4 font-medium text-gray-900">
            {{ $category->name }}
        </td>
        <td class="px-6 py-4 text-right space-x-3">
            <a href="{{ route('admin.categories.edit', $category) }}"
               class="px-3 py-1.5 text-xs font-medium text-yellow-500 border border-yellow-500 rounded-md hover:bg-blue-50 transition">
                Edit
            </a>
            <form action="{{ route('admin.categories.destroy', $category) }}"
                  method="POST"
                  class="inline"
                  onsubmit="return confirm('Yakin hapus kategori ini?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-3 py-1.5 text-xs font-medium text-red-600 border border-red-600 rounded-md hover:bg-red-50 transition">
                    Hapus
                </button>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="3"
            class="px-6 py-6 text-center text-gray-500">
            Belum ada kategori
        </td>
    </tr>
@endforelse

@extends('layouts.app')

@section('content')
<div class="px-6 py-8 w-full">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kelola Kategori</h1>
            <p class="text-sm text-gray-500 mt-1">
                Manajemen kategori produk
            </p>
        </div>

        <a href="{{ route('admin.categories.create') }}"
           class="bg-black text-white px-4 py-2 rounded-md hover:bg-gray-700 transition">
            + Tambah Kategori
        </a>
    </div>

    {{-- FLASH MESSAGE --}}
    @if(session('success'))
        <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-md">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-md">
            {{ session('error') }}
        </div>
    @endif


    {{-- SEARCH FORM --}}
    <form method="GET" action="{{ route('admin.categories.index') }}" class="mb-6 flex items-center gap-2">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori..." class="px-3 py-2 border rounded-md w-64 focus:outline-none focus:ring-2 focus:ring-gray-500" />
        <button type="submit" class="bg-black text-white px-4 py-2 rounded-md text-sm hover:bg-gray-700 transition">Cari</button>
        @if(request('search'))
            <a href="{{ route('admin.categories.index') }}" class="ml-2 text-sm text-gray-500 hover:underline">Reset</a>
        @endif
    </form>

    {{-- TABLE --}}
    <div class="overflow-x-auto bg-white border border-gray-200 rounded-lg">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Nama Kategori</th>
                    <th class="px-6 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @include('admin.categories.partials.table', ['categories' => $categories])
            </tbody>
        </table>
    </div>


    {{-- PAGINATION --}}
    <div class="mt-6">
        {!! $categories->links('pagination::tailwind') !!}
    </div>

    {{-- LIVE SEARCH SCRIPT --}}
    <script src="/js/admin-category-live-search.js"></script>

</div>

<style>
    /* Pagination container */
    nav[role="navigation"] span,
    nav[role="navigation"] a {
        background-color: #ffffff !important;
        color: #4b5563 !important; 
        border: 1px solid #e5e7eb !important;
    }

    /* Hover */
    nav[role="navigation"] a:hover {
        background-color: #f3f4f6 !important; 
        color: #111827 !important; 
    }

    /* Active page */
    nav[role="navigation"] span[aria-current="page"] span {
        background-color: #e5e7eb !important; 
        color: #111827 !important;
        font-weight: 600;
    }
</style>

@endsection
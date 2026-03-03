@extends('layouts.master')
@section('title', 'عرض الكتب')
@section('content')
    @php
        $filterKeys = ['status', 'deparment_id', 'tag_id', 'user_id', 'date_from', 'date_to'];
        $allFilterKeys = array_merge(['search'], $filterKeys);
        $hasFilters = request()->hasAny($filterKeys);
        $hasAnyFilter = request()->hasAny($allFilterKeys);
        $activeFilterCount = collect($filterKeys)->filter(fn($f) => request()->filled($f))->count();

        $statusColors = [
            'pending' => 'warning',
            'completed' => 'success',
            'approved' => 'success',
            'rejected' => 'danger',
            'archived' => 'secondary',
        ];
        $statusLabels = [
            'pending' => 'قيد الانتظار',
            'completed' => 'تمت الموافقة',
            'approved' => 'تمت الموافقة',
            'rejected' => 'مرفوض',
            'archived' => 'مؤرشف',
        ];

        $totalBooks = $books->total();
        $statusCounts = $books->getCollection()->groupBy('status')->map->count();
    @endphp

    <div class="container-fluid books-page">
        <div class="row justify-content-center">
            <div class="col-12">

                {{-- Page Header --}}
                <div class="row align-items-center mb-4 page-header">
                    <div class="col">
                        <h2 class="page-title mb-0">
                            <span class="fe fe-book-open fe-24 mr-2 text-primary"></span>عرض جميع الكتب
                        </h2>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('books.create') }}" class="btn btn-primary btn-add-book">
                            <span class="fe fe-plus fe-16 mr-2"></span>إضافة كتاب جديد
                        </a>
                    </div>
                </div>

                {{-- Success Alert --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show alert-book mb-4" role="alert">
                        <span class="fe fe-check-circle fe-16 mr-2"></span>
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                {{-- Stats Bar --}}
                <div class="stats-bar">
                    <div class="stat-card">
                        <div class="stat-value text-primary">{{ $totalBooks }}</div>
                        <div class="stat-label">إجمالي الكتب</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value text-warning">{{ $statusCounts->get('pending', 0) }}</div>
                        <div class="stat-label">قيد الانتظار</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value text-success">{{ $statusCounts->get('approved', 0) }}</div>
                        <div class="stat-label">تمت الموافقة</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value text-secondary">{{ $statusCounts->get('archived', 0) }}</div>
                        <div class="stat-label">مؤرشف</div>
                    </div>
                </div>

                @include('pages.Books.partials._search-panel')

                @include('pages.Books.partials._books-table')

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-4 mb-5 w-100">
                    <nav aria-label="صفحات الكتب" style="direction: ltr;">
                        {{ $books->links('pagination::bootstrap-5') }}
                    </nav>
                </div>

                @include('pages.Books.partials._books-mobile')

            </div>
        </div>

        {{-- Book Detail Modals --}}
        @foreach ($books as $book)
            @include('pages.Books.partials._book-modal', ['book' => $book])
        @endforeach
    </div>
@endsection

@extends('layouts.master')
@section('content')
    @php
        $statusLabels = [
            'pending' => 'قيد الانتظار',
            'completed' => 'مكتمل',
            'approved' => 'تمت الموافقة',
            'rejected' => 'مرفوض',
            'archived' => 'مؤرشف',
        ];
        $statusColors = [
            'pending' => 'warning',
            'completed' => 'success',
            'approved' => 'primary',
            'rejected' => 'danger',
            'archived' => 'secondary',
        ];
    @endphp

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                {{-- Page Header --}}
                <div class="row align-items-center mb-2">
                    <div class="col">
                        <h2 class="h5 page-title">مرحباً، {{ Auth::user()->name }}!</h2>
                    </div>
                </div>

                {{-- Summary Cards --}}
                <div class="row mb-4">
                    <div class="col-6 col-lg-3">
                        <div class="card shadow mb-4">
                            <div class="card-body text-center py-4">
                                <span class="fe fe-book-open fe-24 text-primary mb-2 d-block"></span>
                                <p class="mb-1 small text-muted">إجمالي الكتب</p>
                                <span class="h3">{{ $totalBooks }}</span><br />
                                @if ($monthlyGrowth >= 0)
                                    <span class="small text-success">+{{ $monthlyGrowth }}%</span>
                                    <span class="fe fe-arrow-up text-success fe-12"></span>
                                @else
                                    <span class="small text-danger">{{ $monthlyGrowth }}%</span>
                                    <span class="fe fe-arrow-down text-danger fe-12"></span>
                                @endif
                                {{-- <p class="small text-muted mb-0 mt-1">مقارنة بالشهر الماضي</p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="card shadow mb-4">
                            <div class="card-body text-center py-4">
                                <span class="fe fe-clock fe-24 text-warning mb-2 d-block"></span>
                                <p class="mb-1 small text-muted">قيد الانتظار</p>
                                <span class="h3">{{ $pendingCount }}</span><br />
                                <span class="small text-muted">من أصل {{ $totalBooks }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="card shadow mb-4">
                            <div class="card-body text-center py-4">
                                <span class="fe fe-check-circle fe-24 text-success mb-2 d-block"></span>
                                <p class="mb-1 small text-muted">مكتمل / موافق عليه</p>
                                <span class="h3">{{ $completedCount + $approvedCount }}</span><br />
                                <span class="small text-muted">من أصل {{ $totalBooks }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="card shadow mb-4">
                            <div class="card-body text-center py-4">
                                <span class="fe fe-x-circle fe-24 text-danger mb-2 d-block"></span>
                                <p class="mb-1 small text-muted">مرفوض</p>
                                <span class="h3">{{ $rejectedCount }}</span><br />
                                <span class="small text-muted">من أصل {{ $totalBooks }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Status Breakdown & Monthly Chart --}}
                <div class="row mb-4">
                    <div class="col-md-12 col-lg-4">
                        <div class="card shadow eq-card mb-4">
                            <div class="card-header">
                                <strong class="card-title">توزيع حالات الكتب</strong>
                            </div>
                            <div class="card-body">
                                @foreach (['pending', 'completed', 'approved', 'rejected', 'archived'] as $status)
                                    @php
                                        $count = ${$status . 'Count'} ?? ($statusCounts[$status] ?? 0);
                                        $percentage = $totalBooks > 0 ? round(($count / $totalBooks) * 100, 1) : 0;
                                    @endphp
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span class="small text-muted">{{ $statusLabels[$status] }}</span>
                                            <span class="small font-weight-bold">{{ $count }}</span>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-{{ $statusColors[$status] }}" role="progressbar"
                                                style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}"
                                                aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="border-top pt-3 mt-3">
                                    <div class="row text-center">
                                        <div class="col-4">
                                            <p class="mb-1 small text-muted">هذا الشهر</p>
                                            <h5 class="mb-0">{{ $booksThisMonth }}</h5>
                                        </div>
                                        <div class="col-4">
                                            <p class="mb-1 small text-muted">الشهر الماضي</p>
                                            <h5 class="mb-0">{{ $booksLastMonth }}</h5>
                                        </div>
                                        <div class="col-4">
                                            <p class="mb-1 small text-muted">مؤرشف</p>
                                            <h5 class="mb-0">{{ $archivedCount }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-4">
                        <div class="card shadow eq-card mb-4">
                            <div class="card-header">
                                <strong class="card-title">الكتب حسب القسم</strong>
                            </div>
                            <div class="card-body">
                                @forelse ($booksByDepartment as $dept)
                                    @php
                                        $deptPercentage =
                                            $totalBooks > 0 ? round(($dept['count'] / $totalBooks) * 100, 1) : 0;
                                    @endphp
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span class="small text-muted">{{ $dept['name'] }}</span>
                                            <span class="small font-weight-bold">{{ $dept['count'] }}</span>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-primary" role="progressbar"
                                                style="width: {{ $deptPercentage }}%"
                                                aria-valuenow="{{ $deptPercentage }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted text-center mb-0">لا توجد بيانات</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-4">
                        <div class="card shadow eq-card mb-4">
                            <div class="card-header">
                                <strong class="card-title">إحصائيات عامة</strong>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 mt-2">
                                    <div class="flex-fill">
                                        <span class="fe fe-users fe-24 text-primary"></span>
                                    </div>
                                    <div class="flex-fill">
                                        <p class="mb-0 text-muted small">المستخدمون النشطون</p>
                                        <h4 class="mb-0">{{ $totalUsers }}</h4>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="flex-fill">
                                        <span class="fe fe-grid fe-24 text-success"></span>
                                    </div>
                                    <div class="flex-fill">
                                        <p class="mb-0 text-muted small">الأقسام</p>
                                        <h4 class="mb-0">{{ $totalDepartments }}</h4>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="flex-fill">
                                        <span class="fe fe-tag fe-24 text-warning"></span>
                                    </div>
                                    <div class="flex-fill">
                                        <p class="mb-0 text-muted small">الوسوم</p>
                                        <h4 class="mb-0">{{ $totalTags }}</h4>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="flex-fill">
                                        <span class="fe fe-archive fe-24 text-secondary"></span>
                                    </div>
                                    <div class="flex-fill">
                                        <p class="mb-0 text-muted small">الكتب المؤرشفة</p>
                                        <h4 class="mb-0">{{ $archivedCount }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Monthly Chart --}}
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <strong class="card-title">الكتب خلال آخر 6 أشهر</strong>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-end" style="height: 200px;">
                            @foreach ($monthlyData as $data)
                                @php
                                    $maxCount = $monthlyData->max('count');
                                    $barHeight = $maxCount > 0 ? ($data['count'] / $maxCount) * 100 : 0;
                                @endphp
                                <div class="col text-center">
                                    <div class="d-flex flex-column align-items-center justify-content-end h-100">
                                        <span class="small font-weight-bold mb-1">{{ $data['count'] }}</span>
                                        <div class="bg-primary rounded"
                                            style="width: 40px; height: {{ max($barHeight, 5) }}%; min-height: 4px;">
                                        </div>
                                        <span class="small text-muted mt-2">{{ $data['month'] }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- Recent Activity --}}
                    <div class="col-md-12 col-lg-4 mb-4">
                        <div class="card timeline shadow">
                            <div class="card-header">
                                <strong class="card-title">آخر التحديثات</strong>
                            </div>
                            <div class="card-body" data-simplebar
                                style="height:355px; overflow-y: auto; overflow-x: hidden;">
                                @forelse ($recentActivities as $activity)
                                    @php
                                        $color = $statusColors[$activity->new_status] ?? 'info';
                                    @endphp
                                    <div class="pb-3 timeline-item item-{{ $color }}">
                                        <div class="pl-5">
                                            <div class="mb-1">
                                                <strong>{{ $activity->changer?->name ?? 'نظام' }}</strong>
                                                <span class="text-muted small mx-1">غيّر حالة</span>
                                                <strong>{{ $activity->book?->title ?? '-' }}</strong>
                                            </div>
                                            <p class="small mb-1">
                                                <span
                                                    class="badge badge-{{ $statusColors[$activity->old_status] ?? 'light' }}">{{ $statusLabels[$activity->old_status] ?? $activity->old_status }}</span>
                                                <span class="fe fe-arrow-left mx-1"></span>
                                                <span
                                                    class="badge badge-{{ $statusColors[$activity->new_status] ?? 'light' }}">{{ $statusLabels[$activity->new_status] ?? $activity->new_status }}</span>
                                            </p>
                                            @if ($activity->note)
                                                <p class="small text-muted mb-1">{{ $activity->note }}</p>
                                            @endif
                                            <p class="small text-muted mb-0">
                                                <span
                                                    class="badge badge-light">{{ $activity->created_at->diffForHumans() }}</span>
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted text-center">لا توجد تحديثات حديثة</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    {{-- Recent Books Table --}}
                    <div class="col-md-12 col-lg-8">
                        <div class="card shadow">
                            <div class="card-header">
                                <strong class="card-title">آخر الكتب</strong>
                                <a class="float-right small text-muted" href="{{ route('books.index') }}">عرض الكل</a>
                            </div>
                            <div class="card-body my-n2">
                                <table class="table table-striped table-hover table-borderless">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>العنوان</th>
                                            <th>القسم</th>
                                            <th>الحالة</th>
                                            <th>التاريخ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($recentBooks as $book)
                                            <tr>
                                                <td>{{ $book->book_no }}</td>
                                                <td>
                                                    <strong>{{ Str::limit($book->title, 30) }}</strong>
                                                </td>
                                                <td>{{ $book->department?->deparment_name ?? '-' }}</td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $statusColors[$book->status] ?? 'info' }}">
                                                        {{ $statusLabels[$book->status] ?? $book->status }}
                                                    </span>
                                                </td>
                                                <td>{{ $book->received_date }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">لا توجد كتب</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

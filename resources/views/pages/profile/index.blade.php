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
                <div class="row align-items-center mb-4">
                    <div class="col">
                        <h2 class="h5 page-title">
                            <span class="fe fe-user fe-24 mr-2 text-primary"></span>الملف الشخصي
                        </h2>
                    </div>
                </div>

                {{-- Success Message --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="row">
                    {{-- Profile Card --}}
                    <div class="col-md-12 col-lg-4 mb-4">
                        <div class="card shadow">
                            <div class="card-body text-center py-5">
                                {{-- Avatar --}}
                                <div class="avatar avatar-lg mb-3 mx-auto"
                                    style="width: 90px; height: 90px; background-color: #6c63ff; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <span class="text-white font-weight-bold"
                                        style="font-size: 2rem;">{{ mb_substr($user->name, 0, 1) }}</span>
                                </div>

                                <h4 class="mb-1">{{ $user->name }}</h4>
                                <p class="text-muted mb-2">{{ $user->email }}</p>

                                {{-- Account Status --}}
                                @if ($user->is_active)
                                    <span class="badge badge-success px-3 py-2">
                                        <span class="fe fe-check-circle mr-1"></span> حساب نشط
                                    </span>
                                @else
                                    <span class="badge badge-danger px-3 py-2">
                                        <span class="fe fe-x-circle mr-1"></span> حساب معطّل
                                    </span>
                                @endif

                                <hr class="my-4">

                                {{-- User Details --}}
                                <div class="text-right px-3">
                                    <div class="d-flex justify-content-between mb-3">
                                        <span class="text-muted"><i class="fe fe-grid mr-2"></i>القسم</span>
                                        <strong>{{ $user->department?->deparment_name ?? 'غير محدد' }}</strong>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <span class="text-muted"><i class="fe fe-calendar mr-2"></i>تاريخ
                                            الانضمام</span>
                                        <strong>{{ $user->created_at->format('Y/m/d') }}</strong>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <span class="text-muted"><i class="fe fe-book-open mr-2"></i>إجمالي
                                            الكتب</span>
                                        <strong>{{ $totalBooks }}</strong>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted"><i class="fe fe-trending-up mr-2"></i>كتب هذا
                                            الشهر</span>
                                        <strong>{{ $booksThisMonth }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Books Stats Card --}}
                        <div class="card shadow mt-4">
                            <div class="card-header">
                                <strong class="card-title">إحصائيات الكتب</strong>
                            </div>
                            <div class="card-body">
                                @foreach (['pending', 'completed', 'approved', 'rejected', 'archived'] as $status)
                                    @php
                                        $count = $statusCounts->get($status, 0);
                                        $percentage = $totalBooks > 0 ? round(($count / $totalBooks) * 100, 1) : 0;
                                    @endphp
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span class="small text-muted">{{ $statusLabels[$status] }}</span>
                                            <span class="small font-weight-bold">{{ $count }}</span>
                                        </div>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-{{ $statusColors[$status] }}" role="progressbar"
                                                style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}"
                                                aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Edit Profile & Recent Books --}}
                    <div class="col-md-12 col-lg-8">

                        {{-- Edit Profile Form --}}
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <strong class="card-title">تعديل البيانات الشخصية</strong>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('profile.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="name">الاسم</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name', $user->name) }}">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email">البريد الإلكتروني</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ old('email', $user->email) }}">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>القسم</label>
                                            <input type="text" class="form-control" disabled
                                                value="{{ $user->department?->deparment_name ?? 'غير محدد' }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>حالة الحساب</label>
                                            <input type="text" class="form-control" disabled
                                                value="{{ $user->is_active ? 'نشط' : 'معطّل' }}">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">
                                        <span class="fe fe-save mr-1"></span> حفظ التغييرات
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{-- Change Password --}}
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <strong class="card-title">تغيير كلمة المرور</strong>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('profile.password') }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="current_password">كلمة المرور الحالية</label>
                                            <input type="password"
                                                class="form-control @error('current_password') is-invalid @enderror"
                                                id="current_password" name="current_password">
                                            @error('current_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="password">كلمة المرور الجديدة</label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="password" name="password">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="password_confirmation">تأكيد كلمة المرور</label>
                                            <input type="password" class="form-control" id="password_confirmation"
                                                name="password_confirmation">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-warning">
                                        <span class="fe fe-lock mr-1"></span> تغيير كلمة المرور
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{-- Recent Books --}}
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
                                                <td><strong>{{ Str::limit($book->title, 30) }}</strong></td>
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

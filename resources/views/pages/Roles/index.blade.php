@extends('layouts.master')
@section('title', 'إدارة الأدوار')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">

                {{-- Page Header --}}
                <div class="row align-items-center mb-4">
                    <div class="col">
                        <h2 class="h5 page-title mb-0">
                            <span class="fe fe-shield fe-24 mr-2 text-primary"></span>إدارة الأدوار والصلاحيات
                        </h2>
                        <p class="text-muted small mt-1 mb-0">إدارة أدوار النظام وتعيين الصلاحيات لكل دور</p>
                    </div>
                    @can('roles.create')
                        <div class="col-auto">
                            <a href="{{ route('roles.create') }}" class="btn btn-primary shadow-sm">
                                <span class="fe fe-plus fe-16 mr-2"></span>إضافة دور جديد
                            </a>
                        </div>
                    @endcan
                </div>

                {{-- Success Alert --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4 shadow-sm" role="alert">
                        <span class="fe fe-check-circle fe-16 mr-2"></span>
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                {{-- Stats Row --}}
                <div class="row mb-4">
                    <div class="col-6 col-lg-3">
                        <div class="card shadow mb-4">
                            <div class="card-body text-center py-4">
                                <span class="fe fe-shield fe-24 text-primary mb-2 d-block"></span>
                                <p class="mb-1 small text-muted">إجمالي الأدوار</p>
                                <span class="h3">{{ $roles->count() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="card shadow mb-4">
                            <div class="card-body text-center py-4">
                                <span class="fe fe-key fe-24 text-warning mb-2 d-block"></span>
                                <p class="mb-1 small text-muted">إجمالي الصلاحيات</p>
                                <span
                                    class="h3">{{ $roles->pluck('permissions')->flatten()->unique('id')->count() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="card shadow mb-4">
                            <div class="card-body text-center py-4">
                                <span class="fe fe-users fe-24 text-success mb-2 d-block"></span>
                                <p class="mb-1 small text-muted">المستخدمون المعيّنون</p>
                                <span class="h3">{{ $roles->sum(fn($r) => $r->users()->count()) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="card shadow mb-4">
                            <div class="card-body text-center py-4">
                                <span class="fe fe-lock fe-24 text-danger mb-2 d-block"></span>
                                <p class="mb-1 small text-muted">أدوار بدون مستخدمين</p>
                                <span
                                    class="h3">{{ $roles->filter(fn($r) => $r->users()->count() === 0)->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Roles Cards --}}
                <div class="row">
                    @forelse ($roles as $role)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card shadow h-100 border-0">
                                <div
                                    class="card-header bg-white border-bottom d-flex align-items-center justify-content-between py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                                            style="width: 42px; height: 42px; background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);">
                                            <span class="fe fe-shield text-white" style="font-size: 18px;"></span>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 font-weight-bold">{{ $role->name }}</h6>
                                            <span class="text-muted small">{{ $role->users()->count() }} مستخدم</span>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-link text-muted p-0" data-toggle="dropdown">
                                            <span class="fe fe-more-vertical fe-16"></span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('roles.edit')
                                                <a href="{{ route('roles.edit', $role) }}" class="dropdown-item">
                                                    <span class="fe fe-edit fe-12 mr-2"></span>تعديل
                                                </a>
                                            @endcan
                                            @can('roles.delete')
                                                <div class="dropdown-divider"></div>
                                                <form action="{{ route('roles.destroy', $role) }}" method="POST"
                                                    onsubmit="return confirm('هل أنت متأكد من حذف هذا الدور؟')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <span class="fe fe-trash-2 fe-12 mr-2"></span>حذف
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body py-3">
                                    <p class="text-muted small mb-2 font-weight-bold">
                                        <span class="fe fe-key fe-12 mr-1"></span>
                                        الصلاحيات ({{ $role->permissions->count() }})
                                    </p>
                                    <div class="d-flex flex-wrap">
                                        @php
                                            $groupLabels = [
                                                'users' => 'المستخدمون',
                                                'roles' => 'الأدوار',
                                                'books' => 'الكتب',
                                                'departments' => 'الأقسام',
                                                'tags' => 'الوسوم',
                                                'reports' => 'التقارير',
                                            ];
                                            $actionLabels = [
                                                'view' => 'عرض',
                                                'create' => 'إنشاء',
                                                'edit' => 'تعديل',
                                                'delete' => 'حذف',
                                            ];
                                            $badgeColors = [
                                                'users' => 'primary',
                                                'roles' => 'info',
                                                'books' => 'success',
                                                'departments' => 'warning',
                                                'tags' => 'secondary',
                                                'reports' => 'dark',
                                            ];
                                        @endphp
                                        @forelse ($role->permissions->take(8) as $permission)
                                            @php
                                                $parts = explode('.', $permission->name);
                                                $group = $parts[0];
                                                $action = $parts[1] ?? $permission->name;
                                                $color = $badgeColors[$group] ?? 'light';
                                            @endphp
                                            <span class="badge badge-{{ $color }} mb-1 mr-1 px-2 py-1"
                                                style="font-size: 11px;">
                                                {{ $groupLabels[$group] ?? $group }} -
                                                {{ $actionLabels[$action] ?? $action }}
                                            </span>
                                        @empty
                                            <span class="text-muted small">لا توجد صلاحيات</span>
                                        @endforelse
                                        @if ($role->permissions->count() > 8)
                                            <span class="badge badge-light border mb-1 mr-1 px-2 py-1"
                                                style="font-size: 11px;">
                                                +{{ $role->permissions->count() - 8 }} أخرى
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-footer bg-white border-top py-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <span class="fe fe-clock fe-12 mr-1"></span>
                                            {{ $role->created_at?->diffForHumans() ?? 'غير محدد' }}
                                        </small>
                                        @can('roles.edit')
                                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-outline-primary">
                                                <span class="fe fe-edit-2 fe-12 mr-1"></span>تعديل الصلاحيات
                                            </a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="card shadow">
                                <div class="card-body text-center py-5">
                                    <span class="fe fe-shield fe-48 text-muted mb-3 d-block"></span>
                                    <h5 class="text-muted">لا يوجد أدوار</h5>
                                    <p class="text-muted small">ابدأ بإنشاء أول دور في النظام</p>
                                    @can('roles.create')
                                        <a href="{{ route('roles.create') }}" class="btn btn-primary mt-2">
                                            <span class="fe fe-plus fe-16 mr-2"></span>إضافة دور جديد
                                        </a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
@endsection

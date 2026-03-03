@extends('layouts.master')
@section('title', 'إدارة المستخدمين')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">

                {{-- Page Header --}}
                <div class="row align-items-center mb-4">
                    <div class="col">
                        <h2 class="h5 page-title mb-0">
                            <span class="fe fe-users fe-24 mr-2 text-primary"></span>إدارة المستخدمين
                        </h2>
                        <p class="text-muted small mt-1 mb-0">عرض وإدارة جميع مستخدمي النظام</p>
                    </div>
                    @can('users.create')
                        <div class="col-auto">
                            <a href="{{ route('users.create') }}" class="btn btn-primary shadow-sm">
                                <span class="fe fe-user-plus fe-16 mr-2"></span>إضافة مستخدم جديد
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
                                <span class="fe fe-users fe-24 text-primary mb-2 d-block"></span>
                                <p class="mb-1 small text-muted">إجمالي المستخدمين</p>
                                <span class="h3">{{ $users->total() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="card shadow mb-4">
                            <div class="card-body text-center py-4">
                                <span class="fe fe-user-check fe-24 text-success mb-2 d-block"></span>
                                <p class="mb-1 small text-muted">نشط</p>
                                <span class="h3">{{ $users->getCollection()->where('is_active', true)->count() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="card shadow mb-4">
                            <div class="card-body text-center py-4">
                                <span class="fe fe-user-x fe-24 text-danger mb-2 d-block"></span>
                                <p class="mb-1 small text-muted">غير نشط</p>
                                <span
                                    class="h3">{{ $users->getCollection()->where('is_active', false)->count() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="card shadow mb-4">
                            <div class="card-body text-center py-4">
                                <span class="fe fe-shield fe-24 text-info mb-2 d-block"></span>
                                <p class="mb-1 small text-muted">الأدوار المستخدمة</p>
                                <span
                                    class="h3">{{ $users->getCollection()->pluck('roles')->flatten()->unique('id')->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Users Table --}}
                <div class="card shadow border-0">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0 font-weight-bold">
                            <span class="fe fe-list fe-16 mr-2 text-primary"></span>قائمة المستخدمين
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0">#</th>
                                    <th class="border-0">المستخدم</th>
                                    <th class="border-0">القسم</th>
                                    <th class="border-0">الدور</th>
                                    <th class="border-0">الحالة</th>
                                    @canany(['users.edit', 'users.delete'])
                                        <th class="border-0">الإجراءات</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                                                    style="width: 36px; height: 36px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); flex-shrink: 0;">
                                                    <span class="text-white font-weight-bold"
                                                        style="font-size: 14px;">{{ mb_substr($user->name, 0, 1) }}</span>
                                                </div>
                                                <div>
                                                    <div class="font-weight-bold">{{ $user->name }}</div>
                                                    <small class="text-muted">{{ $user->email }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($user->department)
                                                <span
                                                    class="badge badge-light border px-2 py-1">{{ $user->department->deparment_name }}</span>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td>
                                            @foreach ($user->roles as $role)
                                                <span class="badge badge-primary px-2 py-1">{{ $role->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ($user->is_active)
                                                <span class="badge badge-success px-2 py-1">
                                                    <span class="fe fe-check-circle fe-12 mr-1"></span>نشط
                                                </span>
                                            @else
                                                <span class="badge badge-danger px-2 py-1">
                                                    <span class="fe fe-x-circle fe-12 mr-1"></span>غير نشط
                                                </span>
                                            @endif
                                        </td>
                                        @canany(['users.edit', 'users.delete'])
                                            <td>
                                                @can('users.edit')
                                                    <a href="{{ route('users.edit', $user) }}"
                                                        class="btn btn-sm btn-outline-primary" title="تعديل">
                                                        <span class="fe fe-edit fe-12"></span>
                                                    </a>
                                                @endcan
                                                @can('users.delete')
                                                    <form action="{{ route('users.destroy', $user) }}" method="POST"
                                                        class="d-inline"
                                                        onsubmit="return confirm('هل أنت متأكد من حذف هذا المستخدم؟')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="حذف">
                                                            <span class="fe fe-trash-2 fe-12"></span>
                                                        </button>
                                                    </form>
                                                @endcan
                                            </td>
                                        @endcanany
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <span class="fe fe-users fe-48 text-muted d-block mb-3"></span>
                                            <h6 class="text-muted">لا يوجد مستخدمين</h6>
                                            @can('users.create')
                                                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm mt-2">
                                                    <span class="fe fe-plus fe-12 mr-1"></span>إضافة مستخدم
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($users->hasPages())
                        <div class="card-footer bg-white d-flex justify-content-center py-3">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection

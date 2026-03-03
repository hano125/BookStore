@extends('layouts.master')
@section('title', 'تعديل الدور')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">

                {{-- Page Header --}}
                <div class="row align-items-center mb-4">
                    <div class="col">
                        <h2 class="h5 page-title mb-0">
                            <span class="fe fe-edit fe-24 mr-2 text-primary"></span>تعديل الدور: {{ $role->name }}
                        </h2>
                        <p class="text-muted small mt-1 mb-0">تعديل اسم الدور وصلاحياته في النظام</p>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary shadow-sm">
                            <span class="fe fe-arrow-right fe-16 mr-2"></span>رجوع
                        </a>
                    </div>
                </div>

                <form action="{{ route('roles.update', $role) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Role Name Card --}}
                    <div class="card shadow mb-4 border-0">
                        <div class="card-header bg-white py-3">
                            <h6 class="mb-0 font-weight-bold">
                                <span class="fe fe-tag fe-16 mr-2 text-primary"></span>معلومات الدور
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-0">
                                <label for="name" class="font-weight-bold">اسم الدور <span
                                        class="text-danger">*</span></label>
                                <input type="text"
                                    class="form-control form-control-lg @error('name') is-invalid @enderror" id="name"
                                    name="name" value="{{ old('name', $role->name) }}"
                                    placeholder="مثال: مدير، مشرف، موظف..." required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Permissions Card --}}
                    <div class="card shadow mb-4 border-0">
                        <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                            <h6 class="mb-0 font-weight-bold">
                                <span class="fe fe-key fe-16 mr-2 text-warning"></span>الصلاحيات
                                <span class="badge badge-primary mr-2"
                                    id="selectedCount">{{ $role->permissions->count() }}</span>
                            </h6>
                            <div>
                                <button type="button" class="btn btn-sm btn-outline-primary mr-1" id="selectAll">تحديد
                                    الكل</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" id="deselectAll">إلغاء
                                    الكل</button>
                            </div>
                        </div>
                        <div class="card-body">
                            @error('permissions')
                                <div class="alert alert-danger py-2 small mb-3">
                                    <span class="fe fe-alert-circle fe-12 mr-1"></span>{{ $message }}
                                </div>
                            @enderror

                            @php
                                $grouped = $permissions->groupBy(function ($permission) {
                                    return explode('.', $permission->name)[0];
                                });
                                $rolePermissions = old('permissions', $role->permissions->pluck('name')->toArray());
                                $groupLabels = [
                                    'users' => 'المستخدمون',
                                    'roles' => 'الأدوار',
                                    'books' => 'الكتب',
                                    'departments' => 'الأقسام',
                                    'tags' => 'الوسوم',
                                    'reports' => 'التقارير',
                                ];
                                $groupIcons = [
                                    'users' => 'fe-users',
                                    'roles' => 'fe-shield',
                                    'books' => 'fe-book-open',
                                    'departments' => 'fe-briefcase',
                                    'tags' => 'fe-tag',
                                    'reports' => 'fe-bar-chart-2',
                                ];
                                $groupColors = [
                                    'users' => 'primary',
                                    'roles' => 'info',
                                    'books' => 'success',
                                    'departments' => 'warning',
                                    'tags' => 'secondary',
                                    'reports' => 'dark',
                                ];
                                $actionLabels = [
                                    'view' => 'عرض',
                                    'create' => 'إنشاء',
                                    'edit' => 'تعديل',
                                    'delete' => 'حذف',
                                ];
                                $actionIcons = [
                                    'view' => 'fe-eye',
                                    'create' => 'fe-plus-circle',
                                    'edit' => 'fe-edit-2',
                                    'delete' => 'fe-trash-2',
                                ];
                            @endphp

                            <div class="row">
                                @foreach ($grouped as $group => $perms)
                                    @php
                                        $groupPerms = $perms->pluck('name')->toArray();
                                        $allChecked =
                                            count(array_intersect($groupPerms, $rolePermissions)) ===
                                            count($groupPerms);
                                    @endphp
                                    <div class="col-md-6 col-lg-4 mb-3">
                                        <div class="card border h-100">
                                            <div
                                                class="card-header py-2 d-flex align-items-center justify-content-between bg-light">
                                                <div class="d-flex align-items-center">
                                                    <span
                                                        class="fe {{ $groupIcons[$group] ?? 'fe-circle' }} fe-16 mr-2 text-{{ $groupColors[$group] ?? 'muted' }}"></span>
                                                    <strong class="small">{{ $groupLabels[$group] ?? $group }}</strong>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input group-toggle"
                                                        id="group_{{ $group }}" data-group="{{ $group }}"
                                                        {{ $allChecked ? 'checked' : '' }}>
                                                    <label class="custom-control-label small"
                                                        for="group_{{ $group }}">الكل</label>
                                                </div>
                                            </div>
                                            <div class="card-body py-2 px-3">
                                                @foreach ($perms as $permission)
                                                    @php
                                                        $action =
                                                            explode('.', $permission->name)[1] ?? $permission->name;
                                                    @endphp
                                                    <div class="custom-control custom-checkbox mb-2">
                                                        <input type="checkbox"
                                                            class="custom-control-input perm-checkbox perm-{{ $group }}"
                                                            id="perm_{{ $permission->id }}" name="permissions[]"
                                                            value="{{ $permission->name }}"
                                                            {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                                                        <label class="custom-control-label d-flex align-items-center"
                                                            for="perm_{{ $permission->id }}">
                                                            <span
                                                                class="fe {{ $actionIcons[$action] ?? 'fe-circle' }} fe-12 mr-2 text-muted"></span>
                                                            {{ $actionLabels[$action] ?? $action }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="d-flex justify-content-end mb-4">
                        <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary mr-2">إلغاء</a>
                        <button type="submit" class="btn btn-primary shadow-sm px-4">
                            <span class="fe fe-save fe-16 mr-2"></span>تحديث الدور
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function updateCount() {
            $('#selectedCount').text($('.perm-checkbox:checked').length);
        }
        // Select All / Deselect All
        $('#selectAll').on('click', function() {
            $('.perm-checkbox').prop('checked', true);
            $('.group-toggle').prop('checked', true);
            updateCount();
        });
        $('#deselectAll').on('click', function() {
            $('.perm-checkbox').prop('checked', false);
            $('.group-toggle').prop('checked', false);
            updateCount();
        });
        // Group toggle
        $('.group-toggle').on('change', function() {
            var group = $(this).data('group');
            $('.perm-' + group).prop('checked', $(this).is(':checked'));
            updateCount();
        });
        // Update group toggle when individual checkboxes change
        $('.perm-checkbox').on('change', function() {
            var classes = $(this).attr('class').split(' ');
            var groupClass = classes.find(c => c.startsWith('perm-') && c !== 'perm-checkbox');
            if (groupClass) {
                var group = groupClass.replace('perm-', '');
                var total = $('.perm-' + group).length;
                var checked = $('.perm-' + group + ':checked').length;
                $('#group_' + group).prop('checked', total === checked);
            }
            updateCount();
        });
    </script>
@endsection

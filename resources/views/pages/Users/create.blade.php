@extends('layouts.master')
@section('title', 'إضافة مستخدم جديد')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">

                {{-- Page Header --}}
                <div class="row align-items-center mb-4">
                    <div class="col">
                        <h2 class="h5 page-title mb-0">
                            <span class="fe fe-user-plus fe-24 mr-2 text-primary"></span>إضافة مستخدم جديد
                        </h2>
                        <p class="text-muted small mt-1 mb-0">إنشاء حساب مستخدم جديد وتعيين دوره في النظام</p>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary shadow-sm">
                            <span class="fe fe-arrow-right fe-16 mr-2"></span>رجوع
                        </a>
                    </div>
                </div>

                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    {{-- Personal Info Card --}}
                    <div class="card shadow mb-4 border-0">
                        <div class="card-header bg-white py-3">
                            <h6 class="mb-0 font-weight-bold">
                                <span class="fe fe-user fe-16 mr-2 text-primary"></span>المعلومات الشخصية
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="name" class="font-weight-bold">الاسم <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name') }}"
                                            placeholder="الاسم الكامل" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="email" class="font-weight-bold">البريد الإلكتروني <span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}"
                                            placeholder="example@domain.com" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="password" class="font-weight-bold">كلمة المرور <span
                                                class="text-danger">*</span></label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" placeholder="6 أحرف على الأقل" required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="password_confirmation" class="font-weight-bold">تأكيد كلمة المرور <span
                                                class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" placeholder="أعد كتابة كلمة المرور" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Role & Department Card --}}
                    <div class="card shadow mb-4 border-0">
                        <div class="card-header bg-white py-3">
                            <h6 class="mb-0 font-weight-bold">
                                <span class="fe fe-settings fe-16 mr-2 text-warning"></span>الدور والقسم
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="role" class="font-weight-bold">الدور <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control select2 @error('role') is-invalid @enderror"
                                            id="role" name="role" required>
                                            <option value="">-- اختر الدور --</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}"
                                                    {{ old('role') == $role->name ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="deparment_id" class="font-weight-bold">القسم</label>
                                        <select class="form-control select2 @error('deparment_id') is-invalid @enderror"
                                            id="deparment_id" name="deparment_id">
                                            <option value="">-- اختر القسم --</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->deparment_id }}"
                                                    {{ old('deparment_id') == $department->deparment_id ? 'selected' : '' }}>
                                                    {{ $department->deparment_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('deparment_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="custom-control custom-switch">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" class="custom-control-input" id="is_active" name="is_active"
                                        value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label font-weight-bold" for="is_active">
                                        حالة الحساب: <span class="text-success">نشط</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="d-flex justify-content-end mb-4">
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary mr-2">إلغاء</a>
                        <button type="submit" class="btn btn-primary shadow-sm px-4">
                            <span class="fe fe-save fe-16 mr-2"></span>حفظ المستخدم
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

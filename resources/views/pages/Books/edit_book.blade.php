@extends('layouts.master')
@section('title', 'تعديل الكتاب')
@section('content')
    <div class="container-fluid create-book-page">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10">

                {{-- Page Header --}}
                <div class="row align-items-center mb-4 page-header">
                    <div class="col">
                        <h2 class="page-title mb-0">
                            <span class="fe fe-edit fe-24 mr-2 text-primary"></span>تعديل الكتاب
                        </h2>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('books.index') }}" class="btn btn-outline-secondary btn-back">
                            <span class="fe fe-arrow-right fe-16 mr-2"></span>العودة للقائمة
                        </a>
                    </div>
                </div>

                {{-- Main Form Card --}}
                <div class="card form-card mb-4 fade-in-up">
                    <div class="card-header">
                        <strong class="card-title mb-0">
                            <span class="fe fe-edit-3 fe-16 mr-2"></span>تعديل معلومات الكتاب
                        </strong>
                    </div>
                    <div class="card-body">

                        {{-- Success Alert --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                <span class="fe fe-check-circle fe-16 mr-2"></span>
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        {{-- Error Alert --}}
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                <span class="fe fe-alert-circle fe-16 mr-2"></span>
                                <strong>يوجد أخطاء في النموذج:</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Section: Basic Info --}}
                            <div class="section-header">
                                <span class="fe fe-info fe-16"></span>
                                المعلومات الأساسية
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="title">عنوان الكتاب <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ old('title', $book->title) }}"
                                        placeholder="أدخل عنوان الكتاب" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="sender_entity">الجهة المرسلة <span class="text-danger">*</span></label>
                                    <select class="form-control @error('sender_entity') is-invalid @enderror"
                                        id="sender_entity" name="sender_entity" required>
                                        <option value="">اختر الجهة المرسلة</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->deparment_name }}"
                                                {{ old('sender_entity', $book->sender_entity) == $department->deparment_name ? 'selected' : '' }}>
                                                {{ $department->deparment_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('sender_entity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="received_date">تاريخ الاستلام <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('received_date') is-invalid @enderror"
                                        id="received_date" name="received_date"
                                        value="{{ old('received_date', $book->received_date) }}" required>
                                    @error('received_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="book_no">رقم الكتاب <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('book_no') is-invalid @enderror"
                                        id="book_no" name="book_no" value="{{ old('book_no', $book->book_no) }}"
                                        placeholder="أدخل رقم الكتاب" required>
                                    @error('book_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="status">الحالة <span class="text-danger">*</span></label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status"
                                        name="status" required>
                                        <option value="">اختر الحالة</option>
                                        <option value="pending"
                                            {{ old('status', $book->status) == 'pending' ? 'selected' : '' }}>قيد الانتظار
                                        </option>
                                        <option value="in_progress"
                                            {{ old('status', $book->status) == 'in_progress' ? 'selected' : '' }}>قيد
                                            المعالجة</option>
                                        <option value="completed"
                                            {{ old('status', $book->status) == 'completed' ? 'selected' : '' }}>مكتمل
                                        </option>
                                        <option value="approved"
                                            {{ old('status', $book->status) == 'approved' ? 'selected' : '' }}>تمت
                                            الموافقة</option>
                                        <option value="rejected"
                                            {{ old('status', $book->status) == 'rejected' ? 'selected' : '' }}>مرفوض
                                        </option>
                                        <option value="archived"
                                            {{ old('status', $book->status) == 'archived' ? 'selected' : '' }}>مؤرشف
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="deparment_id">القسم</label>
                                    <select class="form-control @error('deparment_id') is-invalid @enderror"
                                        id="deparment_id" name="deparment_id">
                                        <option value="">اختر القسم</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->deparment_id }}"
                                                {{ old('deparment_id', $book->deparment_id) == $department->deparment_id ? 'selected' : '' }}>
                                                {{ $department->deparment_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('deparment_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="notes">ملاحظات</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3"
                                        placeholder="أدخل ملاحظات إضافية (اختياري)">{{ old('notes', $book->notes) }}</textarea>
                                    @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- File Upload --}}
                            <div class="form-group">
                                <label for="attachment_path">مرفق الكتاب</label>
                                @if ($book->attachment_path)
                                    <div class="mb-2">
                                        <a href="{{ asset('storage/' . $book->attachment_path) }}" target="_blank"
                                            class="btn btn-sm btn-outline-info">
                                            <span class="fe fe-paperclip mr-1"></span>عرض المرفق الحالي
                                        </a>
                                    </div>
                                @endif
                                <div class="file-upload-wrapper">
                                    <span class="fe fe-upload-cloud upload-icon"></span>
                                    <div class="upload-text">اسحب الملف هنا أو انقر للاختيار</div>
                                    <div class="upload-hint">PDF, DOC, DOCX — الحد الأقصى 10 ميغابايت (اترك فارغاً للاحتفاظ
                                        بالمرفق الحالي)</div>
                                    <input type="file" class="@error('attachment_path') is-invalid @enderror"
                                        id="attachment_path" name="attachment_path" accept=".pdf,.doc,.docx">
                                </div>
                                @error('attachment_path')
                                    <div class="text-danger mt-1" style="font-size: 0.85rem;">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="section-divider">

                            {{-- Section: Users --}}
                            <div class="section-header">
                                <span class="fe fe-users fe-16"></span>
                                الاشخاص الموجودين في الهامش
                            </div>

                            {{-- Existing users --}}
                            <div id="users-container">
                                @foreach ($book->users->where('id', '!=', Auth::id()) as $index => $bookUser)
<div class="user-item card mb-3 user-card">
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="form-group col-md-5">
                                                    <label>المستخدم</label>
                                                    <select class="form-control"
                                                        name="users[{{ $index }}][user_id]" required>
                                                        <option value="">اختر المستخدم</option>
                                                        @foreach ($users as $user)
<option value="{{ $user->id }}"
                                                                {{ $bookUser->id == $user->id ? 'selected' : '' }}>
                                                                {{ $user->name }}
                                                            </option>
@endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>الدور</label>
                                                    <input type="text" class="form-control"
                                                        name="users[{{ $index }}][role_in_book]"
                                                        value="{{ $bookUser->pivot->role_in_book }}"
                                                        placeholder="مثال: مراجع، معتمد">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label>رئيسي</label>
                                                    <div class="custom-control custom-checkbox mt-2">
                                                        <input type="hidden"
                                                            name="users[{{ $index }}][is_primary]" value="0">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="users-{{ $index }}-is_primary"
                                                            name="users[{{ $index }}][is_primary]" value="1"
                                                            {{ $bookUser->pivot->is_primary ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="users-{{ $index }}-is_primary">مستخدم رئيسي</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-1 d-flex align-items-end">
                                                    <button type="button" class="btn btn-danger btn-block remove-user">
                                                        <span class="fe fe-trash-2"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
@endforeach
                            </div>

                            <button type="button" class="btn btn-outline-primary btn-add-user mb-4" id="add-user">
                                <span class="fe fe-plus fe-16 mr-2"></span> إضافة شخص للهامش
                            </button>

                            <hr class="section-divider">

                            {{-- Section: Tags --}}
                            <div class="section-header">
                                <span class="fe fe-tag fe-16"></span>
                                الوسوم
                            </div>

                            <div class="form-group">
                                <label for="tags">اختر الوسوم</label>
                                <select class="form-control tags-select @error('tags') is-invalid @enderror"
                                    id="tags" name="tags[]" multiple>
                                    @foreach ($tags as $tag)
<option value="{{ $tag->id }}"
                                            {{ $book->tags->contains($tag->id) ? 'selected' : '' }}>
                                            {{ $tag->tag_name }}
                                        </option>
@endforeach
                                </select>
                                @error('tags')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                <small class="form-text text-muted">يمكنك اختيار أكثر من وسم</small>
                            </div>

                            <hr class="section-divider">

                            {{-- Form Actions --}}
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <span class="fe fe-save fe-16 mr-2"></span>حفظ التعديلات
                                </button>
                                <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">
                                    <span class="fe fe-x fe-16 mr-2"></span>إلغاء
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        jQuery(document).ready(function($) {
            let userIndex = {{ $book->users->where('id', '!=', Auth::id())->count() }};

            $('#add-user').click(function() {
                const userItem = `
                <div class="user-item card mb-3 user-card">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label>المستخدم</label>
                                <select class="form-control" name="users[${userIndex}][user_id]" required>
                                    <option value="">اختر المستخدم</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>الدور</label>
                                <input type="text" class="form-control" name="users[${userIndex}][role_in_book]" placeholder="مثال: مراجع، معتمد">
                            </div>
                            <div class="form-group col-md-2">
                                <label>رئيسي</label>
                                <div class="custom-control custom-checkbox mt-2">
                                    <input type="hidden" name="users[${userIndex}][is_primary]" value="0">
                                    <input type="checkbox" class="custom-control-input" id="users-${userIndex}-is_primary" name="users[${userIndex}][is_primary]" value="1">
                                    <label class="custom-control-label" for="users-${userIndex}-is_primary">مستخدم رئيسي</label>
                                </div>
                            </div>
                            <div class="form-group col-md-1 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-block remove-user">
                                    <span class="fe fe-trash-2"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>`;

                $('#users-container').append(userItem);
                userIndex++;
            });

            $(document).on('click', '.remove-user', function() {
                $(this).closest('.user-item').remove();
            });
        });
    </script>
@endsection)

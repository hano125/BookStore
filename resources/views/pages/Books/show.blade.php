@extends('layouts.master')
@section('title', $book->title)
@section('content')
    @php
        $statusLabels = [
            'pending' => 'قيد الانتظار',
            'completed' => 'مكتمل',
            'approved' => 'تمت الموافقة',
            'in_progress' => 'قيد المعالجة',
            'rejected' => 'مرفوض',
            'archived' => 'مؤرشف',
        ];
        $statusColors = [
            'pending' => 'warning',
            'completed' => 'success',
            'approved' => 'primary',
            'in_progress' => 'info',
            'rejected' => 'danger',
            'archived' => 'secondary',
        ];
    @endphp

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10">

                {{-- Page Header --}}
                <div class="row align-items-center mb-4">
                    <div class="col">
                        <h2 class="h5 page-title mb-0">
                            <span class="fe fe-book-open fe-24 mr-2 text-primary"></span>تفاصيل الكتاب
                        </h2>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary btn-sm mr-2">
                            <span class="fe fe-edit fe-14 mr-1"></span>تعديل
                        </a>
                        <a href="{{ route('books.index') }}" class="btn btn-outline-secondary btn-sm">
                            <span class="fe fe-arrow-right fe-14 mr-1"></span>العودة للقائمة
                        </a>
                    </div>
                </div>

                <div class="row">
                    {{-- Book Details --}}
                    <div class="col-md-12 col-lg-8 mb-4">
                        <div class="card shadow">
                            <div class="card-header">
                                <strong class="card-title">
                                    <span class="fe fe-info fe-16 mr-2"></span>معلومات الكتاب
                                </strong>
                                <span
                                    class="badge badge-{{ $statusColors[$book->status] ?? 'info' }} float-right px-3 py-2">
                                    {{ $statusLabels[$book->status] ?? $book->status }}
                                </span>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-4 text-muted">عنوان الكتاب</div>
                                    <div class="col-sm-8"><strong>{{ $book->title }}</strong></div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-sm-4 text-muted">رقم الكتاب</div>
                                    <div class="col-sm-8">{{ $book->book_no }}</div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-sm-4 text-muted">الجهة المرسلة</div>
                                    <div class="col-sm-8">{{ $book->sender_entity }}</div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-sm-4 text-muted">القسم</div>
                                    <div class="col-sm-8">
                                        @if ($book->department)
                                            <span
                                                class="fe fe-briefcase fe-14 mr-1"></span>{{ $book->department->deparment_name }}
                                        @else
                                            <span class="text-muted">غير محدد</span>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-sm-4 text-muted">تاريخ الاستلام</div>
                                    <div class="col-sm-8">
                                        <span class="fe fe-calendar fe-14 mr-1"></span>{{ $book->received_date }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-sm-4 text-muted">تاريخ الإنشاء</div>
                                    <div class="col-sm-8">{{ $book->created_at->format('Y/m/d H:i') }}</div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-sm-4 text-muted">آخر تحديث</div>
                                    <div class="col-sm-8">{{ $book->updated_at->format('Y/m/d H:i') }}</div>
                                </div>
                                @if ($book->notes)
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-sm-4 text-muted">ملاحظات</div>
                                        <div class="col-sm-8">{{ $book->notes }}</div>
                                    </div>
                                @endif
                                @if ($book->attachment_path)
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-sm-4 text-muted">المرفق</div>
                                        <div class="col-sm-8">
                                            <a href="{{ asset('storage/' . $book->attachment_path) }}" target="_blank"
                                                class="btn btn-sm btn-outline-info">
                                                <span class="fe fe-paperclip fe-14 mr-1"></span>تحميل المرفق
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar --}}
                    <div class="col-md-12 col-lg-4 mb-4">
                        {{-- Users --}}
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <strong class="card-title">
                                    <span class="fe fe-users fe-16 mr-2"></span>المستخدمون
                                </strong>
                            </div>
                            <div class="card-body">
                                @forelse ($book->users as $bookUser)
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar avatar-sm mr-3"
                                            style="width: 36px; height: 36px; background-color: #6c63ff; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                            <span class="text-white small">{{ mb_substr($bookUser->name, 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <strong class="d-block">{{ $bookUser->name }}</strong>
                                            <small class="text-muted">
                                                {{ $bookUser->pivot->role_in_book }}
                                                @if ($bookUser->pivot->is_primary)
                                                    <span class="badge badge-primary ml-1">رئيسي</span>
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted mb-0">لا يوجد مستخدمون</p>
                                @endforelse
                            </div>
                        </div>

                        {{-- Tags --}}
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <strong class="card-title">
                                    <span class="fe fe-tag fe-16 mr-2"></span>الوسوم
                                </strong>
                            </div>
                            <div class="card-body">
                                @forelse ($book->tags as $tag)
                                    <span class="badge badge-light px-2 py-1 mr-1 mb-1" style="font-size: 0.85rem;">
                                        <span class="fe fe-tag fe-12 mr-1"></span>{{ $tag->tag_name }}
                                    </span>
                                @empty
                                    <p class="text-muted mb-0">لا توجد وسوم</p>
                                @endforelse
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="card shadow">
                            <div class="card-header">
                                <strong class="card-title">
                                    <span class="fe fe-settings fe-16 mr-2"></span>الإجراءات
                                </strong>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary btn-block mb-2">
                                    <span class="fe fe-edit fe-14 mr-1"></span>تعديل الكتاب
                                </a>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                    onsubmit="return confirm('هل أنت متأكد من حذف هذا الكتاب؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-block">
                                        <span class="fe fe-trash-2 fe-14 mr-1"></span>حذف الكتاب
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Status History --}}
                @if ($book->statusHistory->isNotEmpty())
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <strong class="card-title">
                                <span class="fe fe-clock fe-16 mr-2"></span>سجل تغييرات الحالة
                            </strong>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>التاريخ</th>
                                            <th>الحالة السابقة</th>
                                            <th>الحالة الجديدة</th>
                                            <th>بواسطة</th>
                                            <th>ملاحظة</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($book->statusHistory->sortByDesc('created_at') as $history)
                                            <tr>
                                                <td>{{ $history->created_at->format('Y/m/d H:i') }}</td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $statusColors[$history->old_status] ?? 'light' }}">
                                                        {{ $statusLabels[$history->old_status] ?? $history->old_status }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $statusColors[$history->new_status] ?? 'light' }}">
                                                        {{ $statusLabels[$history->new_status] ?? $history->new_status }}
                                                    </span>
                                                </td>
                                                <td>{{ $history->changer?->name ?? '-' }}</td>
                                                <td>{{ $history->note ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Supervisor Notes --}}
                @if ($book->supervisorNotes->isNotEmpty())
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <strong class="card-title">
                                <span class="fe fe-message-square fe-16 mr-2"></span>ملاحظات المشرف
                            </strong>
                        </div>
                        <div class="card-body">
                            @foreach ($book->supervisorNotes->sortByDesc('created_at') as $note)
                                <div class="border-bottom pb-3 mb-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <strong>{{ $note->supervisor?->name ?? '-' }}</strong>
                                        <small class="text-muted">{{ $note->created_at->format('Y/m/d H:i') }}</small>
                                    </div>
                                    <p class="mb-0 text-muted">{{ $note->note }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection

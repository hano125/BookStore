{{-- Desktop Table View --}}
<div class="card books-card mb-4 d-none d-lg-block">
    <div class="card-header">
        <strong class="card-title mb-0">
            <span class="fe fe-list fe-16 mr-2"></span>قائمة الكتب
        </strong>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table books-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>رقم الكتاب</th>
                        <th>عنوان الكتاب</th>
                        <th>الجهة المرسلة</th>
                        <th>القسم</th>
                        <th>تاريخ الاستلام</th>
                        <th>الحالة</th>
                        <th>المرفق</th>
                        <th>المستخدمون</th>
                        <th>الوسوم</th>
                        <th class="text-center" style="width: 140px;">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)
                        <tr class="fade-in">
                            <td class="row-number">{{ $loop->iteration }}</td>
                            <td><span class="text-muted">{{ $book->book_no ?? '—' }}</span></td>
                            <td><span class="book-title">{{ $book->title }}</span></td>
                            <td>{{ $book->sender_entity }}</td>
                            <td>
                                @if ($book->department)
                                    <span class="department-badge">
                                        <span
                                            class="fe fe-briefcase fe-12 mr-1"></span>{{ $book->department->deparment_name }}
                                    </span>
                                @else
                                    <span class="text-muted" style="font-size: 0.8rem;">—</span>
                                @endif
                            </td>
                            <td>
                                <span class="fe fe-calendar fe-12 mr-1 text-muted"></span>{{ $book->received_date }}
                            </td>
                            <td>
                                <span class="badge badge-{{ $statusColors[$book->status] ?? 'info' }} status-badge">
                                    {{ $statusLabels[$book->status] ?? $book->status }}
                                </span>
                            </td>
                            <td>
                                @if ($book->attachment_path)
                                    <a href="{{ asset('storage/' . $book->attachment_path) }}" target="_blank"
                                        class="btn-action btn-file" title="تحميل المرفق">
                                        <span class="fe fe-paperclip fe-14"></span>
                                    </a>
                                @else
                                    <span class="text-muted" style="font-size: 0.8rem;">—</span>
                                @endif
                            </td>
                            <td>
                                @forelse ($book->users as $bookUser)
                                    <span class="user-badge">
                                        <span class="fe fe-user fe-12 mr-1"></span>{{ $bookUser->name }}
                                    </span>
                                @empty
                                    <span class="text-muted" style="font-size: 0.8rem;">—</span>
                                @endforelse
                            </td>
                            <td>
                                @forelse ($book->tags as $tag)
                                    <span class="tag-badge">
                                        <span class="fe fe-tag fe-12 mr-1"></span>{{ $tag->tag_name }}
                                    </span>
                                @empty
                                    <span class="text-muted" style="font-size: 0.8rem;">—</span>
                                @endforelse
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center" style="gap: 0.4rem;">
                                    <a href="{{ route('books.show', $book->id) }}" class="btn-action btn-view"
                                        title="عرض الكتاب">
                                        <span class="fe fe-eye fe-14"></span>
                                    </a>
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn-action btn-edit"
                                        title="تعديل">
                                        <span class="fe fe-edit fe-14"></span>
                                    </a>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('هل أنت متأكد من حذف هذا الكتاب؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="حذف">
                                            <span class="fe fe-trash-2 fe-14"></span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11">
                                <div class="empty-state">
                                    <span class="fe fe-inbox empty-icon"></span>
                                    <p class="empty-title">لا توجد كتب حالياً</p>
                                    <p class="empty-text">قم بإضافة كتاب جديد للبدء</p>
                                    <a href="{{ route('books.create') }}" class="btn btn-primary btn-sm btn-add-book">
                                        <span class="fe fe-plus fe-14 mr-1"></span>إضافة كتاب
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

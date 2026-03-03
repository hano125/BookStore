{{-- Book Detail Modal --}}
<div class="modal fade book-detail-modal" id="bookModal-{{ $book->id }}" tabindex="-1" role="dialog"
    aria-labelledby="bookModalLabel-{{ $book->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">

            {{-- Header --}}
            <div class="modal-header">
                <h5 class="modal-title" id="bookModalLabel-{{ $book->id }}">
                    <span class="fe fe-book-open fe-20 mr-2"></span>تفاصيل الكتاب
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {{-- Body --}}
            <div class="modal-body">

                {{-- Basic Info --}}
                <div class="modal-section">
                    <div class="modal-section-header">
                        <span class="fe fe-info fe-16 mr-2"></span>المعلومات الأساسية
                    </div>
                    <div class="modal-info-grid">
                        <div class="modal-info-item">
                            <span class="modal-info-label">رقم الكتاب</span>
                            <span class="modal-info-value">{{ $book->book_no ?? 'غير محدد' }}</span>
                        </div>
                        <div class="modal-info-item">
                            <span class="modal-info-label">عنوان الكتاب</span>
                            <span class="modal-info-value">{{ $book->title }}</span>
                        </div>
                        <div class="modal-info-item">
                            <span class="modal-info-label">الجهة المرسلة</span>
                            <span class="modal-info-value">{{ $book->sender_entity }}</span>
                        </div>
                        <div class="modal-info-item">
                            <span class="modal-info-label">تاريخ الاستلام</span>
                            <span class="modal-info-value">
                                <span class="fe fe-calendar fe-12 mr-1"></span>{{ $book->received_date }}
                            </span>
                        </div>
                        <div class="modal-info-item">
                            <span class="modal-info-label">الحالة</span>
                            <span class="modal-info-value">
                                <span class="badge badge-{{ $statusColors[$book->status] ?? 'info' }} status-badge">
                                    {{ $statusLabels[$book->status] ?? $book->status }}
                                </span>
                            </span>
                        </div>
                        <div class="modal-info-item">
                            <span class="modal-info-label">القسم</span>
                            <span class="modal-info-value">
                                @if ($book->department)
                                    <span class="department-badge">
                                        <span
                                            class="fe fe-briefcase fe-12 mr-1"></span>{{ $book->department->deparment_name }}
                                    </span>
                                @else
                                    <span class="text-null">غير محدد</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Notes --}}
                <div class="modal-section">
                    <div class="modal-section-header">
                        <span class="fe fe-file-text fe-16 mr-2"></span>ملاحظات الكتاب
                    </div>
                    @if ($book->notes)
                        <div class="modal-notes-box">{{ $book->notes }}</div>
                    @else
                        <div class="modal-empty-text">لا توجد ملاحظات</div>
                    @endif
                </div>

                {{-- Attachment --}}
                <div class="modal-section">
                    <div class="modal-section-header">
                        <span class="fe fe-paperclip fe-16 mr-2"></span>المرفقات
                    </div>
                    @if ($book->attachment_path)
                        <div class="modal-attachment">
                            <div class="attachment-file-info">
                                <span class="fe fe-file fe-20 mr-2 text-primary"></span>
                                <div>
                                    <div class="attachment-name">{{ basename($book->attachment_path) }}</div>
                                    <div class="attachment-path text-muted">{{ $book->attachment_path }}</div>
                                </div>
                            </div>
                            <a href="{{ asset('storage/' . $book->attachment_path) }}" target="_blank"
                                class="btn btn-sm btn-primary">
                                <span class="fe fe-download fe-14 mr-1"></span>تحميل
                            </a>
                        </div>
                    @else
                        <div class="modal-empty-text">لا توجد مرفقات</div>
                    @endif
                </div>

                {{-- Users --}}
                <div class="modal-section">
                    <div class="modal-section-header">
                        <span class="fe fe-users fe-16 mr-2"></span>المستخدمون
                        @if ($book->users->isNotEmpty())
                            <span class="badge badge-primary ml-2">{{ $book->users->count() }}</span>
                        @endif
                    </div>
                    @if ($book->users->isNotEmpty())
                        <div class="modal-relation-list">
                            @foreach ($book->users as $bookUser)
                                <div class="modal-user-card">
                                    <div class="modal-user-avatar">
                                        <span class="fe fe-user fe-16"></span>
                                    </div>
                                    <div class="modal-user-info">
                                        <div class="modal-user-name">{{ $bookUser->name }}</div>
                                        <div class="modal-user-meta">
                                            <span class="modal-user-role">
                                                <span
                                                    class="fe fe-shield fe-10 mr-1"></span>{{ $bookUser->pivot->role_in_book ?? 'غير محدد' }}
                                            </span>
                                            @if ($bookUser->pivot->is_primary)
                                                <span class="badge badge-info badge-sm">رئيسي</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="modal-empty-text">لا يوجد مستخدمون مرتبطون</div>
                    @endif
                </div>

                {{-- Tags --}}
                <div class="modal-section">
                    <div class="modal-section-header">
                        <span class="fe fe-tag fe-16 mr-2"></span>الوسوم
                    </div>
                    @if ($book->tags->isNotEmpty())
                        <div class="modal-tags-wrap">
                            @foreach ($book->tags as $tag)
                                <span class="tag-badge tag-badge-lg">
                                    <span class="fe fe-tag fe-12 mr-1"></span>{{ $tag->tag_name }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <div class="modal-empty-text">لا توجد وسوم</div>
                    @endif
                </div>

                {{-- Status History --}}
                <div class="modal-section">
                    <div class="modal-section-header">
                        <span class="fe fe-clock fe-16 mr-2"></span>سجل الحالات
                        @if ($book->statusHistory->isNotEmpty())
                            <span class="badge badge-primary ml-2">{{ $book->statusHistory->count() }}</span>
                        @endif
                    </div>
                    @if ($book->statusHistory->isNotEmpty())
                        <div class="modal-timeline">
                            @foreach ($book->statusHistory->sortByDesc('created_at') as $history)
                                <div class="timeline-item">
                                    <div class="timeline-dot"></div>
                                    <div class="timeline-content">
                                        <div class="timeline-header">
                                            <span
                                                class="badge badge-{{ $statusColors[$history->old_status] ?? 'secondary' }} badge-sm">
                                                {{ $statusLabels[$history->old_status] ?? $history->old_status }}
                                            </span>
                                            <span class="fe fe-arrow-left fe-12 mx-2 text-muted"></span>
                                            <span
                                                class="badge badge-{{ $statusColors[$history->new_status] ?? 'secondary' }} badge-sm">
                                                {{ $statusLabels[$history->new_status] ?? $history->new_status }}
                                            </span>
                                        </div>
                                        <div class="timeline-meta">
                                            @if ($history->changer)
                                                <span
                                                    class="fe fe-user fe-10 mr-1"></span>{{ $history->changer->name }}
                                            @else
                                                <span class="text-null">مجهول</span>
                                            @endif
                                            <span class="mx-2">•</span>
                                            <span
                                                class="fe fe-clock fe-10 mr-1"></span>{{ $history->created_at->diffForHumans() }}
                                        </div>
                                        @if ($history->note)
                                            <div class="timeline-note">{{ $history->note }}</div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="modal-empty-text">لا يوجد سجل حالات</div>
                    @endif
                </div>

                {{-- Supervisor Notes --}}
                <div class="modal-section">
                    <div class="modal-section-header">
                        <span class="fe fe-message-square fe-16 mr-2"></span>ملاحظات المشرفين
                        @if ($book->supervisorNotes->isNotEmpty())
                            <span class="badge badge-primary ml-2">{{ $book->supervisorNotes->count() }}</span>
                        @endif
                    </div>
                    @if ($book->supervisorNotes->isNotEmpty())
                        <div class="modal-relation-list">
                            @foreach ($book->supervisorNotes as $note)
                                <div class="modal-note-card">
                                    <div class="modal-note-header">
                                        <div class="modal-note-author">
                                            <span class="fe fe-user fe-12 mr-1"></span>
                                            {{ $note->supervisor?->name ?? 'غير محدد' }}
                                        </div>
                                        <div class="modal-note-date">
                                            <span
                                                class="fe fe-clock fe-10 mr-1"></span>{{ $note->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                    <div class="modal-note-body">{{ $note->note }}</div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="modal-empty-text">لا توجد ملاحظات من المشرفين</div>
                    @endif
                </div>

                {{-- Timestamps --}}
                <div class="modal-section modal-section-last">
                    <div class="modal-timestamps">
                        <span><span class="fe fe-plus-circle fe-10 mr-1"></span>تاريخ الإنشاء:
                            {{ $book->created_at?->format('Y-m-d H:i') ?? '—' }}</span>
                        <span><span class="fe fe-edit-3 fe-10 mr-1"></span>آخر تعديل:
                            {{ $book->updated_at?->format('Y-m-d H:i') ?? '—' }}</span>
                    </div>
                </div>

            </div>

            {{-- Footer --}}
            <div class="modal-footer">
                @if ($book->attachment_path)
                    <a href="{{ asset('storage/' . $book->attachment_path) }}" target="_blank"
                        class="btn btn-primary btn-sm">
                        تحميل المرفق
                    </a>
                @else
                    <button class="btn btn-secondary btn-sm" disabled>لا يوجد مرفق</button>
                @endif
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                    <span class="fe fe-x fe-14 mr-1"></span>إغلاق
                </button>
            </div>

        </div>
    </div>
</div>

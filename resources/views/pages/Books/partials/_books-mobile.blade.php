{{-- Mobile Card View --}}
<div class="d-lg-none">
    @forelse ($books as $book)
        <div class="card book-card-mobile fade-in">
            <div class="card-body">
                {{-- Title & Status --}}
                <div class="d-flex align-items-start justify-content-between mb-2">
                    <h6 class="mobile-title mb-0">{{ $book->title }}</h6>
                    <span class="badge badge-{{ $statusColors[$book->status] ?? 'info' }} status-badge">
                        {{ $statusLabels[$book->status] ?? $book->status }}
                    </span>
                </div>

                {{-- Details --}}
                <div class="mb-2">
                    @if ($book->book_no)
                        <div class="mobile-detail">
                            <span class="fe fe-hash fe-14"></span>
                            <span>رقم الكتاب: <strong>{{ $book->book_no }}</strong></span>
                        </div>
                    @endif
                    <div class="mobile-detail">
                        <span class="fe fe-send fe-14"></span>
                        <span>الجهة المرسلة: <strong>{{ $book->sender_entity }}</strong></span>
                    </div>
                    <div class="mobile-detail">
                        <span class="fe fe-calendar fe-14"></span>
                        <span>تاريخ الاستلام: <strong>{{ $book->received_date }}</strong></span>
                    </div>
                    @if ($book->department)
                        <div class="mobile-detail">
                            <span class="fe fe-briefcase fe-14"></span>
                            <span>القسم: <strong>{{ $book->department->deparment_name }}</strong></span>
                        </div>
                    @endif
                </div>

                {{-- Users --}}
                @if ($book->users->isNotEmpty())
                    <div class="mb-2">
                        <div class="mobile-section-label">المستخدمون</div>
                        @foreach ($book->users as $bookUser)
                            <span class="user-badge">
                                <span class="fe fe-user fe-10 mr-1"></span>{{ $bookUser->name }}
                            </span>
                        @endforeach
                    </div>
                @endif

                {{-- Tags --}}
                @if ($book->tags->isNotEmpty())
                    <div class="mb-2">
                        <div class="mobile-section-label">الوسوم</div>
                        @foreach ($book->tags as $tag)
                            <span class="tag-badge">
                                <span class="fe fe-tag fe-10 mr-1"></span>{{ $tag->tag_name }}
                            </span>
                        @endforeach
                    </div>
                @endif

                {{-- Actions --}}
                <div class="mobile-actions">
                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-outline-info">
                        <span class="fe fe-eye fe-14 mr-1"></span>عرض
                    </a>
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-outline-primary">
                        <span class="fe fe-edit fe-14 mr-1"></span>تعديل
                    </a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;"
                        onsubmit="return confirm('هل أنت متأكد من حذف هذا الكتاب؟');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <span class="fe fe-trash-2 fe-14 mr-1"></span>حذف
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="card books-card">
            <div class="card-body empty-state">
                <span class="fe fe-inbox empty-icon"></span>
                <p class="empty-title">لا توجد كتب حالياً</p>
                <p class="empty-text">قم بإضافة كتاب جديد للبدء</p>
                <a href="{{ route('books.create') }}" class="btn btn-primary btn-sm btn-add-book">
                    <span class="fe fe-plus fe-14 mr-1"></span>إضافة كتاب جديد
                </a>
            </div>
        </div>
    @endforelse
</div>

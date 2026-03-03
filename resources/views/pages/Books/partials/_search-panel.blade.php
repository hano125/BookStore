{{-- Unified Search Panel --}}
<div class="card mb-4 search-panel"
    style="border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; overflow: hidden;">
    <div class="card-body p-0">
        <form action="{{ route('books.search') }}" method="GET" id="search-form">

            {{-- Main Search Row --}}
            <div class="d-flex align-items-center p-3" style="gap: 0.75rem;">
                <div class="flex-fill position-relative">
                    <span class="fe fe-search fe-16"
                        style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #6c757d; z-index: 2;"></span>
                    <input type="text" class="form-control" name="search" id="quick-search"
                        value="{{ request('search') }}"
                        placeholder="بحث في الكتب... (العنوان، الرقم، الجهة المرسلة، الملاحظات)"
                        style="padding-left: 40px; height: 44px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.12); background: rgba(255,255,255,0.04); font-size: 0.95rem;">
                </div>
                <button type="button" class="btn btn-outline-light" id="toggle-filters"
                    style="height: 44px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.12); white-space: nowrap; padding: 0 16px;"
                    title="بحث متقدم">
                    <span class="fe fe-sliders fe-16 mr-1"></span>
                    <span class="d-none d-md-inline">فلاتر</span>
                    @if ($hasFilters)
                        <span class="badge badge-primary mr-1"
                            style="font-size: 0.7rem; padding: 2px 6px; border-radius: 50%; min-width: 18px;">
                            {{ $activeFilterCount }}
                        </span>
                    @endif
                </button>
                <button type="submit" class="btn btn-primary"
                    style="height: 44px; border-radius: 8px; padding: 0 20px; white-space: nowrap;">
                    <span class="fe fe-search fe-16 mr-1"></span>بحث
                </button>
                @if ($hasAnyFilter)
                    <a href="{{ route('books.index') }}" class="btn btn-outline-danger"
                        style="height: 44px; border-radius: 8px; padding: 0 12px; display: flex; align-items: center;"
                        title="مسح الكل">
                        <span class="fe fe-x fe-16"></span>
                    </a>
                @endif
            </div>

            {{-- Advanced Filters (Collapsible) --}}
            <div id="filters-panel"
                style="display: {{ $hasFilters ? 'block' : 'none' }}; border-top: 1px solid rgba(255,255,255,0.06);">
                <div class="p-3 pt-2">
                    <div class="row" style="row-gap: 0.75rem;">
                        {{-- الحالة --}}
                        <div class="col-6 col-md-4 col-lg-2">
                            <label class="small text-muted mb-1 d-block">
                                <span class="fe fe-flag fe-12 mr-1"></span>الحالة
                            </label>
                            <select class="form-control form-control-sm" name="status"
                                style="border-radius: 6px; border: 1px solid rgba(255,255,255,0.12); background: rgba(255,255,255,0.04);">
                                <option value="">الكل</option>
                                @foreach ($statusLabels as $value => $label)
                                    <option value="{{ $value }}"
                                        {{ request('status') == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- الوسم --}}
                        <div class="col-6 col-md-4 col-lg-2">
                            <label class="small text-muted mb-1 d-block">
                                <span class="fe fe-tag fe-12 mr-1"></span>الوسم
                            </label>
                            <select class="form-control form-control-sm" name="tag_id"
                                style="border-radius: 6px; border: 1px solid rgba(255,255,255,0.12); background: rgba(255,255,255,0.04);">
                                <option value="">الكل</option>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}"
                                        {{ request('tag_id') == $tag->id ? 'selected' : '' }}>
                                        {{ $tag->tag_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- المستخدم --}}
                        <div class="col-6 col-md-4 col-lg-2">
                            <label class="small text-muted mb-1 d-block">
                                <span class="fe fe-user fe-12 mr-1"></span>المستخدم
                            </label>
                            <select class="form-control form-control-sm" name="user_id"
                                style="border-radius: 6px; border: 1px solid rgba(255,255,255,0.12); background: rgba(255,255,255,0.04);">
                                <option value="">الكل</option>
                                @foreach ($users as $u)
                                    <option value="{{ $u->id }}"
                                        {{ request('user_id') == $u->id ? 'selected' : '' }}>
                                        {{ $u->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- تاريخ من --}}
                        <div class="col-6 col-md-4 col-lg-2">
                            <label class="small text-muted mb-1 d-block">
                                <span class="fe fe-calendar fe-12 mr-1"></span>من تاريخ
                            </label>
                            <input type="date" class="form-control form-control-sm" name="date_from"
                                value="{{ request('date_from') }}"
                                style="border-radius: 6px; border: 1px solid rgba(255,255,255,0.12); background: rgba(255,255,255,0.04);">
                        </div>

                        {{-- تاريخ إلى --}}
                        <div class="col-6 col-md-4 col-lg-2">
                            <label class="small text-muted mb-1 d-block">
                                <span class="fe fe-calendar fe-12 mr-1"></span>إلى تاريخ
                            </label>
                            <input type="date" class="form-control form-control-sm" name="date_to"
                                value="{{ request('date_to') }}"
                                style="border-radius: 6px; border: 1px solid rgba(255,255,255,0.12); background: rgba(255,255,255,0.04);">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Active Filters Tags --}}
            @if ($hasAnyFilter)
                <div class="px-3 pb-3 d-flex flex-wrap align-items-center"
                    style="gap: 0.4rem; border-top: 1px solid rgba(255,255,255,0.06); padding-top: 0.75rem;">
                    <small class="text-muted"><span class="fe fe-filter fe-12 mr-1"></span>نتائج مفلترة:</small>

                    @if (request('search'))
                        <span class="badge"
                            style="background: rgba(0,123,255,0.15); color: #6cb2f7; padding: 5px 10px; border-radius: 20px; font-size: 0.78rem;">
                            <span class="fe fe-search fe-10 mr-1"></span>{{ request('search') }}
                        </span>
                    @endif

                    @if (request('status'))
                        <span class="badge"
                            style="background: rgba(255,193,7,0.15); color: #ffc107; padding: 5px 10px; border-radius: 20px; font-size: 0.78rem;">
                            {{ $statusLabels[request('status')] ?? request('status') }}
                        </span>
                    @endif

                    @if (request('deparment_id'))
                        <span class="badge"
                            style="background: rgba(40,167,69,0.15); color: #5dd98a; padding: 5px 10px; border-radius: 20px; font-size: 0.78rem;">
                            <span
                                class="fe fe-briefcase fe-10 mr-1"></span>{{ $departments->find(request('deparment_id'))?->deparment_name }}
                        </span>
                    @endif

                    @if (request('tag_id'))
                        <span class="badge"
                            style="background: rgba(111,66,193,0.15); color: #b38cff; padding: 5px 10px; border-radius: 20px; font-size: 0.78rem;">
                            <span class="fe fe-tag fe-10 mr-1"></span>{{ $tags->find(request('tag_id'))?->tag_name }}
                        </span>
                    @endif

                    @if (request('user_id'))
                        <span class="badge"
                            style="background: rgba(23,162,184,0.15); color: #63d5e5; padding: 5px 10px; border-radius: 20px; font-size: 0.78rem;">
                            <span class="fe fe-user fe-10 mr-1"></span>{{ $users->find(request('user_id'))?->name }}
                        </span>
                    @endif

                    @if (request('date_from'))
                        <span class="badge"
                            style="background: rgba(253,126,20,0.15); color: #fd7e14; padding: 5px 10px; border-radius: 20px; font-size: 0.78rem;">
                            من: {{ request('date_from') }}
                        </span>
                    @endif

                    @if (request('date_to'))
                        <span class="badge"
                            style="background: rgba(253,126,20,0.15); color: #fd7e14; padding: 5px 10px; border-radius: 20px; font-size: 0.78rem;">
                            إلى: {{ request('date_to') }}
                        </span>
                    @endif
                </div>
            @endif

        </form>
    </div>
</div>

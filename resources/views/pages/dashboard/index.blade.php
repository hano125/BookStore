@extends("layouts.master")

@section('title', 'لوحة التحكم')

@section('content')

<div class="container-fluid" dir="rtl">

    {{-- Page Header --}}
    <div class="row justify-content-between align-items-center mb-4 mt-3">
        <div class="col-auto">
            <h2 class="h3 mb-0 page-title" style="color:#e0e0e0; font-weight:700;">لوحة التحكم</h2>
            <p class="text-muted mb-0" style="font-size:.85rem;">مرحباً بك، المستخدم</p>
        </div>
        <div class="col-auto">
            <span class="text-muted" style="font-size:.82rem;">
                <i class="fe fe-calendar fe-14 mr-1"></i>
                الإثنين، 03 مارس 2026
            </span>
        </div>
    </div>

    {{-- ===== Stats Cards ===== --}}
    <div class="row mb-4">

        {{-- Total Books --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow border-0 h-100"
                style="background:linear-gradient(135deg,#1e40af,#2563eb);border-radius:14px;">
                <div class="card-body d-flex align-items-center justify-content-between py-4 px-4">
                    <div>
                        <p class="mb-1"
                            style="color:rgba(255,255,255,.75);font-size:.8rem;font-weight:600;letter-spacing:.05rem;">
                            إجمالي الكتب
                        </p>
                        <h3 class="mb-0 font-weight-bold" style="color:#fff;font-size:2rem;">120</h3>
                        <small style="color:rgba(255,255,255,.6);">في المكتبة</small>
                    </div>
                    <div style="background:rgba(255,255,255,.15);border-radius:50%;width:56px;height:56px;
                                display:flex;align-items:center;justify-content:center;">
                        <i class="fe fe-book-open" style="color:#fff;font-size:1.5rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Categories --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow border-0 h-100"
                style="background:linear-gradient(135deg,#065f46,#059669);border-radius:14px;">
                <div class="card-body d-flex align-items-center justify-content-between py-4 px-4">
                    <div>
                        <p class="mb-1"
                            style="color:rgba(255,255,255,.75);font-size:.8rem;font-weight:600;letter-spacing:.05rem;">
                            التصنيفات
                        </p>
                        <h3 class="mb-0 font-weight-bold" style="color:#fff;font-size:2rem;">8</h3>
                        <small style="color:rgba(255,255,255,.6);">تصنيف نشط</small>
                    </div>
                    <div style="background:rgba(255,255,255,.15);border-radius:50%;width:56px;height:56px;
                                display:flex;align-items:center;justify-content:center;">
                        <i class="fe fe-tag" style="color:#fff;font-size:1.5rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Users --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow border-0 h-100"
                style="background:linear-gradient(135deg,#7c2d12,#ea580c);border-radius:14px;">
                <div class="card-body d-flex align-items-center justify-content-between py-4 px-4">
                    <div>
                        <p class="mb-1"
                            style="color:rgba(255,255,255,.75);font-size:.8rem;font-weight:600;letter-spacing:.05rem;">
                            المستخدمون
                        </p>
                        <h3 class="mb-0 font-weight-bold" style="color:#fff;font-size:2rem;">43</h3>
                        <small style="color:rgba(255,255,255,.6);">مستخدم مسجل</small>
                    </div>
                    <div style="background:rgba(255,255,255,.15);border-radius:50%;width:56px;height:56px;
                                display:flex;align-items:center;justify-content:center;">
                        <i class="fe fe-users" style="color:#fff;font-size:1.5rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Books Added This Month --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow border-0 h-100"
                style="background:linear-gradient(135deg,#581c87,#9333ea);border-radius:14px;">
                <div class="card-body d-flex align-items-center justify-content-between py-4 px-4">
                    <div>
                        <p class="mb-1"
                            style="color:rgba(255,255,255,.75);font-size:.8rem;font-weight:600;letter-spacing:.05rem;">
                            إضافات هذا الشهر
                        </p>
                        <h3 class="mb-0 font-weight-bold" style="color:#fff;font-size:2rem;">12</h3>
                        <small style="color:rgba(255,255,255,.6);">كتاب جديد</small>
                    </div>
                    <div style="background:rgba(255,255,255,.15);border-radius:50%;width:56px;height:56px;
                                display:flex;align-items:center;justify-content:center;">
                        <i class="fe fe-trending-up" style="color:#fff;font-size:1.5rem;"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>{{-- /Stats Cards --}}

    {{-- ===== Chart + Recent Books ===== --}}
    <div class="row mb-4">

        {{-- Bar Chart: Books per Category --}}
        <div class="col-xl-7 mb-4">
            <div class="card shadow border-0 h-100"
                style="background:#1e2235;border-radius:14px;border:1px solid rgba(255,255,255,.06);">
                <div class="card-header d-flex align-items-center justify-content-between"
                    style="background:transparent;border-bottom:1px solid rgba(255,255,255,.07);padding:1rem 1.5rem;">
                    <h6 class="mb-0" style="color:#e0e0e0;font-weight:600;">
                        <i class="fe fe-bar-chart-2 fe-16 mr-2" style="color:#2563eb;"></i>
                        الكتب حسب التصنيف
                    </h6>
                </div>
                <div class="card-body" style="padding:1.25rem 1.5rem;">
                    <canvas id="booksChart" height="250"></canvas>
                </div>
            </div>
        </div>

        {{-- Category Doughnut --}}
        <div class="col-xl-5 mb-4">
            <div class="card shadow border-0 h-100"
                style="background:#1e2235;border-radius:14px;border:1px solid rgba(255,255,255,.06);">
                <div class="card-header d-flex align-items-center justify-content-between"
                    style="background:transparent;border-bottom:1px solid rgba(255,255,255,.07);padding:1rem 1.5rem;">
                    <h6 class="mb-0" style="color:#e0e0e0;font-weight:600;">
                        <i class="fe fe-pie-chart fe-16 mr-2" style="color:#9333ea;"></i>
                        توزيع التصنيفات
                    </h6>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center" style="padding:1.25rem;">
                    <canvas id="categoryChart" height="250"></canvas>
                </div>
            </div>
        </div>

    </div>{{-- /Charts --}}

    {{-- ===== Latest Books Table ===== --}}
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow border-0"
                style="background:#1e2235;border-radius:14px;border:1px solid rgba(255,255,255,.06);">
                <div class="card-header d-flex align-items-center justify-content-between"
                    style="background:transparent;border-bottom:1px solid rgba(255,255,255,.07);padding:1rem 1.5rem;">
                    <h6 class="mb-0" style="color:#e0e0e0;font-weight:600;">
                        <i class="fe fe-list fe-16 mr-2" style="color:#059669;"></i>
                        آخر الكتب المضافة
                    </h6>
                    {{-- @can('books.view')
                    <a href="{{ route('books.index') }}" class="btn btn-sm btn-outline-primary"
                        style="font-size:.78rem;border-radius:8px;">
                        عرض الكل
                    </a>
                    @endcan --}}
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="color:#c9d1d9;">
                            <thead style="background:rgba(255,255,255,.04);">
                                <tr style="border-bottom:1px solid rgba(255,255,255,.07);">
                                    <th
                                        style="padding:.9rem 1.5rem;font-size:.78rem;color:#8b949e;font-weight:600;border:none;">
                                        #</th>
                                    <th
                                        style="padding:.9rem 1rem;font-size:.78rem;color:#8b949e;font-weight:600;border:none;">
                                        عنوان الكتاب</th>
                                    <th
                                        style="padding:.9rem 1rem;font-size:.78rem;color:#8b949e;font-weight:600;border:none;">
                                        التصنيف</th>
                                    <th
                                        style="padding:.9rem 1rem;font-size:.78rem;color:#8b949e;font-weight:600;border:none;">
                                        المؤلف</th>
                                    <th
                                        style="padding:.9rem 1rem;font-size:.78rem;color:#8b949e;font-weight:600;border:none;">
                                        تاريخ الإضافة</th>
                                    <th
                                        style="padding:.9rem 1rem;font-size:.78rem;color:#8b949e;font-weight:600;border:none;">
                                        الحالة</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="border-bottom:1px solid rgba(255,255,255,.04);transition:background .15s;">
                                    <td style="padding:.85rem 1.5rem;border:none;color:#8b949e;font-size:.83rem;">1</td>
                                    <td style="padding:.85rem 1rem;border:none;font-weight:500;font-size:.88rem;">مئة
                                        عام من العزلة</td>
                                    <td style="padding:.85rem 1rem;border:none;">
                                        <span
                                            style="background:rgba(37,99,235,.18);color:#60a5fa;padding:2px 10px;border-radius:20px;font-size:.78rem;">روايات</span>
                                    </td>
                                    <td style="padding:.85rem 1rem;border:none;font-size:.85rem;color:#9ca3af;">غابرييل
                                        غارسيا ماركيز</td>
                                    <td style="padding:.85rem 1rem;border:none;font-size:.82rem;color:#6b7280;">
                                        01/03/2026</td>
                                    <td style="padding:.85rem 1rem;border:none;">
                                        <span
                                            style="background:rgba(5,150,105,.18);color:#34d399;padding:2px 10px;border-radius:20px;font-size:.78rem;">نشط</span>
                                    </td>
                                </tr>
                                <tr style="border-bottom:1px solid rgba(255,255,255,.04);transition:background .15s;">
                                    <td style="padding:.85rem 1.5rem;border:none;color:#8b949e;font-size:.83rem;">2</td>
                                    <td style="padding:.85rem 1rem;border:none;font-weight:500;font-size:.88rem;">الأمير
                                        الصغير</td>
                                    <td style="padding:.85rem 1rem;border:none;">
                                        <span
                                            style="background:rgba(37,99,235,.18);color:#60a5fa;padding:2px 10px;border-radius:20px;font-size:.78rem;">أدب
                                            عالمي</span>
                                    </td>
                                    <td style="padding:.85rem 1rem;border:none;font-size:.85rem;color:#9ca3af;">أنطوان
                                        دو سانت إكزوبيري</td>
                                    <td style="padding:.85rem 1rem;border:none;font-size:.82rem;color:#6b7280;">
                                        28/02/2026</td>
                                    <td style="padding:.85rem 1rem;border:none;">
                                        <span
                                            style="background:rgba(5,150,105,.18);color:#34d399;padding:2px 10px;border-radius:20px;font-size:.78rem;">نشط</span>
                                    </td>
                                </tr>
                                <tr style="border-bottom:1px solid rgba(255,255,255,.04);transition:background .15s;">
                                    <td style="padding:.85rem 1.5rem;border:none;color:#8b949e;font-size:.83rem;">3</td>
                                    <td style="padding:.85rem 1rem;border:none;font-weight:500;font-size:.88rem;">في قلب
                                        الكود</td>
                                    <td style="padding:.85rem 1rem;border:none;">
                                        <span
                                            style="background:rgba(37,99,235,.18);color:#60a5fa;padding:2px 10px;border-radius:20px;font-size:.78rem;">تقنية</span>
                                    </td>
                                    <td style="padding:.85rem 1rem;border:none;font-size:.85rem;color:#9ca3af;">أحمد
                                        الشمري</td>
                                    <td style="padding:.85rem 1rem;border:none;font-size:.82rem;color:#6b7280;">
                                        25/02/2026</td>
                                    <td style="padding:.85rem 1rem;border:none;">
                                        <span
                                            style="background:rgba(5,150,105,.18);color:#34d399;padding:2px 10px;border-radius:20px;font-size:.78rem;">نشط</span>
                                    </td>
                                </tr>
                                <tr style="border-bottom:1px solid rgba(255,255,255,.04);transition:background .15s;">
                                    <td style="padding:.85rem 1.5rem;border:none;color:#8b949e;font-size:.83rem;">4</td>
                                    <td style="padding:.85rem 1rem;border:none;font-weight:500;font-size:.88rem;">علم
                                        النفس للجميع</td>
                                    <td style="padding:.85rem 1rem;border:none;">
                                        <span
                                            style="background:rgba(37,99,235,.18);color:#60a5fa;padding:2px 10px;border-radius:20px;font-size:.78rem;">علم
                                            النفس</span>
                                    </td>
                                    <td style="padding:.85rem 1rem;border:none;font-size:.85rem;color:#9ca3af;">سارة
                                        الحربي</td>
                                    <td style="padding:.85rem 1rem;border:none;font-size:.82rem;color:#6b7280;">
                                        20/02/2026</td>
                                    <td style="padding:.85rem 1rem;border:none;">
                                        <span
                                            style="background:rgba(5,150,105,.18);color:#34d399;padding:2px 10px;border-radius:20px;font-size:.78rem;">نشط</span>
                                    </td>
                                </tr>
                                <tr style="border-bottom:1px solid rgba(255,255,255,.04);transition:background .15s;">
                                    <td style="padding:.85rem 1.5rem;border:none;color:#8b949e;font-size:.83rem;">5</td>
                                    <td style="padding:.85rem 1rem;border:none;font-weight:500;font-size:.88rem;">تاريخ
                                        العالم القديم</td>
                                    <td style="padding:.85rem 1rem;border:none;">
                                        <span
                                            style="background:rgba(37,99,235,.18);color:#60a5fa;padding:2px 10px;border-radius:20px;font-size:.78rem;">تاريخ</span>
                                    </td>
                                    <td style="padding:.85rem 1rem;border:none;font-size:.85rem;color:#9ca3af;">محمد
                                        العمري</td>
                                    <td style="padding:.85rem 1rem;border:none;font-size:.82rem;color:#6b7280;">
                                        15/02/2026</td>
                                    <td style="padding:.85rem 1rem;border:none;">
                                        <span
                                            style="background:rgba(5,150,105,.18);color:#34d399;padding:2px 10px;border-radius:20px;font-size:.78rem;">نشط</span>
                                    </td>
                                </tr>
                                <tr style="border-bottom:1px solid rgba(255,255,255,.04);transition:background .15s;">
                                    <td style="padding:.85rem 1.5rem;border:none;color:#8b949e;font-size:.83rem;">6</td>
                                    <td style="padding:.85rem 1rem;border:none;font-weight:500;font-size:.88rem;">فن
                                        الحرب</td>
                                    <td style="padding:.85rem 1rem;border:none;">
                                        <span
                                            style="background:rgba(37,99,235,.18);color:#60a5fa;padding:2px 10px;border-radius:20px;font-size:.78rem;">إدارة</span>
                                    </td>
                                    <td style="padding:.85rem 1rem;border:none;font-size:.85rem;color:#9ca3af;">سون تزو
                                    </td>
                                    <td style="padding:.85rem 1rem;border:none;font-size:.82rem;color:#6b7280;">
                                        10/02/2026</td>
                                    <td style="padding:.85rem 1rem;border:none;">
                                        <span
                                            style="background:rgba(5,150,105,.18);color:#34d399;padding:2px 10px;border-radius:20px;font-size:.78rem;">نشط</span>
                                    </td>
                                </tr>
                                <tr style="border-bottom:1px solid rgba(255,255,255,.04);transition:background .15s;">
                                    <td style="padding:.85rem 1.5rem;border:none;color:#8b949e;font-size:.83rem;">7</td>
                                    <td style="padding:.85rem 1rem;border:none;font-weight:500;font-size:.88rem;">
                                        رياضيات الحياة اليومية</td>
                                    <td style="padding:.85rem 1rem;border:none;">
                                        <span
                                            style="background:rgba(37,99,235,.18);color:#60a5fa;padding:2px 10px;border-radius:20px;font-size:.78rem;">علوم</span>
                                    </td>
                                    <td style="padding:.85rem 1rem;border:none;font-size:.85rem;color:#9ca3af;">نورة
                                        البلوي</td>
                                    <td style="padding:.85rem 1rem;border:none;font-size:.82rem;color:#6b7280;">
                                        05/02/2026</td>
                                    <td style="padding:.85rem 1rem;border:none;">
                                        <span
                                            style="background:rgba(5,150,105,.18);color:#34d399;padding:2px 10px;border-radius:20px;font-size:.78rem;">نشط</span>
                                    </td>
                                </tr>
                                <tr style="border-bottom:1px solid rgba(255,255,255,.04);transition:background .15s;">
                                    <td style="padding:.85rem 1.5rem;border:none;color:#8b949e;font-size:.83rem;">8</td>
                                    <td style="padding:.85rem 1rem;border:none;font-weight:500;font-size:.88rem;">الذكاء
                                        الاصطناعي للمبتدئين</td>
                                    <td style="padding:.85rem 1rem;border:none;">
                                        <span
                                            style="background:rgba(37,99,235,.18);color:#60a5fa;padding:2px 10px;border-radius:20px;font-size:.78rem;">تقنية</span>
                                    </td>
                                    <td style="padding:.85rem 1rem;border:none;font-size:.85rem;color:#9ca3af;">عمر
                                        الغامدي</td>
                                    <td style="padding:.85rem 1rem;border:none;font-size:.82rem;color:#6b7280;">
                                        01/02/2026</td>
                                    <td style="padding:.85rem 1rem;border:none;">
                                        <span
                                            style="background:rgba(5,150,105,.18);color:#34d399;padding:2px 10px;border-radius:20px;font-size:.78rem;">نشط</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>{{-- /Latest Books --}}

</div>{{-- /container-fluid --}}

@endsection
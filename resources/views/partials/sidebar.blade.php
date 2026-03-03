<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar dir="rtl">
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted mr-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- Brand -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ route('dashboard') }}">
                <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120"
                    xml:space="preserve">
                    <g>
                        <polygon class="st0" points="78,105 15,105 24,87 87,87" />
                        <polygon class="st0" points="96,69 33,69 42,51 105,51" />
                        <polygon class="st0" points="78,33 15,33 24,15 87,15" />
                    </g>
                </svg>
            </a>
        </div>

        <!-- القائمة الرئيسية -->
        <p class="text-muted nav-heading mt-0 mb-1">
            <span>الرئيسية</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard') }}">
                    <i class="fe fe-home fe-16"></i>
                    <span class="mr-3 item-text">لوحة التحكم</span>
                </a>
            </li>
        </ul>

        <!-- إدارة الكتب -->
        @canany(['books.view', 'books.create'])
            <p class="text-muted nav-heading mt-4 mb-1">
                <span>إدارة الكتب</span>
            </p>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                @can('books.view')
                    <li class="nav-item w-100">
                        <a class="nav-link {{ request()->routeIs('books.index') ? 'active' : '' }}"
                            href="{{ route('books.index') }}">
                            <i class="fe fe-list fe-16"></i>
                            <span class="mr-3 item-text">عرض الكتب</span>
                        </a>
                    </li>
                @endcan
                @can('books.create')
                    <li class="nav-item w-100">
                        <a class="nav-link {{ request()->routeIs('books.create') ? 'active' : '' }}"
                            href="{{ route('books.create') }}">
                            <i class="fe fe-plus-circle fe-16"></i>
                            <span class="mr-3 item-text">إنشاء كتاب</span>
                        </a>
                    </li>
                @endcan
                @can('books.view')
                    <li class="nav-item w-100">
                        <a class="nav-link {{ request()->routeIs('archive.*') ? 'active' : '' }}" href="#">
                            <i class="fe fe-archive fe-16"></i>
                            <span class="mr-3 item-text">الأرشيف</span>
                        </a>
                    </li>
                @endcan
            </ul>
        @endcanany

        <!-- إدارة النظام -->
        @canany(['departments.view', 'users.view', 'roles.view', 'tags.view'])
            <p class="text-muted nav-heading mt-4 mb-1">
                <span>إدارة النظام</span>
            </p>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                @can('departments.view')
                    <li class="nav-item w-100">
                        <a class="nav-link {{ request()->routeIs('departments.*') ? 'active' : '' }}" href="#">
                            <i class="fe fe-briefcase fe-16"></i>
                            <span class="mr-3 item-text">الأقسام</span>
                        </a>
                    </li>
                @endcan
                @can('users.view')
                    <li class="nav-item w-100">
                        <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}"
                            href="{{ route('users.index') }}">
                            <i class="fe fe-users fe-16"></i>
                            <span class="mr-3 item-text">المستخدمون</span>
                        </a>
                    </li>
                @endcan
                @can('roles.view')
                    <li class="nav-item w-100">
                        <a class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}"
                            href="{{ route('roles.index') }}">
                            <i class="fe fe-shield fe-16"></i>
                            <span class="mr-3 item-text">الأدوار والصلاحيات</span>
                        </a>
                    </li>
                @endcan
                @can('tags.view')
                    <li class="nav-item w-100">
                        <a class="nav-link {{ request()->routeIs('tags.*') ? 'active' : '' }}" href="#">
                            <i class="fe fe-tag fe-16"></i>
                            <span class="mr-3 item-text">الوسوم</span>
                        </a>
                    </li>
                @endcan
            </ul>
        @endcanany

        <!-- التقارير والإحصائيات -->
        @can('reports.view')
            <p class="text-muted nav-heading mt-4 mb-1">
                <span>التقارير</span>
            </p>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}" href="#">
                        <i class="fe fe-bar-chart-2 fe-16"></i>
                        <span class="mr-3 item-text">الإحصائيات</span>
                    </a>
                </li>
            </ul>
        @endcan

        <!-- الإعدادات -->
        <p class="text-muted nav-heading mt-4 mb-1">
            <span>الحساب</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}"
                    href="{{ route('profile.show') }}">
                    <i class="fe fe-user fe-16"></i>
                    <span class="mr-3 item-text">الملف الشخصي</span>
                </a>
            </li>
            @can('roles.view')
                <li class="nav-item w-100">
                    <a class="nav-link" href="{{ route('roles.index') }}">
                        <i class="fe fe-shield fe-16"></i>
                        <span class="mr-3 item-text">الصلاحيات</span>
                    </a>
                </li>
            @endcan
        </ul>
    </nav>
</aside>

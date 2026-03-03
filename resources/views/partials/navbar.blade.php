 <nav class="topnav navbar navbar-light" style="border-bottom: 1px solid rgba(255,255,255,0.06);">
     <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
         <i class="fe fe-menu navbar-toggler-icon"></i>
     </button>

     {{-- Page Title --}}
     <div class="d-none d-md-flex align-items-center mr-auto">
         <h6 class="mb-0 text-muted" style="font-size: 0.9rem; font-weight: 400;">
             @yield('title', 'لوحة التحكم')
         </h6>
     </div>

     <ul class="nav align-items-center">
         {{-- Notifications --}}
         <li class="nav-item nav-notif">
             <a class="nav-link text-muted my-2 position-relative" href="#" data-toggle="modal"
                 data-target=".modal-notif" style="padding: 8px 10px;">
                 <span class="fe fe-bell fe-18"></span>
                 <span class="dot dot-md bg-success"
                     style="position: absolute; top: 6px; right: 6px; width: 8px; height: 8px; border-radius: 50%;"></span>
             </a>
         </li>

         {{-- User Dropdown --}}
         <li class="nav-item dropdown" style="margin-right: 8px;">
             <a class="nav-link dropdown-toggle text-muted p-0 d-flex align-items-center" href="#"
                 id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true"
                 aria-expanded="false" style="gap: 10px;">
                 <div class="d-none d-md-block text-left" style="line-height: 1.3;">
                     <span class="d-block"
                         style="font-size: 0.85rem; font-weight: 500; color: #e0e0e0;">{{ Auth::user()->name ?? 'المستخدم' }}</span>
                     <small class="text-muted" style="font-size: 0.72rem;">
                         @if (Auth::user()?->department)
                             {{ Auth::user()->department->deparment_name }}
                         @else
                             مدير النظام
                         @endif
                     </small>
                 </div>
                 <span class="avatar avatar-sm"
                     style="width: 36px; height: 36px; border: 2px solid rgba(0,123,255,0.3); border-radius: 50%; overflow: hidden;">
                     <img src="{{ asset('Assets') }}/assets/avatars/face-1.jpg" alt="..."
                         class="avatar-img rounded-circle" style="width: 100%; height: 100%; object-fit: cover;">
                 </span>
             </a>
             <div class="dropdown-menu dropdown-menu-right shadow-lg" aria-labelledby="navbarDropdownMenuLink"
                 style="min-width: 200px; border: 1px solid rgba(255,255,255,0.08); border-radius: 10px; overflow: hidden; margin-top: 10px;">
                 <div class="px-3 py-2 d-md-none" style="border-bottom: 1px solid rgba(255,255,255,0.06);">
                     <strong style="font-size: 0.85rem; color: #e0e0e0;">{{ Auth::user()->name ?? 'المستخدم' }}</strong>
                 </div>
                 <a class="dropdown-item py-2" href="{{ route('profile.show') }}" style="font-size: 0.85rem;">
                     <span class="fe fe-user fe-16 ml-2 text-muted"></span>الملف الشخصي
                 </a>
                 {{-- <a class="dropdown-item py-2" href="#" style="font-size: 0.85rem;">
                     <span class="fe fe-settings fe-16 ml-2 text-muted"></span>الإعدادات
                 </a> --}}
                 <div class="dropdown-divider" style="border-color: rgba(255,255,255,0.06);"></div>
                 <form method="POST" action="{{ route('logout') }}">
                     @csrf
                     <button type="submit" class="dropdown-item py-2" style="font-size: 0.85rem; color: #e57373;">
                         <span class="fe fe-log-out fe-16 ml-2"></span>تسجيل الخروج
                     </button>
                 </form>
             </div>
         </li>
     </ul>
 </nav>

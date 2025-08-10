 <nav>
     <div class="app-logo">
         <a class="logo d-inline-block" href="{{ route('admin.dashboard') }}">
             {{-- <img alt="#" src="{{asset('backend')}}/assets/images/logo/1.png"> --}}
             <h3>Flyori Travels</h3>
         </a>

         <span class="bg-light-primary toggle-semi-nav d-flex-center">
             X
         </span>

         <div class="d-flex align-items-center nav-profile p-3">
             <span class="h-45 w-45 d-flex-center b-r-10 position-relative bg-danger m-auto">
                 <img alt="avatar" class="img-fluid b-r-10" src="{{ asset('backend') }}/assets/images/avatar/woman.jpg">
                 <span class="position-absolute top-0 end-0 p-1 bg-success border border-light rounded-circle"></span>
             </span>
             <div class="flex-grow-1 ps-2">
                 <h6 class="text-primary mb-0"> {{ ucwords(Auth::user()->name) }}</h6>
                 <p class="text-muted f-s-12 mb-0">Web Developer</p>
             </div>

         </div>
     </div>
     <div class="app-nav" id="app-simple-bar">
         <ul class="main-nav p-0 mt-2">
             <li class="no-sub">
                 <a href="{{ route('admin.dashboard') }}">
                     <svg stroke="currentColor" stroke-width="1.5">
                         <use
                             xlink:href="https://phpstack-1384472-5121645.cloudwaysapps.com/template/html/ki-admin/assets/svg/_sprite.svg#squares">
                         </use>
                     </svg>
                     Dashboard
                 </a>
             </li>
             <li>
                 <a aria-expanded="false" data-bs-toggle="collapse" href="#dashboard">
                     <svg stroke="currentColor" stroke-width="1.5">
                         <use
                             xlink:href="https://phpstack-1384472-5121645.cloudwaysapps.com/template/html/ki-admin/assets/svg/_sprite.svg#home">
                         </use>
                     </svg>
                     Leads

                 </a>
                 <ul class="collapse" id="dashboard">
                     <li><a href="widget.html">Leads</a></li>
                 </ul>
             </li>
             <li class="no-sub">
                 <a href="{{ route('jobRole.index') }}">
                     <svg stroke="currentColor" stroke-width="1.5">
                         <use
                             xlink:href="https://phpstack-1384472-5121645.cloudwaysapps.com/template/html/ki-admin/assets/svg/_sprite.svg#squares">
                         </use>
                     </svg>
                     Job Roles
                 </a>
             </li>
             <li class="no-sub">
                 <a href="widget.html">
                     <svg stroke="currentColor" stroke-width="1.5">
                         <use
                             xlink:href="https://phpstack-1384472-5121645.cloudwaysapps.com/template/html/ki-admin/assets/svg/_sprite.svg#squares">
                         </use>
                     </svg>
                     Blank Page
                 </a>
             </li>
         </ul>
     </div>

     <div class="menu-navs">
         <span class="menu-previous"><i class="ti ti-chevron-left"></i></span>
         <span class="menu-next"><i class="ti ti-chevron-right"></i></span>
     </div>

 </nav>

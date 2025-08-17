 <nav>
     <div class="app-logo">
         <a class="logo d-inline-block" href="{{ route('admin.dashboard') }}">
             {{-- <img alt="#" src="{{asset('backend')}}/assets/images/logo/1.png"> --}}
             <h3></h3>
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
                 <a href="{{ route('admin.dashboard') }}">Dashboard</a>
             </li>
             <li>
                 <a data-bs-toggle="collapse" href="#dashboard">Leads</a>
                 <ul class="collapse" id="dashboard">
                     <li><a href="{{ route('lead.index') }}">Leads</a></li>

                     <li><a href="{{ route('lead-assign.index') }}">Lead Assign</a></li>

                 </ul>
             </li>
             <li class="no-sub">
                 <a href="{{ route('education.index') }}">Education Qualification</a>
             </li>
             <li class="no-sub">
                 <a href="{{ route('jobRole.index') }}">Job Roles</a>
             </li>
             <li class="no-sub">
                 <a href="{{ route('designation.index') }}">Designation</a>
             </li>
             <li class="no-sub">
                 <a href="{{ route('employee.index') }}">Employee</a>
             </li>
             <li class="no-sub">
                 <a href="{{ route('department.index') }}">Department</a>
             </li>
             <li>
                 <a data-bs-toggle="collapse" href="#administation">Role & Permission</a>
                 <ul class="collapse" id="administation">

                     <li><a href="{{ route('user.index') }}">Admins</a></li>

                     <li><a href="{{ route('user.roles') }}">Admin Roles</a></li>

                 </ul>
             </li>
         </ul>
     </div>

     <div class="menu-navs">
         <span class="menu-previous"><i class="ti ti-chevron-left"></i></span>
         <span class="menu-next"><i class="ti ti-chevron-right"></i></span>
     </div>

 </nav>

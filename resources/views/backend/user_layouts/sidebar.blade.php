 <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">


     <div class="app-brand demo ">
         <a href="{{ url('/') }}" class="app-brand-link">

             <span class="app-brand-text demo menu-text fw-bold">
                 <img class="d-flex mr-3" src="{{ asset('logo.jpg') }}" alt="Generic user image {{ asset('logo.jpg') }}"
                     style="height: 75px;width:150px;">
             </span></a>

         <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
             <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
             <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
         </a>
     </div>

     <div class="menu-inner-shadow"></div>



     <ul class="menu-inner py-1">
         <!-- Dashboards -->
         <li class="menu-item active">
             <a href="{{ route('user.dashboard') }}" class="menu-link">
                 <i class="menu-icon tf-icons ti ti-smart-home"></i>
                 <div data-i18n="Dashboards">Dashboards</div>
                 {{-- <div class="badge bg-danger rounded-pill ms-auto">5</div> --}}
             </a>

         </li>
         <li class="menu-item">
             <a href="{{ route('user.appointment') }}" class="menu-link">
                 <i class="menu-icon tf-icons ti ti-mail"></i>
                 <div data-i18n="Appointment">Appointment</div>
             </a>
         </li>
         <li class="menu-item">
             <a href="{{ route('admin.account.law_category') }}" class="menu-link">
                 <div data-i18n="Law Category">Law Category</div>
             </a>
         </li>


     </ul>



 </aside>

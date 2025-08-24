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
             <a href="{{ route('dashboard') }}" class="menu-link">
                 <i class="menu-icon tf-icons ti ti-smart-home"></i>
                 <div data-i18n="Dashboards">Dashboards</div>
                 {{-- <div class="badge bg-danger rounded-pill ms-auto">5</div> --}}
             </a>

         </li>


         <!-- Layouts -->
         <li class="menu-item">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
                 <div data-i18n="Layouts">Layouts</div>
             </a>

             <ul class="menu-sub">
                 <li class="menu-item">
                     <a href="{{ route('admin.account.law_category') }}" class="menu-link">
                         <div data-i18n="Law Category">Law Category</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="{{ route('admin.account.legal_area') }}" class="menu-link">
                         <div data-i18n="Legal Area">Legal Area</div>
                     </a>
                 </li>

                 {{-- <li class="menu-item">
                     <a href="{{ route('admin.account.sub_legal_area') }}" class="menu-link">
                         <div data-i18n="Sub Legal Area">Sub Legal Area</div>
                     </a>
                 </li> --}}
                 <li class="menu-item">
                     <a href="{{ route('admin.account.team') }}" class="menu-link">
                         <div data-i18n="Team Accounts">Team Accounts</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="{{ route('admin.appointments') }}" class="menu-link">
                         <div data-i18n="Appointments">Appointments</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="{{ route('admin.account.payment_receive') }}" class="menu-link">
                         <div data-i18n="Payment Receive">Payment Receive</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="{{ route('admin.account.slot') }}" class="menu-link">
                         <div data-i18n="Schedule">Schedule</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="{{ route('admin.account.banner') }}" class="menu-link">
                         <div data-i18n="Banner">Banner</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="{{ route('admin.account.reputation') }}" class="menu-link">
                         <div data-i18n="Reputation">Reputation</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="{{ route('admin.account.experience') }}" class="menu-link">
                         <div data-i18n="Experience">Experience</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="{{ route('admin.account.testimonial') }}" class="menu-link">
                         <div data-i18n="Testimonial">Testimonial</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="{{ route('admin.account.contact_us') }}" class="menu-link">
                         <div data-i18n="Contact Us">Contact Us</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="{{ route('admin.account.contact_us_message') }}" class="menu-link">
                         <div data-i18n="Message From Website">Message From Website</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="{{ route('admin.account.tag') }}" class="menu-link">
                         <div data-i18n="Tag">Tag</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="{{ route('admin.account.article') }}" class="menu-link">
                         <div data-i18n="Article">Article</div>
                     </a>
                 </li>

             </ul>
         </li>
         <li class="menu-item">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
                 <div data-i18n="Setting">Setting</div>
             </a>

             <ul class="menu-sub">

                 <li class="menu-item">
                     <a href="{{ route('admin.company.setting') }}" class="menu-link">
                         <div data-i18n="Company Setting">Company Setting</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="{{ route('admin.account.about_us') }}" class="menu-link">
                         <div data-i18n="About Us">About Us</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="{{ route('admin.account.faq_category') }}" class="menu-link">
                         <div data-i18n="Faq Category">Faq Category</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="{{ route('admin.account.faq') }}" class="menu-link">
                         <div data-i18n="Faq">Faq</div>
                     </a>
                 </li>
                 <li class="menu-item">
                     <a href="{{ route('admin.user_role_list') }}" class="menu-link">
                         <div data-i18n="Role">Role</div>
                     </a>
                 </li>

             </ul>
         </li>


     </ul>



 </aside>

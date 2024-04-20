   <!--sidebar wrapper -->
   <div class="sidebar-wrapper" data-simplebar="true">
       <div class="sidebar-header">

       </div>
       <!--navigation-->
       <ul class="metismenu" id="menu">
           <li>
               <a href="">
                   <div class="parent-icon"><i class="bx bx-home-alt"></i>
                   </div>
                   <div class="menu-title">Dashboard</div>
               </a>

           </li>

           <li>
               <a href="{{ url('categories') }}">
                   <div class="parent-icon"><i class="bx bx-cookie"></i>
                   </div>
                   <div class="menu-title">Categories</div>
               </a>
           </li>
           <li>
               <a href="{{ url('subcategories') }}">
                   <div class="parent-icon"><i class="bx bx-message-square-edit"></i>
                   </div>
                   <div class="menu-title">Sub Categories</div>
               </a>
           </li>

           <li>
               <a href="{{ url('products') }}">
                   <div class="parent-icon"><i class="bx bx-upload"></i>
                   </div>
                   <div class="menu-title">Products</div>
               </a>
           </li>


           <li>
            <a href="{{ url('clients') }}">
                <div class="parent-icon"><i class="bx bx-upload"></i>
                </div>
                <div class="menu-title">Clients</div>
            </a>
        </li>

           <li>
               <a href="{{ url('logout') }}">
                   <div class="parent-icon"><i class="bx bx-message-square-edit"></i>
                   </div>
                   <div class="menu-title">Logout</div>
               </a>
           </li>
       </ul>
       <!--end navigation-->
   </div>
   <!--end sidebar wrapper -->

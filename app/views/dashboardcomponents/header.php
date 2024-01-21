 <!--header-->
 <div class="py-2 px-6 bg-white flex items-center shadow-md shadow-black/5 sticky top-0 left-0 z-30 relative">
     <!--sidebar toggle-->
     <button type="button" class="text-lg text-gray-600 sidebar-toggle">
         <i class="ri-menu-line"></i>
     </button>
     <!--sidebar toggle-->
     <!-- profile -->
     <ul class="ml-auto flex items-center">
         <li class="dropdown mr-5">
             <button type="button" class="dropdown-toggle flex items-center">
                 <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded block object-cover align-middle">
             </button>
             <ul
                 class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px] absolute">
                 <li>
                     <a onclick=redirectToSettingsPage()
                         class="cursor-pointer flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Profile</a>
                 </li>
                 <li>
                     <a onclick=redirectToSettingsPage()
                         class="cursor-pointer flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Settings</a>
                 </li>
                 <li>
                     <button id='destroySessionButton'
                         class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Logout</button>
                 </li>
             </ul>
         </li>
     </ul>
     <!-- profile -->
 </div>
 <!--header-->

 <script>
     $(document).ready(function() {
         $("#destroySessionButton").click(function() {
             $.ajax({
                 url: "logout",
                 method: "POST",
                 success: function(response) {
                     location.reload();
                 },
                 error: function(xhr, status, error) {
                     console.error(xhr.responseText);
                 }
             });
         });
     });
 </script>
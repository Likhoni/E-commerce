 <header class="header trans_300">

     <!-- Top Navigation -->
     <div class="top_nav">
         <div class="container">
             <div class="row">
                 <div class="col-md-6">
                     <div class="logo_container">
                         <a href="#" style="color: #f2f2f2;">E - <span>COMMERCE</span></a>
                     </div>
                 </div>
                 <div class="col-md-6 text-right">
                     <div class="top_nav_right">
                         <ul class="top_nav_menu">

                             <!-- Currency / Language / My Account -->

                             <li class="currency">
                                 <a href="#">
                                     Currency
                                     <i class="fa fa-angle-down"></i>
                                 </a>
                                 <ul class="currency_selection">
                                     <li><a href="#">euro</a></li>
                                     <li><a href="#">usd</a></li>
                                     <li><a href="#">taka</a></li>
                                 </ul>
                             </li>

                             <li class="language">
                                 <a href="">Language
                                     <i class="fa fa-angle-down"></i>
                                 </a>
                                 <ul class="language_selection">
                                     <li><a href="{{ route('change.language', 'bn') }}">Bangla</a></li>
                                     <li><a href="{{ route('change.language', 'en') }}">English</a></li>
                                 </ul>
                             </li>

                             <li class="account">
                                 @guest('customerGuard')
                                 <a href="#">
                                     Add Account
                                     <i class="fa fa-angle-down"></i>
                                 </a>
                                 @endguest

                                 @auth('customerGuard')
                                 <a href="#" style="display: flex; align-items: center;">
                                     @if (auth('customerGuard')->user()->image)
                                     <img src="{{ url('images/customers/', auth('customerGuard')->user()->image) }}"
                                         alt="profile picture" class="profile-img"
                                         style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-top: 5px;">
                                     @else
                                     <i class="fa fa-user" aria-hidden="true"
                                         style="font-size: 40px; margin-top: 5px;"></i>
                                     @endif
                                     <span style="margin-left: 10px;">
                                         {{ auth('customerGuard')->user()->FullName }}

                                     </span>
                                     <i class="fa fa-angle-down" style="margin-left: 5px;"></i>
                                 </a>
                                 @endauth

                                 <ul class="account_selection">
                                     @guest('customerGuard')
                                     <li><a href="{{ route('frontend.sign.up') }}"><i class="fa fa-user-plus"
                                                 aria-hidden="true"></i>Sign Up</a></li>
                                     <li><a href="{{ route('frontend.sign.in') }}"><i class="fa fa-sign-in"
                                                 aria-hidden="true"></i>Sign In</a></li>
                                     @endguest

                                     @auth('customerGuard')
                                     <li><a href="{{ route('customer.view') }}">
                                             <i class="fa fa-user" aria-hidden="true"></i>View Profile</a>
                                     </li>
                                     <li><a href="{{ route('frontend.sign.out') }}"><i class="fa fa-sign-out"
                                                 aria-hidden="true"></i>Sign Out</a></li>
                                     @endauth
                                 </ul>
                             </li>

                         </ul>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- Main Navigation -->





     <div class="main_nav_container">
         <div class="container">
             <div class="row">
                 <div class="col-lg-12 text-right">
                     <div class="logo_container">
                         <div class="shop-by-category">
                             <button class="category-toggle" style="color: black;">
                                 <i class="fa fa-bars" aria-hidden="true"></i> Shop By Category
                             </button>
                             <div class="category-menu">
                                 <ul>
                                     @foreach($categories as $category)
                                     @if ($category->parent_id === null)
                                     <li>
                                         {{ $category->category_name }}
                                         @if ($category->childrenRecursive->isNotEmpty())
                                         <i class="fa fa-angle-right"></i>
                                         @endif

                                         @if ($category->childrenRecursive->isNotEmpty())
                                         <ul class="subcategory-menu">
                                             @php
                                             // Define the recursive function to display child categories
                                             $displayChildren = function($children) use (&$displayChildren) {
                                             foreach ($children as $child) {
                                             echo '<li>';
                                                 echo $child->category_name;

                                                 if ($child->childrenRecursive->isNotEmpty()) {
                                                 echo ' <i class="fa fa-angle-right"></i>';
                                                 }

                                                 if ($child->childrenRecursive->isNotEmpty()) {
                                                 echo '<ul class="subcategory-menu">';
                                                     $displayChildren($child->childrenRecursive);
                                                     echo '</ul>';
                                                 }

                                                 echo '</li>';
                                             }
                                             };
                                             // Call the function for the current category's children
                                             $displayChildren($category->childrenRecursive);
                                             @endphp
                                         </ul>
                                         @endif
                                     </li>
                                     @endif
                                     @endforeach
                                 </ul>
                             </div>
                         </div>

                     </div>
                     <nav class="navbar">
                         <ul class="navbar_menu">
                             <li><a href="{{ route('frontend.homepage') }}">{{ __('Home') }}</a></li>
                             <li><a href="{{ route('frontend.all.category.products') }}">Category</a></li>
                             {{-- <li><a href="{{route('frontend.all.brand.products')}}">Brand</a></li> --}}
                             <li><a href="#">pages</a></li>
                             <li><a href="#">blog</a></li>
                             <li><a href="{{ route('frontend.contact.us') }}">contact</a></li>
                         </ul>

                         <!--Add to Cart  & Search-->
                         <ul class="navbar_user">
                             <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>

                             <li class="checkout">
                                 <a href="{{ route('frontend.view.cart') }}">
                                     <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                     <span id="checkout_items" class="checkout_items">
                                         @php
                                         if (session()->has('basket')) {
                                         echo count(session()->get('basket'));
                                         } else {
                                         echo 0;
                                         }
                                         @endphp
                                     </span>
                                 </a>
                             </li>
                         </ul>

                         <div class="hamburger_container">
                             <i class="fa fa-bars" aria-hidden="true"></i>
                         </div>
                     </nav>
                 </div>
             </div>
         </div>
     </div>
     <style>
         .shop-by-category {
             position: relative;
             display: inline-block;
         }

         .category-toggle {
             background: none;
             border: none;
             font-size: 18px;
             color: #1a73e8;
             font-weight: bold;
             cursor: pointer;
         }

         .category-menu {
             display: none;
             position: absolute;
             top: 100%;
             left: 0;
             background-color: white;
             border: 1px solid #ddd;
             box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
             width: 200px;
             height: 400px;
             z-index: 1000;
         }

         .shop-by-category:hover .category-menu {
             display: block;
         }

         .category-menu ul {
             list-style: none;
             padding: 0;
             margin: 0;
         }

         .category-menu li {
             padding: 10px;
             display: flex;
             justify-content: space-between;
             align-items: center;
             cursor: pointer;
             color: #000;
             transition: color 0.3s ease, background-color 0.3s ease;
         }

         .category-menu li:hover {
             background-color: #f2f2f2;
             color: #1a73e8;
         }

         .category-menu li i {
             color: #888;
             transition: color 0.3s ease;
         }

         .category-menu li:hover>i {
             color: #1a73e8;
         }

         .subcategory-menu {
             display: none;
             position: absolute;
             top: 0;
             left: 100%;
             background-color: white;
             border: 1px solid #ddd;
             box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
             width: 200px;
             height: 400px;
             z-index: 1000;
         }

         .category-menu li:hover>.subcategory-menu {
             display: block;
         }

         .subcategory-menu li {
             padding: 10px;
             color: #000;
             transition: color 0.3s ease, background-color 0.3s ease;
         }

         .subcategory-menu li:hover {
             background-color: #f2f2f2;
             color: #1a73e8;

         }

         .subcategory-menu li i {
             color: #888;

         }
     </style>

 </header>
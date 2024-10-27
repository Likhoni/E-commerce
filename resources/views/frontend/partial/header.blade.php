	<header class="header trans_300">

		<!-- Top Navigation -->

		<div class="top_nav">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<!-- <div class="top_nav_left">free shipping on all u.s orders over $50</div> -->
					</div>
					<div class="col-md-6 text-right">
						<div class="top_nav_right">
							<ul class="top_nav_menu">

								<!-- Currency / Language / My Account -->

								<li class="currency">
									<a href="#">
										usd
										<i class="fa fa-angle-down"></i>
									</a>
									<ul class="currency_selection">
										<li><a href="#">cad</a></li>
										<li><a href="#">aud</a></li>
										<li><a href="#">eur</a></li>
										<li><a href="#">gbp</a></li>
									</ul>
								</li>

								<li class="language">
									<a href="">Language
										<i class="fa fa-angle-down"></i>
									</a>
									<ul class="language_selection">
										<li><a href="{{route('change.language','bn')}}">Bangla</a></li>
										<li><a href="{{route('change.language','en')}}">English</a></li>
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
										@if(auth('customerGuard')->user()->image)
										<img src="{{ url('images/customers/', auth('customerGuard')->user()->image) }}" alt="profile picture" class="profile-img" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-top: 5px;">
										@else
										<i class="fa fa-user" aria-hidden="true" style="font-size: 40px; margin-top: 5px;"></i>
										@endif
										<span style="margin-left: 10px;">
										{{auth('customerGuard')->user()->first_name}}
										{{auth('customerGuard')->user()->last_name}}
										 </span>
										<i class="fa fa-angle-down" style="margin-left: 5px;"></i>
									</a>
									@endauth

									<ul class="account_selection">
										@guest('customerGuard')
										<li><a href="{{route('frontend.sign.up')}}"><i class="fa fa-user-plus" aria-hidden="true"></i>Sign Up</a></li>
										<li><a href="{{route('frontend.sign.in')}}"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign In</a></li>
										@endguest

										@auth('customerGuard')
										<li><a href="{{route('customer.view')}}">
												<i class="fa fa-user" aria-hidden="true"></i>View Profile</a>
										</li>
										<li><a href="{{route('frontend.sign.out')}}"><i class="fa fa-sign-out" aria-hidden="true"></i>Sign Out</a></li>
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
							<a href="#">E-<span>Commerce</span></a>
						</div>
						<nav class="navbar">
							<ul class="navbar_menu">
								<li><a href="{{route('frontend.homepage')}}">{{__('Home')}}</a></li>
								<li><a href="{{route('frontend.all.category.products')}}">Category</a></li>
								{{-- <li><a href="{{route('frontend.all.brand.products')}}">Brand</a></li> --}}
								<li><a href="#">pages</a></li>
								<li><a href="#">blog</a></li>
								<li><a href={{route('frontend.contact.us')}}>contact</a></li>
							</ul>
							<ul class="navbar_user">
								<li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>

								<li class="checkout">
									<a href="#">
										<i class="fa fa-shopping-cart" aria-hidden="true"></i>
										<span id="checkout_items" class="checkout_items">2</span>
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

	</header>
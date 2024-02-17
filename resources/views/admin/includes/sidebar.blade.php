<style>
	.logo-img {
		width: 130px;
		height: 50px;
	}
</style>
<aside class="app-sidebar sticky" id="sidebar">
					<!-- Start::main-sidebar-header -->
					<div class="main-sidebar-header">
						<a href="{{ route('admin.dashboard.index') }}" class="header-logo">
							<img src="build/assets/images/brand/desktop-logo.png" alt="logo" class="logo-img desktop-logo">
							<img src="build/assets/images/brand/toggle-logo.png" alt="logo" class="logo-img toggle-logo">
							<img src="build/assets/images/brand/desktop-dark.png" alt="logo" class="logo-img desktop-dark">
							<img src="build/assets/images/brand/toggle-dark.png" alt="logo" class="logo-img toggle-dark">
						</a>
					</div>
					<!-- End::main-sidebar-header -->

					<!-- Start::main-sidebar -->
					<div class="main-sidebar" id="sidebar-scroll" data-simplebar="init"><div class="simplebar-wrapper" style="margin: -8px 0px -80px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 8px 0px 80px;">

						<!-- Start::nav -->
						<nav class="main-menu-container nav nav-pills flex-column sub-open">
							<div class="slide-left d-none" id="slide-left">
								<svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
									<path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
								</svg>
							</div>
							<ul class="main-menu" style="margin-left: 0px; margin-right: 0px;">
								<!-- Start::slide__category -->
								<li class="slide__category"><span class="category-name">Main</span></li>
								<!-- End::slide__category -->

								<!-- Start::slide -->
								<li class="slide">
									<a href="{{ route("admin.dashboard.index") }}" class="side-menu__item">
										<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
											<path d="M0 0h24v24H0V0z" fill="none"></path>
											<path d="M12 5.69l5 4.5V18h-2v-6H9v6H7v-7.81l5-4.5M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3z"></path>
										</svg>
										<span class="side-menu__label">Dashboard</span>
									</a>
								</li>
								<!-- End::slide -->

								<!-- Start::slide__category -->
								<li class="slide__category"><span class="category-name">Areas</span></li>
								<!-- End::slide__category -->

								<!-- Start::slide -->
								<li class="slide has-sub">
									<a href="javascript:void(0);" class="side-menu__item">
                                        <i class="ti ti-map fs-18 me-2 op-7"></i>
										<span class="side-menu__label">Areas</span>
										<i class="fe fe-chevron-right side-menu__angle"></i>
									</a>
									<ul class="slide-menu child1" data-popper-placement="bottom" style="position: relative; left: 0px; top: 0px; margin: 0px; transform: translate3d(119.5px, 237px, 0px);">
										<li class="slide side-menu__label1">
											<a href="javascript:void(0);">Areas</a>
										</li>
										<li class="slide">
											<a href="{{ route("admin.regions.index") }}" class="side-menu__item">Regions</a>
										</li>
										<li class="slide">
											<a href="{{ route("admin.zones.index") }}" class="side-menu__item">Zones</a>
										</li>
									</ul>
								</li>
								<!-- End::slide -->
								
								@if (auth()->user()->role == 'superadmin')
									<!-- Start::slide -->
									<li class="slide">
										<a href="{{ route('admin.managers.index') }}" class="side-menu__item">
											<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 -960 960 960" fill="#000000">
												<path d="M679-466 466-679l213-213 213 213-213 213Zm-559-72v-301h301v301H120Zm418 418v-301h301v301H538Zm-418 0v-301h301v301H120Zm60-478h181v-181H180v181Zm502 51 129-129-129-129-129 129 129 129Zm-84 367h181v-181H598v181Zm-418 0h181v-181H180v181Zm181-418Zm192-78ZM361-361Zm237 0Z"></path>
											</svg>
											<span class="side-menu__label">Managers</span>
										</a>
									</li>
									<!-- End::slide -->
								@endif

								<!-- Start::slide -->
								<li class="slide has-sub">
									<a href="javascript:void(0);" class="side-menu__item">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="side-menu__icon">
											<path d="M0 0h24v24H0V0z" fill="none"></path>
											<path d="M11.99 18.54l-7.37-5.73L3 14.07l9 7 9-7-1.63-1.27zM12 16l7.36-5.73L21 9l-9-7-9 7 1.63 1.27L12 16zm0-11.47L17.74 9 12 13.47 6.26 9 12 4.53z">
											</path>
										</svg>
										<span class="side-menu__label">Members</span>
										<i class="fe fe-chevron-right side-menu__angle"></i>
									</a>
									<ul class="slide-menu child1" data-popper-placement="bottom" style="position: relative; left: 0px; top: 0px; margin: 0px; transform: translate3d(119.5px, 237px, 0px);">
										<li class="slide side-menu__label1">
											<a href="javascript:void(0);">Members</a>
										</li>
										<li class="slide">
											<a href="{{ route("admin.members.index") }}" class="side-menu__item">All</a>
										</li>
										{{-- <li class="slide">
											<a href="{{ route("admin.zones") }}" class="side-menu__item">Zones</a>
										</li> --}}
									</ul>
								</li>
								<!-- End::slide -->
								
                                <!-- Start::slide -->
								<li class="slide">
									<a href="{{ route('admin.profile.index') }}" class="side-menu__item">
                                        <i class="ti ti-users fs-18 me-2 op-7"></i>
										<span class="side-menu__label">My Accounts</span>
									</a>
								</li>
								<!-- End::slide -->

                                <!-- Start::slide -->
								<li class="slide">
									<a href="{{ route('admin.logout') }}" class="side-menu__item">
                                        <i class="ti ti-power fs-18 me-2 op-7"></i>
										<span class="side-menu__label">Logout</span>
									</a>
								</li>
								<!-- End::slide -->
							</ul>
							<div class="slide-right d-none" id="slide-right">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
									<path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
									</path>
								</svg></div>
						</nav>
						<!-- End::nav -->

					</div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 883px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 174px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>
					<!-- End::main-sidebar -->

				</aside>
        @include('admin.includes.header')
		<style>
			.modal-body label {
				font-size: 15px;
			}
			p {
				font-size: 15px;
			}
		</style>
                <!--Main-Sidebar-->
                @include('admin.includes.sidebar')
                <!-- End Main-Sidebar-->

                <!--app-content open-->
                <div class="main-content app-content mt-0">
                    <!-- PAGE-HEADER -->
                    <div class="page-header d-flex align-items-center justify-content-between border-bottom mb-4">
                        <h1 class="page-title">Profile</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
                            </ol>
                        </div>
                    </div>
                    <!-- PAGE-HEADER END -->

                    <div class="main-container container-fluid"> <!-- Start::row-1 -->
                        <div class="row">
                            <div class="col-xl-8">
                                <div class="card custom-card">
                                    <div class="card-header">
                                        <div class="card-title col-10">
                                            View or Edit Profile
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form id="processAuthData" data-first="#updateManagerBtn" data-type="Edit Account" data-transform="no" data-url="{{ route('admin.profile.update') }}" data-redirect="true" data-redirect-to="{{ route('admin.profile.index') }}">
                                            @csrf
                                            <div class="b-block">
                                                <div class="col-sm-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label class="mb-2 fw-500">First Name<span class="text-danger ms-1">*</span></label>
                                                        <input class="form-control ms-0" type="text" value="{{ $user->first_name }}" name="first_name" placeholder="Enter your First Name">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label class="mb-2 fw-500">Last Name<span class="text-danger ms-1">*</span></label>
                                                        <input class="form-control ms-0" type="text" value="{{ $user->last_name }}" name="last_name" placeholder="Enter your Last Name">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-3">
                                                    <div class="form-group mb-0">
                                                        <label class="mb-2 fw-500">Email<span class="text-danger ms-1">*</span></label>
                                                        <input class="form-control ms-0" type="text" value="{{ $user->email }}" name="email" placeholder="Enter your Email">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary" type="submit" id="updateManagerBtn">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End::row-1 -->

                    </div>
                    <!-- CONTAINER END -->
                </div>
                <!-- END APP-CONTENT -->
            </div>
            <!--app-content closed-->

           @include('admin.includes.footer')
           @include('admin.includes.scripts')
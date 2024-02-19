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
                        <h1 class="page-title">Managers</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Managers</li>
                            </ol>
                        </div>
                    </div>
                    <!-- PAGE-HEADER END -->

                    <div class="main-container container-fluid"> <!-- Start::row-1 -->
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card custom-card">
                                    <div class="card-header">
                                        <div class="card-title col-10">
                                            Managers Table
                                        </div>
										<button class="float-right btn btn-success" data-bs-toggle="modal" data-bs-target="#addManager" style="
    float: right;
"><i class="ti ti-plus fs-18 me-2 op-7"></i>Add Manager</button>
																		<!-- BASIC MODAL -->
																		<div class="modal fade" id="addManager">
																			<div class="modal-dialog" role="document">
																				<div class="modal-content modal-content-demo">
																					<div class="modal-header">
																						<h6 class="modal-title">Add Manager</h6><button aria-label="Close" class="btn-close"
																							data-bs-dismiss="modal"></button>
																					</div>
																					<div class="modal-body">
																					<form id="processAuthData" data-first="#createManagerBtn" data-type="Add Manager" data-transform="no" data-url="{{ route('admin.managers.create') }}" data-redirect="true" data-redirect-to="{{ route('admin.managers.index') }}">
																						@csrf
																						<input type="hidden" name="secret_code">
																						<div class="b-block">
																							<div class="col-sm-12 mb-3">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">First Name<span class="text-danger ms-1">*</span></label>
																									<input class="form-control ms-0" type="text" name="first_name" placeholder="Enter your First Name">
																								</div>
																							</div>
																							<div class="col-sm-12 mb-3">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">Last Name<span class="text-danger ms-1">*</span></label>
																									<input class="form-control ms-0" type="text" name="last_name" placeholder="Enter your Last Name">
																								</div>
																							</div>
																							<div class="col-sm-12 mb-3">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">Email<span class="text-danger ms-1">*</span></label>
																									<input class="form-control ms-0" type="email" name="email" placeholder="Enter your Email">
																								</div>
																							</div>
																							<div class="col-sm-12 mb-3">
																								<div class="form-group mb-4">
																									<label class="mb-2 fw-500">Password<span class="text-danger ms-1">*</span></label>
																									<div>
																										<div class="input-group">
																											<input type="password" class="form-control" name="password" id="passwordField" placeholder="Password">
																											<button class="btn btn-outline-secondary" type="button" id="togglePassword">
																												<i class="bi bi-eye"></i>
																											</button>
																										</div>
																									</div>
																								</div>
																							</div>
																							<div class="col-sm-12 mb-3">
																								<div class="form-group mb-4">
																									<label class="mb-2 fw-500">Confirm Password<span class="text-danger ms-1">*</span></label>
																									<div>
																										<div class="input-group">
																											<input type="password" class="form-control" name="password_confirmation" id="confPasswordField" placeholder="Password">
																											<button class="btn btn-outline-secondary" type="button" id="confTogglePassword">
																												<i class="bi bi-eye"></i>
																											</button>
																										</div>
																									</div>
																								</div>
																							</div>
																							<div class="col-xl-12">
																								<div class="modal-footer">
																									<button class="btn btn-primary" type="submit" id="createManagerBtn">Save changes</button>
																									<button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
																								</div>
																							</div>
																						</div>
																					</form>
																					</div>
																				</div>
																			</div>
																		</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="datatable-basic" class="table table-bordered text-nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>FullName</th>
                                                        <th>Email</th>
														<th>Actions</th>
													</tr>
                                                </thead>
                                                <tbody>
													@foreach ($managers as $manager)
														<tr>
															<td>{{ $manager->first_name }} {{ $manager->last_name }}</td>
															<td>{{ $manager->email }}</td>
															<td>
																<div class="hstack gap-2 fs-1">
                                                                    <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-sm btn-info-light btn-wave waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#editManager{{ $manager->secret_code }}">
                                                                        <i class="ri-edit-line"></i></a>
                                                                        <button aria-label="anchor" type="button" class="btn btn-icon btn-sm btn-danger-light btn-wave waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#deleteManager{{ $manager->secret_code }}">
                                                                            <i class="ri-delete-bin-7-line"></i>
                                                                    </button>
																		<!-- BASIC MODAL -->
																		<div class="modal fade" id="editManager{{ $manager->secret_code }}">
																			<div class="modal-dialog" role="document">
																				<div class="modal-content modal-content-demo">
																					<div class="modal-header">
																						<h6 class="modal-title">Update Manager</h6><button aria-label="Close" class="btn-close"
																							data-bs-dismiss="modal"></button>
																					</div>
																					<div class="modal-body">
																					<form id="processEditData" data-id="{{ $manager->secret_code }}" data-first="#updateManagerBtn" data-type="Update Manager" data-transform="no" data-url="{{ route('admin.managers.update') }}" data-redirect="true" data-redirect-to="{{ route('admin.managers.index') }}">
																						@csrf
																						<input type="hidden" name="secret_code" value="{{ $manager->secret_code }}">
																						<div class="b-block">
																							<div class="col-sm-12">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">First Name<span class="text-danger ms-1">*</span></label>
																									<input class="form-control ms-0" value="{{ $manager->first_name }}" type="text" name="first_name" placeholder="Enter your First Name">
																								</div>
																							</div>
																							<div class="col-sm-12">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">Last Name<span class="text-danger ms-1">*</span></label>
																									<input class="form-control ms-0" value="{{ $manager->last_name }}" type="text" name="last_name" placeholder="Enter your Last Name">
																								</div>
																							</div>
																							<div class="col-sm-12">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">Email<span class="text-danger ms-1">*</span></label>
																									<input class="form-control ms-0" value="{{ $manager->email }}" type="email" name="email" placeholder="Enter your Email">
																								</div>
																							</div>
																							<div class="col-sm-12">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">Password<span class="text-danger ms-1">*</span></label>
																									<div>
																										<div class="input-group">
																											<input type="password" class="form-control" name="password" id="passwordField2" placeholder="Password">
																											<button class="btn btn-outline-secondary" type="button" id="togglePassword2">
																												<i class="bi bi-eye"></i>
																											</button>
																										</div>
																									</div>
																								</div>
																							</div>
																							<div class="col-sm-12 mb-3">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">Confirm Password<span class="text-danger ms-1">*</span></label>
																									<div>
																										<div class="input-group">
																											<input type="password" class="form-control" name="password_confirmation" id="confPasswordField2" placeholder="Password">
																											<button class="btn btn-outline-secondary" type="button" id="confTogglePassword2">
																												<i class="bi bi-eye"></i>
																											</button>
																										</div>
																									</div>
																								</div>
																							</div>
																							<div class="col-xl-12">
																								<div class="modal-footer">
																									<button class="btn btn-primary" type="submit" id="updateManagerBtn">Save changes</button>
																									<button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
																								</div>
																							</div>
																						</div>
																					</form>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="modal fade" id="deleteManager{{ $manager->secret_code }}">
																			<div class="modal-dialog" role="document">
																				<div class="modal-content modal-content-demo">
																					<div class="modal-header">
																						<h6 class="modal-title">Delete Manager</h6><button aria-label="Close" class="btn-close"
																							data-bs-dismiss="modal"></button>
																					</div>
																					<div class="modal-body">
																						<form action="{{ route('admin.managers.delete', [$manager->secret_code]) }}" method="POST">
																							@csrf
																							@method("DELETE")
																							<div class="b-block">
																								<div class="col-sm-12">
																									<p class="mb-4">Are you sure you want to delete this Admin <b>{{ $manager->first_name }} {{ $manager->last_name }}?</b></p class="mb-4">
																								</div>
																								<div class="col-xl-12">
																									<div class="modal-footer">
																										<button class="btn btn-primary" type="submit">Yes, Delete it.</button>
																										<button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
																									</div>
																								</div>
																							</div>
																						</form>
																					</div>
																				</div>
																			</div>
																		</div>
                                                                </div>
															</td>
														</tr>
													@endforeach
                                                </tbody>
                                            </table>
                                        </div>
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
<script>
$(document).ready(function () {
	$(document).on('submit', '#processEditData', function (e) {
	// $("#processEditData").submit(function (e) {
		e.preventDefault();
		event.preventDefault();
        var first = $(this).data('first')
        var type = $(this).data('type')
        var transform = $(this).data('transform')
        var url = $(this).data('url')
        var redirect = $(this).data('redirect')
        var redirectTo = $(this).data('redirect-to');
        var hasFile = $(this).data('hasfile')
        var formData = new FormData(this);
        $('.loader-button .loader').css('display', 'block')
        $(first).attr("disabled", true)
        $.ajax({
            type: 'POST',
            url: url,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function (response) {
                if (transform != 'no') {
                    $(first).text(transform)
                }
                $('.loader-button .loader').css('display', 'none')
                toastr.success(response.message, type, { timeOut: 3000 })

                setTimeout(() => {
                    if (redirect == true) {
                        if (redirectTo == "") {
                            window.location = "/account"
                        } else {
                            window.location = redirectTo;
                        }
                    } else {
                        window.location.reload()
                    }
                }, 1000);
                $(first).attr("disabled", false)
            },
            error: function (xhr, status, error) {
                $('.loader-button .loader').css('display', 'none')
                $(first).attr("disabled", false)
                toastr.error(xhr.responseJSON.message, type, { timeOut: 3000 })
            }
        });
    });
})
const passwordField = document.getElementById('passwordField');
const toggleButton = document.getElementById('togglePassword');

toggleButton.addEventListener('click', function() {
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleButton.innerHTML = '<i class="fa fa-eye-slash"></i>';
    } else {
        passwordField.type = 'password';
        toggleButton.innerHTML = '<i class="fa fa-eye"></i>';
    }
});

const passwordField2 = document.getElementById('passwordField2');
const toggleButton2 = document.getElementById('togglePassword2');

toggleButton2.addEventListener('click', function() {
    if (passwordField2.type === 'password') {
        passwordField2.type = 'text';
        toggleButton2.innerHTML = '<i class="fa fa-eye-slash"></i>';
    } else {
        passwordField2.type = 'password';
        toggleButton2.innerHTML = '<i class="fa fa-eye"></i>';
    }
});


const confPasswordField = document.getElementById('confPasswordField');
const confTogglePassword = document.getElementById('confTogglePassword');

confTogglePassword.addEventListener('click', function() {
    if (confPasswordField.type === 'password') {
        confPasswordField.type = 'text';
        confTogglePassword.innerHTML = '<i class="fa fa-eye-slash"></i>';
    } else {
        confPasswordField.type = 'password';
        confTogglePassword.innerHTML = '<i class="fa fa-eye"></i>';
    }
});

const confPasswordField2 = document.getElementById('confPasswordField2');
const confTogglePassword2 = document.getElementById('confTogglePassword2');

confTogglePassword2.addEventListener('click', function() {
    if (confPasswordField2.type === 'password') {
        confPasswordField2.type = 'text';
        confTogglePassword2.innerHTML = '<i class="fa fa-eye-slash"></i>';
    } else {
        confPasswordField2.type = 'password';
        confTogglePassword2.innerHTML = '<i class="fa fa-eye"></i>';
    }
});

</script>
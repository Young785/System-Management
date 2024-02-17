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
                        <h1 class="page-title">Members</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Members</li>
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
                                            Members Table
                                        </div>
										<button class="float-right btn btn-success" data-bs-toggle="modal" data-bs-target="#addManager" style="
    float: right;
"><i class="ti ti-plus fs-18 me-2 op-7"></i>Add Member</button>
																		<!-- BASIC MODAL -->
																		<div class="modal fade" id="addManager">
																			<div class="modal-dialog" role="document">
																				<div class="modal-content modal-content-demo">
																					<div class="modal-header">
																						<h6 class="modal-title">Add Member</h6><button aria-label="Close" class="btn-close"
																							data-bs-dismiss="modal"></button>
																					</div>
																					<div class="modal-body">
																					<form id="processAuthData" data-first="#createManagerBtn" data-type="Add Member" data-transform="no" data-url="{{ route('admin.members.create') }}" data-redirect="true" data-redirect-to="{{ route('admin.members.index') }}">
																						@csrf
																						<input type="hidden" name="secret_key">
																						<div class="b-block">
																							<div class="col-sm-12 mb-3">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">First Name<span class="text-danger ms-1">*</span></label>
																									<input class="form-control ms-0" type="text" name="firstname" placeholder="Enter your First Name">
																								</div>
																							</div>
																							<div class="col-sm-12 mb-3">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">Last Name<span class="text-danger ms-1">*</span></label>
																									<input class="form-control ms-0" type="text" name="lastname" placeholder="Enter your Last Name">
																								</div>
																							</div>
																							<div class="col-sm-12 mb-3">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">Address<span class="text-danger ms-1">*</span></label>
																									<textarea class="form-control ms-0" type="text" name="address" placeholder="Enter member's Address"></textarea>
																								</div>
																							</div>
																							<div class="col-sm-12 mb-3">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">Phone Number<span class="text-danger ms-1">*</span></label>
																									<input class="form-control ms-0" type="number" name="phone" placeholder="Enter member's Phone Number">
																								</div>
																							</div>
																							<div class="col-sm-12 mb-3">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">Date of Birth<span class="text-danger ms-1">*</span></label>
																									<input class="form-control ms-0" type="date" name="dob">
																								</div>
																							</div>
																							<div class="col-sm-12 mb-3">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">Marital Status<span class="text-danger ms-1">*</span></label>
																									<select name="marital_status" class="form-control">
																										<option value="single">Single</option>
																										<option value="marrried">Married</option>
																									</select>
																								</div>
																							</div>
																							<div class="col-sm-12 mb-3">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">Passport<span class="text-danger ms-1">*</span></label>
																									<input class="form-control ms-0" onchange="loadPassportFile(event)" type="file" name="passport">
																								</div>
																								<div class="col-5 mt-3">
																									<img src="" width="500" height="100" id="passport">
																								</div>
																							</div>
																							<div class="col-sm-12 mb-3">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">NIN<span class="text-danger ms-1">*</span></label>
																									<input class="form-control ms-0" onchange="loadNinFile(event)" type="file" name="nin">
																								</div>
																								<div class="col-5 mt-3">
																									<img src="" width="500" height="100" id="nin">
																								</div>
																							</div>
																							<div class="col-sm-12 mb-3">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">Status<span class="text-danger ms-1">*</span></label>
																									<select name="status" class="form-control">
																										<option value="active">Active</option>
																										<option value="inactive">Inactive</option>
																									</select>
																								</div>
																							</div>
																							<div class="col-xl-12">
																								<div class="modal-footer">
																									<button class="btn btn-primary">Save changes</button>
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
                                                        <th>Phone</th>
                                                        <th>Date of Birth</th>
                                                        <th>Marital Status</th>
                                                        <th>Added On</th>
														<th>Actions</th>
													</tr>
                                                </thead>
                                                <tbody>
													@foreach ($members as $member)
														<tr>
															<td>{{ $member->firstname }} {{ $member->lastname }}</td>
															<td>{{ $member->phone }}</td>
															<td>{{ \Carbon\Carbon::parse($member->dob)->diffForHumans() }}</td>
															<td>{{ $member->marital_status }}</td>
															<td>{{ \Carbon\Carbon::parse($member->created_at)->diffForHumans() }}</td>
															<td>
																<div class="hstack gap-2 fs-1">
                                                                    <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-sm btn-info-light btn-wave waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#editManager{{ $member->secret_key }}">
                                                                        <i class="ri-edit-line"></i></a>
                                                                        <button aria-label="anchor" type="button" class="btn btn-icon btn-sm btn-danger-light btn-wave waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#deleteManager{{ $member->secret_key }}">
                                                                            <i class="ri-delete-bin-7-line"></i>
                                                                    </button>
																		<!-- BASIC MODAL -->
																		<div class="modal fade" id="editManager{{ $member->secret_key }}">
																			<div class="modal-dialog" role="document">
																				<div class="modal-content modal-content-demo">
																					<div class="modal-header">
																						<h6 class="modal-title">Update Member</h6><button aria-label="Close" class="btn-close"
																							data-bs-dismiss="modal"></button>
																					</div>
																					<div class="modal-body">
																					<form id="processEditData" data-first="#updateMemberBtn" data-type="Update Member" data-transform="no" data-url="{{ route('admin.members.update') }}" data-redirect="true" data-redirect-to="{{ route('admin.members.index') }}">
																						@csrf
																						<input value="{{ $member->secret_key }}" name="secret_key" hidden>
																						<div class="b-block">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">First Name<span class="text-danger ms-1">*</span></label>
																									<input class="form-control ms-0" type="text" value="{{ $member->firstname }}" name="firstname" placeholder="Enter your First Name">
																								</div>
																							</div>
																							<div class="col-sm-12 mb-">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">Last Name<span class="text-danger ms-1">*</span></label>
																									<input class="form-control ms-0" type="text" value="{{ $member->lastname }}" name="lastname" placeholder="Enter your Last Name">
																								</div>
																							</div>
																							<div class="col-sm-12 mb-">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">Address<span class="text-danger ms-1">*</span></label>
																									<textarea class="form-control ms-0" type="text" name="address" placeholder="Enter member's Address">{{ $member->address }}</textarea>
																								</div>
																							</div>
																							<div class="col-sm-12 mb-">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">Phone Number<span class="text-danger ms-1">*</span></label>
																									<input class="form-control ms-0" type="number" value="{{ $member->phone }}" name="phone" placeholder="Enter member's Phone Number">
																								</div>
																							</div>
																							<div class="col-sm-12 mb-">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">Date of Birth<span class="text-danger ms-1">*</span></label>
																									<input class="form-control ms-0" type="date" value="{{ $member->dob }}" name="dob">
																								</div>
																							</div>
																							<div class="col-sm-12 mb-">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">Marital Status<span class="text-danger ms-1">*</span></label>
																									<select name="marital_status" class="form-control">
																										<option {{ ($member->marital_status == 'single') ? 'selected' : '' }} value="single">Single</option>
																										<option {{ ($member->marital_status == 'marrried') ? 'selected' : '' }} value="marrried">Married</option>
																									</select>
																								</div>
																							</div>
																							<div class="col-sm-12 mb-">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">Passport<span class="text-danger ms-1">*</span></label>
																									<input class="form-control ms-0" onchange="loadPassportFile(event)" type="file" name="passport">
																								</div>
																								<div class="col-5 mt-3">
																									<img src="{{ url('/') }}/{{ $member->passport }}" id="passport2" width="500" height="100">
																								</div>
																							</div>
																							<div class="col-sm-12 mb-">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">NIN<span class="text-danger ms-1">*</span></label>
																									<input class="form-control ms-0" onchange="loadNinFile(event)" type="file" name="nin">
																								</div>
																								<div class="col-5 mt-3">
																									<img src="{{ url('/') }}/{{ $member->nin }}" id="nin2" width="500" height="100">
																								</div>
																							</div>
																							<div class="col-sm-12 mb-">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">Status<span class="text-danger ms-1">*</span></label>
																									<select name="status" class="form-control">
																										<option {{ ($member->marital_status == 'active') ? 'selected' : '' }} value="active">Active</option>
																										<option {{ ($member->marital_status == 'inactive') ? 'selected' : '' }} value="inactive">Inactive</option>
																									</select>
																								</div>
																							</div>
																							<div class="col-xl-12">
																								<div class="modal-footer">
																									<button class="btn btn-primary" type="submit" id="updateMemberBtn">Save changes</button>
																									<button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
																								</div>
																							</div>
																						</div>
																					</form>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="modal fade" id="deleteManager{{ $member->secret_key }}">
																			<div class="modal-dialog" role="document">
																				<div class="modal-content modal-content-demo">
																					<div class="modal-header">
																						<h6 class="modal-title">Delete Member</h6><button aria-label="Close" class="btn-close"
																							data-bs-dismiss="modal"></button>
																					</div>
																					<div class="modal-body">
																						<form action="{{ route('admin.members.delete', [$member->secret_key]) }}" method="POST">
																							@csrf
																							@method("DELETE")
																							<div class="b-block">
																								<div class="col-sm-12">
																									<p class="mb-4">Are you sure you want to delete this Admin <b>{{ $member->first_name }} {{ $member->last_name }}?</b></p class="mb-4">
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
				var loadPassportFile = function(event) {
					var reader = new FileReader();
					reader.onload = function(){
					var output = document.getElementById('passport');
					output.src = reader.result;
					};
					reader.readAsDataURL(event.target.files[0]);
				};
				var loadNinFile = function(event) {
					var reader = new FileReader();
					reader.onload = function(){
					var output = document.getElementById('nin');
					output.src = reader.result;
					};
					reader.readAsDataURL(event.target.files[0]);
				};
				var loadPassportFile = function(event) {
					var reader = new FileReader();
					reader.onload = function(){
					var output = document.getElementById('passport2');
					output.src = reader.result;
					};
					reader.readAsDataURL(event.target.files[0]);
				};
				var loadNinFile = function(event) {
					var reader = new FileReader();
					reader.onload = function(){
					var output = document.getElementById('nin2');
					output.src = reader.result;
					};
					reader.readAsDataURL(event.target.files[0]);
				};
		   </script>
<script>
$(document).ready(function () {
	$("#processEditData").submit(function (e) {
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
                }, 2000);
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
</script>
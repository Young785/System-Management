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
                        <h1 class="page-title">Regions</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Regions</li>
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
                                            Regions Table
                                        </div>
										<button class="float-right btn btn-success" data-bs-toggle="modal" data-bs-target="#addRegion" style="
    float: right;
"><i class="ti ti-plus fs-18 me-2 op-7"></i>Add Region</button>
																		<!-- BASIC MODAL -->
																		<div class="modal fade" id="addRegion">
																			<div class="modal-dialog" role="document">
																				<div class="modal-content modal-content-demo">
																					<div class="modal-header">
																						<h6 class="modal-title">Add Region</h6><button aria-label="Close" class="btn-close"
																							data-bs-dismiss="modal"></button>
																					</div>
																					<div class="modal-body">
																					<form id="processAuthData" data-first="#createRegionBtn" data-type="Add Region" data-transform="no" data-url="{{ route('admin.regions.create') }}" data-redirect="true" data-redirect-to="{{ route('admin.regions.index') }}">
																						@csrf
																						<input type="hidden" name="code">
																						<div class="b-block">
																							<div class="col-sm-12 mb-3">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">Name<span class="text-danger ms-1">*</span></label>
																									<input class="form-control ms-0" type="text" name="name" placeholder="Enter region Name">
																								</div>
																							</div>
																							<div class="col-sm-12">
																								<div class="form-group mb-0">
																									<label class="mb-2 fw-500">Status<span class="text-danger ms-1">*</span></label>
																									<select name="status" class="form-control">
																										<option value="active">Active</option>
																										<option value="inactive">Inactive</option>
																									</select>
																								</div>
																							</div>
																							<div class="col-xl-12 mt-4">
																								<div class="modal-footer">
																									<button class="btn btn-primary" id="createRegionBtn">Add Regions</button>
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
                                                <thead class="border-top">
													<tr>
														<th class="border-bottom-0">Region no</th>
														<th class="border-bottom-0">Region name</th>
														<th class="border-bottom-0">Status</th>
														<th class="border-bottom-0">Created at</th>
														<th class="border-bottom-0">Actions</th>
													</tr>
												</thead>
                                                <tbody>
													@foreach ($regions as $region)
														<tr>
															<td>{{ $region->code }}</td>
															<td>{{ $region->name }}</td>
															<td>{{ $region->status }}</td>
															<td>{{ \Carbon\Carbon::parse($region->created_at)->diffForHumans() }}</td>
															<td>
																<div class="hstack gap-2 fs-1">
                                                                    <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-sm btn-info-light btn-wave waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#editRegion{{ $region->code }}">
                                                                        <i class="ri-edit-line"></i></a>
                                                                        <button aria-label="anchor" type="button" class="btn btn-icon btn-sm btn-danger-light btn-wave waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#deleteRegion{{ $region->code }}">
                                                                            <i class="ri-delete-bin-7-line"></i>
                                                                    </button>
																		<!-- BASIC MODAL -->
																		<div class="modal fade" id="editRegion{{ $region->code }}">
																			<div class="modal-dialog" role="document">
																				<div class="modal-content modal-content-demo">
																					<div class="modal-header">
																						<h6 class="modal-title">Update Region</h6><button aria-label="Close" class="btn-close"
																							data-bs-dismiss="modal"></button>
																					</div>
																					<div class="modal-body">
																						<form id="processEditData" data-first="#updateRegionBtn" data-type="Update Region" data-transform="no" data-url="{{ route('admin.regions.update', [$region->code]) }}" data-redirect="true" data-redirect-to="{{ route('admin.regions.index') }}">
																							@csrf
																							<div class="b-block">
																								<div class="col-sm-12">
																									<div class="form-group mb-0">
																										<label class="mb-2 fw-500">Code<span class="text-danger ms-1">*</span></label>
																										<input class="form-control ms-0" value="{{ $region->code }}" disabled type="text">
																									</div>
																								</div>
																								<div class="col-sm-12">
																									<div class="form-group mb-0">
																										<label class="mb-2 fw-500">Name<span class="text-danger ms-1">*</span></label>
																										<input class="form-control ms-0" value="{{ $region->name }}" type="text" name="name" placeholder="Enter region Name">
																									</div>
																								</div>
																								<div class="col-sm-12">
																									<div class="form-group mb-0">
																										<label class="mb-2 fw-500">Status<span class="text-danger ms-1">*</span></label>
																										<select name="status" class="form-control">
																											<option {{ ($region->status == 'active') ? 'selected' : '' }} value="active">Active</option>
																											<option {{ ($region->status == 'inactive') ? 'selected' : '' }} value="active">Inactive</option>
																										</select>
																									</div>
																								</div>
																								<div class="col-xl-12 mt-4">
																									<div class="modal-footer">
																										<button class="btn btn-primary" id="updateRegionBtn" type="submit">Save changes</button>
																										<button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
																									</div>
																								</div>
																							</div>
																						</form>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="modal fade" id="deleteRegion{{ $region->code }}">
																			<div class="modal-dialog" role="document">
																				<div class="modal-content modal-content-demo">
																					<div class="modal-header">
																						<h6 class="modal-title">Delete Region</h6><button aria-label="Close" class="btn-close"
																							data-bs-dismiss="modal"></button>
																					</div>
																					<div class="modal-body">
																						<form action="{{ route('admin.regions.delete', [$region->code]) }}" method="POST">
																							@csrf
																							@method("DELETE")
																							<div class="b-block">
																								<div class="col-sm-12">
																									<p class="mb-4">Are you sure you want to delete <b>{{ $region->name }} {{ $region->status }}?</b> Region</p>
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
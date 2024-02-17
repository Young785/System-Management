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
      <h1 class="page-title">Zones</h1>
      <div>
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Zones</li>
         </ol>
      </div>
   </div>
                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- Start::Row-1 -->
                        <div class="row">
                            <div class="col-xxl-9">
                                <div class="row">
                                    <div class="col-xxl-5 col-xl-12">
                                        <div class="row">
                                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xxl-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-start">
                                                            <div class="flex-grow-1">
                                                                <p class="mb-0">Total Managers</p>
                                                                <span class="fs-5">{{ $managers }}</span>
                                                            </div>
                                                            <div class="min-w-fit-content ms-3">
                                                                <span
                                                                    class="avatar avatar-md br-5 bg-primary-transparent text-primary">
                                                                    <i class="fe fe-user fs-18"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xxl-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-start">
                                                            <div class="flex-grow-1">
                                                                <p class="mb-0">Total Members</p>
                                                                <span class="fs-5">{{ $managers }}</span>
                                                            </div>
                                                            <div class="min-w-fit-content ms-3">
                                                                <span
                                                                    class="avatar avatar-md br-5 bg-secondary-transparent text-secondary">
                                                                    <i class="fe fe-package fs-18"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xxl-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-start">
                                                            <div class="flex-grow-1">
                                                                <p class="mb-0">Total Regions</p>
                                                                <span class="fs-5">{{ $regions }}</span>
                                                            </div>
                                                            <div class="min-w-fit-content ms-3">
                                                                <span
                                                                    class="avatar avatar-md br-5 bg-warning-transparent text-warning">
                                                                    <i class="fe fe-credit-card fs-18"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xxl-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-start flex-wrap gap-1">
                                                            <div class="flex-grow-1">
                                                                <p class="mb-0">Total Zones </p>
                                                                <span class="fs-5">{{ $zones }}</span>
                                                            </div>
                                                            <div class="min-w-fit-content">
                                                                <span class="avatar avatar-md br-5 bg-info-transparent">
                                                                    <i class="fe fe-user-plus fs-18"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End::Row-1 -->

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
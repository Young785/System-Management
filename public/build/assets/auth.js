
$(document).ready(function () {
    $('#processAuthData').submit(function (event) {
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
                $(this).closest('.modal').modal('toggle');
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
    $(document).on('change', '#getZones', function (e) {
        e.preventDefault();
        event.preventDefault();
        var id = $(this).val()
        var option = $('<option>', {
            selected: "selected",
            text: "Loading, Please wait..."
        });

        $('#allZones').append(option);
        $.ajax({
            type: 'GET',
            url: "/members/get-zones/" + id,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {},
            success: function (response) {
                $('#allZones').empty();
                response.data.forEach(function (optionData) {
                    var option = $('<option>', {
                        value: optionData.code,
                        text: optionData.name
                    });
                    $('#allZones').append(option);
                });
            },
            error: function (xhr, status, error) {
                toastr.error("Error loading Zones" + error, { timeOut: 3000 })
            }
        });
    });
    $(document).on('change', '#getZones2', function (e) {
        e.preventDefault();
        event.preventDefault();
        var id = $(this).val()
        var option = $('<option>', {
            selected: "selected",
            text: "Loading, Please wait..."
        });

        $('#allZones').append(option);
        $.ajax({
            type: 'GET',
            url: "/members/get-zones/" + id,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {},
            success: function (response) {
                $('#allZones2').empty();
                response.data.forEach(function (optionData) {
                    var option = $('<option>', {
                        value: optionData.code,
                        text: optionData.name
                    });
                    $('#allZones2').append(option);
                });
            },
            error: function (xhr, status, error) {
                toastr.error("Error loading Zones" + error, { timeOut: 3000 })
            }
        });
    });
    $(document).on('change', '#exportMember', function (e) {
        e.preventDefault();
        event.preventDefault();
        var id = $(this).val()
        var option = $('<option>', {
            selected: "selected",
            text: "Loading, Please wait..."
        });

        $('#allZones').append(option);
        $.ajax({
            type: 'GET',
            url: "/members/export",
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {},
            success: function (response) {
                $('#allZones2').empty();
                response.data.forEach(function (optionData) {
                    var option = $('<option>', {
                        value: optionData.code,
                        text: optionData.name
                    });
                    $('#allZones2').append(option);
                });
            },
            error: function (xhr, status, error) {
                toastr.error("Error loading Zones" + error, { timeOut: 3000 })
            }
        });
    });

    $('#handleSubmission').submit(function (event) {
    });
});
   

        </div>    
        <!-- END PAGE-->

        <!-- SCRIPTS -->
        <!-- Scroll To Top -->
        <div class="scrollToTop">
           <span class="arrow"><i class="fa fa-angle-up fs-20"></i></span>
        </div>
        <!-- Scroll To Top -->

        <div id="responsive-overlay"></div>

        <!-- Popper JS -->
        <script src="{{ url('/') }}/build/assets/libs/%40popperjs/core/umd/popper.min.js"></script>

        <!-- Bootstrap JS -->
        <script src="{{ url('/') }}/build/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        
        <!-- Datatables Cdn -->
        {{-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> --}}

<!-- DataTables -->
<script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>

<!-- DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.dataTables.js"></script>

<!-- JSZip -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<!-- PDFMake -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<!-- DataTables Buttons HTML5 Export -->
<script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.html5.min.js"></script>

<!-- DataTables Buttons Print -->
<script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.print.min.js"></script>
        
        <script type="module" src="{{ url('/') }}/build/assets/auth.js"></script>

        <!-- Node Waves JS-->
        <script src="{{ url('/') }}/build/assets/libs/node-waves/waves.min.js"></script>

        <!-- Simplebar JS -->
        <script src="{{ url('/') }}/build/assets/libs/simplebar/simplebar.min.js"></script>
        <link rel="modulepreload" href="{{ url('/') }}/build/assets/simplebar-635bad04.js" /><script type="module" src="{{ url('/') }}/build/assets/simplebar-635bad04.js"></script>
        <!-- Color Picker JS -->
        <script src="{{ url('/') }}/build/assets/libs/%40simonwep/pickr/pickr.es5.min.js"></script>
        <!-- Sticky JS -->
        <script src="{{ url('/') }}/build/assets/sticky.js"></script>

        <!-- APP JS-->
		<link rel="modulepreload" href="{{ url('/') }}/build/assets/app-6df099bd.js" />
        <link rel="modulepreload" href="{{ url('/') }}/build/assets/defaultmenu-7feba3a7.js" /><script type="module" src="{{ url('/') }}/build/assets/app-6df099bd.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            @if(Session::has('success'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
                    toastr.success("{{ session('success') }}");
            @endif

            @if(Session::has('error'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
                    toastr.error("{{ session('error') }}");
            @endif

            @if(Session::has('info'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
                    toastr.info("{{ session('info') }}");
            @endif

            @if(Session::has('warning'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
                    toastr.warning("{{ session('warning') }}");
            @endif
        </script>
        <script>
new DataTable('#membersTable', {
    layout: {
        topStart: {
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        }
    }
});
</script>
<script>
new DataTable('#datatable-basic', {
    layout: {
        topStart: {
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        }
    }
});
</script>
        <!-- END SCRIPTS -->

    </body> 
</html>

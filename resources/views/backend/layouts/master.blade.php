<!DOCTYPE html>
<html lang="en">


<head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Multipurpose, super flexible, powerful, clean modern responsive bootstrap 5 admin template"
        name="description">
    <meta
        content="admin template, ki-admin admin template, dashboard template, flat admin template, responsive admin template, web app"
        name="keywords">
    <meta content="la-themes" name="author">
    <link href="{{ asset('backend') }}/assets/images/logo/favicon.png" rel="icon" type="image/x-icon">
    <link href="{{ asset('backend') }}/assets/images/logo/favicon.png" rel="shortcut icon" type="image/x-icon">
    <title>CRM | </title>

    <!-- Animation css -->
    <link href="{{ asset('backend') }}/assets/vendor/animation/animate.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com/" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&amp;display=swap"
        rel="stylesheet">

    <!--flag Icon css-->
    <link href="{{ asset('backend') }}/assets/vendor/flag-icons-master/flag-icon.css" rel="stylesheet" type="text/css">

    <!-- tabler icons-->
    <link href="{{ asset('backend') }}/assets/vendor/tabler-icons/tabler-icons.css" rel="stylesheet" type="text/css">

    <!-- apexcharts css-->
    <link href="{{ asset('backend') }}/assets/vendor/apexcharts/apexcharts.css" rel="stylesheet" type="text/css">

    <!-- glight css -->
    <link href="{{ asset('backend') }}/assets/vendor/glightbox/glightbox.min.css" rel="stylesheet">

    <!-- Bootstrap css-->
    <link href="{{ asset('backend') }}/assets/vendor/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- simplebar css-->
    <link href="{{ asset('backend') }}/assets/vendor/simplebar/simplebar.css" rel="stylesheet" type="text/css">
    <!-- Data Table css-->
    <link href="{{ asset('backend') }}/assets/vendor/datatable/jquery.dataTables.min.css" rel="stylesheet"
        type="text/css">

    <!-- App css-->
    <link href="{{ asset('backend') }}/assets/css/style.css" rel="stylesheet" type="text/css">



    <!-- Responsive css-->
    <link href="{{ asset('backend/assets/css/responsive.css') }}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.22.3/sweetalert2.css" />
</head>

<body>
    <div class="app-wrapper">

        <div class="loader-wrapper">
            <div class="loader_24"></div>
        </div>

        <!-- Menu Navigation starts -->
        @include('backend.layouts.navbar')
        <!-- Menu Navigation ends -->

        <div class="app-content">
            <div class="">

                <!-- Header Section starts -->
                @include('backend.layouts.header')
                <!-- Header Section ends -->


                @yield('content')

            </div>
        </div>
        <!-- Body main section ends -->


        @include('backend.layouts.footer')
        <!-- Footer Section ends-->
    </div>


    <!--customizer-->
    <div id="customizer"></div>

    <!-- latest jquery-->
    <script src="{{ asset('backend') }}/assets/js/jquery-3.6.3.min.js"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('backend') }}/assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>

    <!-- Simple bar js-->
    <script src="{{ asset('backend') }}/assets/vendor/simplebar/simplebar.js"></script>
    <!-- data table js -->
    <script src="{{ asset('backend') }}/assets/vendor/datatable/jquery.dataTables.min.js"></script><!-- js-->
    <script src="{{ asset('backend') }}/assets/js/data_table.js"></script>
    <!-- phosphor js -->
    <script src="{{ asset('backend') }}/assets/vendor/phosphor/phosphor.js"></script>

    <!-- Glight js -->
    <script src="{{ asset('backend') }}/assets/vendor/glightbox/glightbox.min.js"></script>

    <!-- apexcharts-->
    <script src="{{ asset('backend') }}/assets/vendor/apexcharts/apexcharts.min.js"></script>

    <!-- Customizer js-->
    <script src="{{ asset('backend') }}/assets/js/customizer.js"></script>

    <!-- Ecommerce js-->
    <script src="{{ asset('backend') }}/assets/js/ecommerce_dashboard.js"></script>

    <!-- App js-->
    <script src="{{ asset('backend') }}/assets/js/script.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            var toastrOptions = {
                positionClass: 'toast-top-right',
                progressBar: true,
                timeOut: 3000,
            };
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}", '', toastrOptions);
                    break;

                case 'success':
                    toastr.success("{{ Session::get('message') }}", '', toastrOptions);
                    break;

                case 'warning':
                    toastr.warning("{{ Session::get('message') }}", '', toastrOptions);
                    break;

                case 'error':
                    toastr.error("{{ Session::get('message') }}", '', toastrOptions);
                    break;
            }
        @endif
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.closest('form').submit();
                        }
                    });
                });
            });
        });
    </script>

</body>



</html>

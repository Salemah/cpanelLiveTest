<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr"
    data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template" data-style="light">


<!-- Mirrored from demos.pixinvent.com/vuexy-html-admin-template/html/vertical-menu-template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 30 Sep 2024 16:50:48 GMT -->

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - My Arc</title>

    <meta name="description" content="Start your development with a Dashboard for Bootstrap 5" />
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://1.envato.market/vuexy_admin">



    <!-- ? PROD Only: Google Tag Manager (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                '../../../../www.googletagmanager.com/gtm5445.html?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5J3LMKC');
    </script>
    <!-- End Google Tag Manager -->

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon"
        href="https://demos.pixinvent.com/vuexy-html-admin-template/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;ampdisplay=swap"
        rel="stylesheet">

    @include('backend.layouts.style')
    @yield('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .dropify-wrapper .dropify-message p {
            font-size: initial;

        }

        table thead tr {
            background-color: #7367f0 !important;
            box-shadow: 0px 2px 6px 0px rgba(115, 103, 240, .48);
            color: #fff !important;
            height: 20px;
        }

        table thead tr th {

            color: #fff !important;

        }
    </style>
</head>

<body>


    <!-- ?PROD Only: Google Tag Manager (noscript) (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J3LMKC" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">

            <!-- Menu -->

            @include('backend.layouts.sidebar')
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                @include('backend.layouts.topbar')

                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    <!-- / Content -->
                    <!-- Footer -->
                    @include('backend.layouts.footer')
                    <!-- / Footer -->
                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>

    </div>
    <!-- / Layout wrapper -->



    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    @include('backend.layouts.script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function(xhr, status) {
                    removeErrorMessages();
                },
                beforeSubmit: function(formData, jqForm, options) {
                    loadingButton(jqForm.find("button[type=submit]"), 'loading');
                }
            });
            $('.dropify').dropify();

            function IDGenerator(value = 10) {

                this.length = value;
                this.timestamp = +new Date;

                var _getRandomInt = function(min, max) {
                    return Math.floor(Math.random() * (max - min + 1)) + min;
                }

                this.generate = function() {
                    var ts = this.timestamp.toString();
                    var parts = ts.split("").reverse();
                    var id = "";

                    for (var i = 0; i < this.length; ++i) {
                        var index = _getRandomInt(0, parts.length - 1);
                        id += parts[index];
                    }

                    return id;
                }
            }

     tinymce.init({

            selector: '.ckeditor',

            height: 300,

            menubar: false,

            plugins: [

                'advlist autolink lists link image charmap print preview anchor',

                'searchreplace visualblocks code fullscreen',

                'insertdatetime media table paste code help wordcount', 'image'

            ],

            toolbar: 'undo redo | formatselect | ' +

                'bold italic backcolor | alignleft aligncenter ' +

                'alignright alignjustify | bullist numlist outdent indent | ' +

                'removeformat | help',

            content_css: '//www.tiny.cloud/css/codepen.min.css'

        });


        });
        formBeforeSend = function(xhr, status, o) {
            removeErrorMessages();
        };

        formBeforeSubmit = function(formData, jqForm, options) {
            // loadingButton(jqForm.find("button[type=submit]"), 'loading');
        };

        $(document).on("click", "button[type=submit]", function() {
            $(this).addClass('active');
        });

        loadingButton = function(button, loadingText) {
            button.data("original-content", button.html())
                .text(loadingText)
                .addClass("disabled")
                .attr('disabled', "disabled");

        };

        removeLoadingButton = function(button) {
            button.html(button.data("original-content"))
                .removeClass("disabled")
                .removeAttr("disabled")
                .removeAttr("rel");
        };



        formError = function(xhr, status, error, $form) {

            var obj = JSON.parse(xhr.responseText);
            swal.fire({
                title: "Errors!",
                text: obj.message,
                icon: "error"
            });

            removeLoadingButton($form.find("button[type=submit]"));

            $.each(obj.errors, function(key, error) {
                if (document.getElementById(key)) {
                    if ($form.find(":input[id=" + key + "]")) {
                        displayErrorMessage($form.find(":input[id=" + key + "]"), error[0]);
                    } else if ($form.find(":select[id=" + key + "]")) {
                        displayErrorMessage($form.find(":select[id=" + key + "]"), error[0]);
                    } else if ($form.find(":textarea[id=" + key + "]")) {
                        displayErrorMessage($form.find(":textarea[id=" + key + "]"), error[0]);
                    }
                } else {
                    if ($form.find(":input[name=" + key + "]")) {
                        displayErrorMessage($form.find(":input[name=" + key + "]"), error[0]);
                    } else if ($form.find(":select[name=" + key + "]")) {
                        displayErrorMessage($form.find(":select[name=" + key + "]"), error[0]);
                    } else if ($form.find(":textarea[name=" + key + "]")) {
                        displayErrorMessage($form.find(":textarea[name=" + key + "]"), error[
                            0]);
                    }
                }
            });
        };


        formSuccess = function(responseText, statusText, xhr, $form) {
            // swal({
            //     title: "Success",
            //     text: responseText.message,
            //     icon: "success"
            // });
            toastr.success(responseText.message, 'Success', {
                closeButton: true,
                progressBar: true,
                timeOut: 5000, // Time in milliseconds (5 seconds)
                positionClass: "toast-top-right" // Position of the toast
            });
            removeLoadingButton($form.find("button[type=submit]"));
        };


        removeErrorMessages = function() {
            $("form input").removeClass('form-control-danger').removeClass('form-control-success');
            $(".form-control-feedback").remove();
        };

        displayErrorMessage = function(element, message) {
            element.addClass('form-control-danger').removeClass('form-control-success');
            if (typeof message !== "undefined") {
                element.after(
                    $("<div class='form-control-feedback'>" + message + "</div>")
                );
            }
        };
    </script>
    @yield('script')


</body>


<!-- Mirrored from demos.pixinvent.com/vuexy-html-admin-template/html/vertical-menu-template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 30 Sep 2024 16:50:48 GMT -->

</html>

<!-- beautify ignore:end -->

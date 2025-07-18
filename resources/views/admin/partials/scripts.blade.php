 <!-- jQuery  -->
 <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
 <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('assets/js/metismenu.min.js') }}"></script>
 <script src="{{ asset('assets/js/waves.js') }}"></script>
 <script src="{{ asset('assets/js/feather.min.js') }}"></script>
 <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
 <script src="{{ asset('assets/js/moment.js') }}"></script>
 <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
 <script src="{{ asset('assets/plugins/apex-charts/apexcharts.min.js') }}"></script>
 <script src="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
 <script src="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-us-aea-en.js') }}"></script>
 <script src="{{ asset('assets/pages/jquery.analytics_dashboard.init.js') }}"></script>
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/i18n/ar.js"></script>

 <!-- Tom Select JS -->
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

 <!-- App js -->
 <script src="{{ asset('assets/js/app.js') }}"></script>
 <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
 @stack('scripts')

 <script>
        $(document).ready(function () {
            // prevent default form enter
            $('form').on('keypress', function (e) {
                if (e.which === 13) {
                    e.preventDefault();
                }
            });
            // submit form on f12
            $('form').on('keypress', function (e) {
                if (e.which === 123) {
                    e.preventDefault();
                    $('form').submit();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {

            $('.frst').first().focus();
            $(document).on('keydown', function (e) {
                if (e.key === "F1") {
                    e.preventDefault(); // منع المساعدة الافتراضية للمتصفح
                    $('.frst').first().focus();
                }
            });

            $('input[type="number"]').on('focus', function () {
                $(this).select(); // تحديد المحتوى عند التركيز
            });

            $('input[type="number"]').on('blur', function () {
                let val = parseFloat($(this).val());
                if (!isNaN(val)) {
                    $(this).val(val.toFixed(3)); // تنسيق لمنزلتين عشريتين
                }
            });
        });
    </script>
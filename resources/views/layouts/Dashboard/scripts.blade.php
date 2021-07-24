<!-- Argon Scripts -->
<!-- Core -->
<script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/vendor/js-cookie/js.cookie.js"></script>
<script src="/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Custom JS -->
<script src="/assets/js/sidebar.js"></script>
@if(Route::currentRouteName() == 'createUser' or Route::currentRouteName() == 'editUser')
<script src="/assets/js/addUser.js"></script>
@endif
@if(Route::currentRouteName() == 'createPriority')
    <script src="/assets/js/priority.js"></script>
@endif
@if( Route::currentRouteName() == 'customerDashboard' )
<!-- Optional JS -->
<script src="/assets/vendor/chart.js/dist/Chart.min.js"></script>
<script src="/assets/vendor/chart.js/dist/Chart.extension.js"></script>
@endif
<!-- Argon JS -->
<script src="/assets/js/argon.min.js?v=1.2.0"></script>
@if( Route::currentRouteName() == 'customerDashboard' )
    <script>
        var $chart = $('#chart-bars');
        function initChart($chart) {

            // Create chart
            var ordersChart = new Chart($chart, {
                type: 'bar',
                data: {
                    labels: [12,11,10,9,8,7],
                    datasets: [{
                        label: 'tickets',
                        data: [1,0,0,0,0,0]
                    }]
                }
            });

            // Save to jQuery object
            $chart.data('chart', ordersChart);
        }


        // Init chart
        if ($chart.length) {
            initChart($chart);
        }
    </script>
@endif


</body>

</html>

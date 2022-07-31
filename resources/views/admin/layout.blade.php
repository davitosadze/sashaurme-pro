

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <title>SASHAURME GHRELIN - ადმინპანელი</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('admin/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Menu CSS -->
    

    <script src="{{asset('admin/local_js/jquery.min.js')}}"></script>


    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"> --}}

    <link href="{{asset('admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css')}}" rel="stylesheet">
    <!-- toast CSS -->
    <link href="{{asset('admin/plugins/bower_components/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
    <!-- morris CSS -->
    <link href="{{asset('admin/plugins/bower_components/morrisjs/morris.css')}}" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="{{asset('admin/plugins/bower_components/chartist-js/dist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css')}}" rel="stylesheet">
    <!-- animation CSS -->
    <link href="{{asset('admin/css/animate.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet">

    <link href="{{asset('admin/local_css/bpg-glaho-traditional.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin/local_css/jquery.dataTables.min.css')}}">

    <link rel="stylesheet" href="//cdn.web-fonts.ge/fonts/bpg-glaho-traditional/css/bpg-glaho-traditional.min.css">

    <!-- color CSS -->
    <link href="{{asset('admin/css/colors/default.css')}}" id="theme" rel="stylesheet">
 
</head>

<style>
    body {
        font-family: "BPG Glaho Traditional", sans-serif;

    }
</style>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
 
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
           
            <div class="sidebar-nav slimscrollsidebar">
 
                <ul class="nav" id="side-menu">
                    
                    <li style="padding: 110px 0 0;">
                        <a href="/back/dashboard" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>მთავარი</a>
                    </li>
                    <li>
                        <a href="/back/categories" class="waves-effect"><i class="fa fa-money fa-fw" aria-hidden="true"></i>კატეგორიები</a>
                    </li>
                    <li>
                        <a href="/back/products" class="waves-effect"><i class="fa fa-user fa-fw" aria-hidden="true"></i>პროდუქტები</a>
                    </li>
                    <li>
                        <a href="/back/sproducts" class="waves-effect"><i class="fa fa-font fa-fw" aria-hidden="true"></i>საწყობის პროდუქტები</a>
                    </li>

                    <li>
                        <a href="/back/migeba" class="waves-effect"><i class="fa fa-bitcoin fa-fw" aria-hidden="true"></i>საწყობი</a>
                    </li>

                    <li>
                        <a href="/back/nisia" class="waves-effect"><i class="fa fa-bitcoin fa-fw" aria-hidden="true"></i>ნისია</a>
                    </li>

                    <li>
                        <a href="/back/ageba" class="waves-effect"><i class="fa fa-globe fa-fw" aria-hidden="true"></i>ხორცის აგება</a>
                    </li>

                    <li>
                        <a href="/back/xorcisxarji" class="waves-effect"><i class="fa fa-globe fa-fw" aria-hidden="true"></i>ხორცის ხარჯი</a>
                    </li>

                    <li>
                        <a href="/back/xarji" class="waves-effect"><i class="fa fa-globe fa-fw" aria-hidden="true"></i>დამატებითი ხარჯი</a>
                    </li>

                    <li>
                        <a href="/back/archive" class="waves-effect"><i class="fa fa-globe fa-fw" aria-hidden="true"></i>არქივი</a>
                    </li>



                    <li>
                        <a href="/back/logout" class="waves-effect"><i class="fa fa-toggle-left  fa-fw" aria-hidden="true"></i>გამოსვლა</a>
                    </li>

                </ul>
 
            </div>
            
        </div>

    <div id="page-wrapper">

        @yield('content')

        <footer class="footer text-center"> 2021 &copy; SASHAURME LITE </footer>
    </div>
    <!-- ============================================================== -->
    <!-- End Page Content -->
    <!-- ============================================================== -->
</div>

<style>

h3.box-title {
    font-family: 'BPG Glaho Traditional';
}

td {
    color: black;
    font-size: larger;
}

    .white-box {
    background: #fff;
    border: 2px solid;
    border-radius: 10px;
     padding: 25px;
    margin-bottom: 30px;
}

.bg-title h4 {
    text-transform: uppercase;
    font-size: 14px;
    font-weight: 500;
    font-family: 'BPG Glaho Traditional';
    margin-top: 6px;
    font-weight: bold;
    font-size: 20px;
}

</style>

<script src="{{asset('admin/plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{asset('admin/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Menu Plugin JavaScript -->
<script src="{{asset('admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js')}}"></script>
<!--slimscroll JavaScript -->
<script src="{{asset('admin/js/jquery.slimscroll.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset('admin/js/waves.js')}}"></script>
<!--Counter js -->
<script src="{{asset('admin/plugins/bower_components/waypoints/lib/jquery.waypoints.js')}}"></script>
<script src="{{asset('admin/plugins/bower_components/counterup/jquery.counterup.min.js')}}"></script>
<!-- chartist chart -->
<script src="{{asset('admin/plugins/bower_components/chartist-js/dist/chartist.min.js')}}"></script>
<script src="{{asset('admin/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js')}}"></script>
<!-- Sparkline chart JavaScript -->
<script src="{{asset('admin/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{asset('admin/js/custom.min.js')}}"></script>
{{-- <script src="{{asset('admin/js/dashboard1.js')}}"></script> --}}
<script src="{{asset('admin/plugins/bower_components/toast-master/js/jquery.toast.js')}}"></script>

<script src="{{asset('admin/local_js/jquery.dataTables.min.js')}}"></script>



</body>




</html>

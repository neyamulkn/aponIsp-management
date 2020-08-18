@yield('css-top')
<link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

@yield('css')
<style type="text/css">
    #loading
    {
        width: 100%;
        height: 20px;
        text-align:center; 
        background: url('{{ asset("assets/images/loader.gif")}}') no-repeat center; 
    }
    .container-fluid { padding: 0 10px !important; }
    .sidebar-nav ul li a:hover {background: #343a400a}
    .switch-box{top: -12px !important}
</style>
   
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

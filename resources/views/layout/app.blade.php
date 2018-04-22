<!DOCTYPE html>

<html lang="en" class="no-js">
<!-- BEGIN HEAD -->
<head>
    @include('partials._head')
    @include('partials._styles')
</head>
<!-- END HEAD -->

<!-- BODY -->
<body id="body" data-spy="scroll" data-target=".header">

<!--========== HEADER ==========-->
<header class="header navbar-fixed-top">
    <!-- Navbar -->
    @include('partials._nav')
    <!-- Navbar -->
</header>
<!--========== END HEADER ==========-->

<!--========== PAGE LAYOUT ==========-->
@yield('content')
<!--========== END PAGE LAYOUT ==========-->
<div style="position: relative;right: 0;bottom: 0;left: 0;padding: 1rem;text-align: center;background: #fafafa">
    <div>
        <p style="color: #c4c4c4; font-size: 12px; margin-bottom: 0;">Created and Designed by</p>
        <a href="http://mazeyar.nl"><img src="http://mazeyar.nl/images/logo.png" alt="Mazeyar Rezaei Ghavamabadi"></a>
    </div>
</div>
@include('partials._scripts')

@if (!App::isLocal())
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-96990724-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-96990724-3');
    </script>

@endif

<script>
    if ($(window).width() < 1000) {
        $('#responsieve-logo').show();
        $('#original-logo').hide();
    }
    else {
        $('#responsieve-logo').hide();
        $('#original-logo').show();
    }
</script>
</body>
<!-- END BODY -->
</html>

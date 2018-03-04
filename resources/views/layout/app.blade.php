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
    if ($(window).width() < 960) {
        $('#responsieve-logo').show();
    }
    else {
        $('#responsieve-logo').hide();
    }
</script>
</body>
<!-- END BODY -->
</html>

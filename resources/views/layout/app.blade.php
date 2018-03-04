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

</body>
<!-- END BODY -->
</html>

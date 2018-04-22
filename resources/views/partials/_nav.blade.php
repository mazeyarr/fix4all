<nav class="navbar" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="menu-container js_nav-item">
            <a id="responsieve-logo" href="{{ route('home') }}" style="display: none; position: absolute;"><img src="{{ asset('img/Logo4@0,5x.png') }}" alt="Fix4all logo" style="margin-top: 10px;"></a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="toggle-icon"></span>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse nav-collapse">
            <div class="menu-container">
                <a id="original-logo" href="{{ route('home') }}"><img src="{{ asset('img/LogoBlack@0,5x.png') }}" alt="Fix4all logo" style="margin-top: 10px;"></a>
                <ul class="nav navbar-nav navbar-nav-right">
                    <li class="js_nav-item nav-item"><a class="nav-item-child nav-item-hover" href="#body">Home</a></li>
                    <li class="js_nav-item nav-item"><a class="nav-item-child nav-item-hover" href="#work">Recente Opdrachten</a></li>
                    <li class="js_nav-item nav-item"><a class="nav-item-child nav-item-hover" href="#about">Over Fix4all</a></li>
                    <li class="js_nav-item nav-item"><a class="nav-item-child nav-item-hover" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
        <!-- End Navbar Collapse -->
    </div>
</nav>
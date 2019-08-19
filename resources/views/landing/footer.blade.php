<footer class="container-fluid">
    <div class="container">
        <div class="row justify-content-center">
            <div class="logo offset-1 col-md-1">
                <img class="logo-white img-thumbnail" src="{{asset('images/logo-white.svg')}}" alt="logo-white">
            </div>

            @include('landing.partials.footer.about')

            @include('landing.partials.footer.menu-items')

            @include('landing.partials.footer.social')

        </div>
    </div>
</footer>

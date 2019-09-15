<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Landing</title>

        <!-- Fonts -->
        <link href="{{ asset('css/landing.css') }}" rel="stylesheet"/>

    </head>
    <body>

        <nav class="container-fluid">
            <div class="nav-brand container">
                <a title="landing" href="#">
                    <img src="../images/logo.svg"/>
                </a>
            </div>
        </nav>

        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <div class="main-message col-6">
                    <h1 class="display-4 font-weight-bold">Fast and simple, Unsecured funding.</h1>
                    <p class="col-lg-5 col-xl-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                    <button class="btn font-weight-bolder text-uppercase pr-5 pl-5">apply now</button>
                    <p class="col-lg-5 col-xl-5 font-weight-light text-small">Applying doesn’t affect your credit score, and there’s no obligation to accept funding.</p>
                </div>
            </div>

        </div>

        <footer>

        </footer>


    </body>
</html>

<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Landing</title>

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
            <div class="container mt-5">
                <div class="main-message col-6">
                    <h1 class="display-4 font-weight-bold pt-5">Fast and simple, Unsecured funding.</h1>
                    <p class="col-lg-5 col-xl-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                    <button class="btn bg-secondary font-weight-bolder text-uppercase pr-5 pl-5">apply now</button>
                    <p class="col-lg-5 col-xl-5 font-weight-light text-small">Applying doesn’t affect your credit score, and there’s no obligation to accept funding.</p>
                </div>
            </div>
        </div>

        <div class="container subscription">
            <div class="row">
                <h2 class="offset-1 col-5 font-weight-bold">Getting <span class="text-secondary">capital</span> for your business is complicated</h2>
                <p class="col-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
        </div>

        <footer>

        </footer>
    </body>
</html>

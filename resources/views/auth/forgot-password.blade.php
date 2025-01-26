<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <title>Maszek | Jelszó helyreállítás</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['../../resources/css/app.css', 'resources/js/app.js',])
        @endif
    </head>
    <body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-offset="71">
        <!-- Start Navbar -->
        <nav class="navbar navbar-expand-lg fixed-top navbar-white navbar-custom sticky" id="navbar">
            <div class="container-lg">

                <!-- LOGO -->
                <a class="navbar-brand text-uppercase" href={{route('home')}}>
                    <img src="images/maszek-logo.png" alt="" height="30" >
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi bi-list"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mx-auto" id="navbar-navlist">
                        <li class="nav-item">
                            <a class="nav-link" href={{route('home')}}>Főoldal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Kapcsolat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Rólunk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Elérhető munkák</a>
                        </li>


                    </ul>
                 <div class="d-flex align-items-center">
                    <div class="me-5 flex-shrink-0 d-none d-lg-block">
                        <a class="btn btn-primary nav-btn" href="{{ route('login') }}">
                            Bejelentkezés
                        </a>
                    </div>
                </div>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <!-- Start Reset -->
        <section class="" id="forgot-password">
            <div class="container-lg">
                <div class="container-lg mt-5">
                    <div class="row justify-content-center mt-5">
                        <img src="images/login-pic.png" alt="" height="400" style="width: 700px;">
                    </div>

                </div>
                <div class="row justify-content-around">
                    <div class="col-lg-8">
                        <form method="POST" class="contact-form" action="{{ route('password.email') }}">
                            @csrf
                            <div class="text-center mb-4 text-muted">
                                <h3 class="heading">Elfelejtetted a jelszavad?</h3>
                                <p class="mx-5"> Semmi gond. Add meg az email címed, és küldünk egy jelszó visszaállító linket, amivel új jelszót adhatsz meg.</p>
                            </div>
                            <div class="row">
                                <!-- Email -->
                                @if ($errors->has('email'))
                                <div class="text-danger mb-2">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                                <div class="col-lg-12">
                                    <div class="position-relative mb-3">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input name="email" id="email" type="email" class="form-control" placeholder="Email Cím" value="{{ old('email') }}" required autofocus>

                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-12 d-flex justify-content-center flex-column align-items-center">
                                    <button type="submit" class="btn btn-primary mx-2">Jelszó visszaállító link küldése</button>
                                    <p class="text-muted mt-3"> Vissza a <a href="{{ route('login') }}" class="text-primary">Bejelentkezéshez</a></p>
                                </div>
                            </div>
                        </form>
                        <!--end form-->
                    </div>
                </div>

        </section>
        <!-- End Reset -->
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <title>Maszek | Állás, vagy akár alkalmi munka? Itt mindent megtalálsz!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['../../resources/css/app.css', 'resources/js/app.js',])
        @endif
    </head>
    <body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-offset="71">

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
                            <a class="nav-link active" href={{route('home')}}>Főoldal</a>
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
        <!-- End Navbar -->
        <div class="container-lg mt-5">
            <div class="row justify-content-center mt-5">
                <img src="images/login-pic.png" alt="" height="400" style="width: 700px;">
            </div>

        </div>
         <!-- Start Login -->
         <section id="login">
            <div class="container-lg">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-5">
                            <h3 class="heading">Bejelentkezés</h3>
                            <p class="text-muted mt-2">Lépj be a fiókodba a felhasználónév és jelszó segítségével.</p>
                            <p class="text-muted mt-2"> Nincs még fiókod? <a href="{{ route('register') }}" class="text-primary">Regisztráció</a></p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-around">
                    <div class="col-lg-8">
                        <form method="post" class="contact-form" action="{{ route('login') }}">
                            @csrf
                            <span id="error-msg"></span>
                            <div class="row">
                                <!-- email -->
                                <div class="col-lg-12">
                                    <div class="position-relative mb-3">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input name="email" id="email" type="text" class="form-control" placeholder="Email Cím" required autofocus>
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="col-lg-12">
                                    <div class="position-relative mb-3">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input name="password" id="password" type="password" class="form-control" placeholder="Jelszó" required>
                                    </div>
                                </div>

                                <!-- Remember Me -->
                                <div class="col-lg-12">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                        <label class="form-check-label" for="remember">
                                            Emlékezz rám
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-lg-12 d-flex justify-content-center ">
                                    <button type="submit" class="btn btn-primary mx-2">Bejelentkezés</button>
                                </div>
                            </div>
                        </form>
                        <!--end form-->
                    </div>
                </div>
                <!--end row-->
            </div>
            <!--end container-->
        </section>
        <!-- end Login -->

        <!-- end Login -->



    </body>
</html>

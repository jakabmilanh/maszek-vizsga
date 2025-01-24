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

         <!-- Start registation -->

         <section id="registration">
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
                            <h3 class="heading">Regisztráció</h3>
                            <p class="text-muted mt-2">Töltsd ki az alábbi adatokat a regisztrációhoz, és csatlakozz a platformunkhoz!</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-around">
                    <div class="col-lg-8">
                        <form method="post" class="contact-form" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf
                            <span id="error-msg"></span>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="position-relative mb-3">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input name="username" id="username" type="text" class="form-control" placeholder="Felhasználónév" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="position-relative mb-3">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input name="email" id="email" type="email" class="form-control" placeholder="Email cím" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="position-relative mb-3">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input name="password" id="password" type="password" class="form-control" placeholder="Jelszó" required>
                                    </div>
                                </div>
                                    <div class="col-lg-6">
                                        <div class="position-relative mb-3">
                                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                            <input name="password_confirmation" id="password_confirmation" type="password" class="form-control" placeholder="Jelszó megerősítése" required>
                                        </div>
                                    </div>
                                <div class="col-lg-12">
                                    <div class="position-relative mb-3">
                                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                        <input name="telephone" id="telephone" type="text" class="form-control" placeholder="Telefonszám" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="position-relative">
                                        <h6 class="text-muted text-center"> Az alábbi mezőben adja meg a profilképét, amennyiben nem teszi egy általunk beállított profilképe lesz.</h6>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="position-relative">
                                        <h6 class="text-muted text-center"> Az alábbi mezőben megadhatja a szakmáját, vagy bármilyen végezttségét igazoló dokumentumot.</h6>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="position-relative mb-3">
                                        <span class="input-group-text"><i class="bi bi-camera"></i></span>
                                        <input name="profile_picture" id="profile_picture" type="file" class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="position-relative mb-3">
                                        <span class="input-group-text"><i class="bi bi-images"></i></span>
                                        <input name="profession_pictures[]" id="profession_pictures" type="file" class="form-control" multiple>
                                    </div>
                                </div>
                                 <div class="col-lg-12">
                                    <div class="position-relative mb-3">
                                        <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                                        <select name="role" id="role" class="form-select" style="padding-left: 60px" required>
                                            <option value="employer" >Munkavállaló</option>
                                            <option value="employee" >Munkáltató</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="position-relative mb-3">
                                        <span class="input-group-text"><i class="bi bi-pencil"></i></span>
                                        <textarea name="bio" id="bio" rows="4" class="form-control" placeholder="Rövid bemutatkozó" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-primary">Regisztrálás</button>
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
        <!-- end Registration -->

        <!-- end Login -->



    </body>
</html>

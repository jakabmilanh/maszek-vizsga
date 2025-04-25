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
        <!-- End Navbar -->
        <div class="container-lg mt-5">
            <div class="row justify-content-center mt-5">
                <img src="images/login-pic.png" alt="" height="400" style="width: 700px;">
            </div>

        </div>

         <!-- Start registation -->

         <section id="registration">
            <div class="container-lg">

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
                                            <option value="Munkavállaló" >Munkavállaló</option>
                                            <option value="Munkáltató" >Munkáltató</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="position-relative mb-3">
                                        <span class="input-group-text align-items-start"><i class="bi bi-pencil"></i></span>
                                        <textarea name="bio" id="bio" rows="4" class="form-control" placeholder="Rövid bemutatkozó" required></textarea>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->any())
                                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                                            <i class="bi bi-bug-fill" style="margin-right: 5px"></i>
                                            <div>
                                                Hiba lépett fel a regisztráció közben. Kérjük, ellenőrizze az adatokat.
                                            </div>
                                        </div>
                                    @endif
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
        <!-- START FOOTER -->
        <footer class="section bg-footer mt-5">
            <div class="container-lg">
                <div class="row g-sm-4">
                    <div class="col-lg-12">
                        <div class="mb-3 mb-sm-0">
                            <img src="{{asset('images/maszek-logo.png')}}" class="logo-dark" alt="" height="22">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <h6 class="text-uppercase fw-semibold">Rólunk</h6>
                        <ul class="list-unstyled footer-link mt-3 mb-0 ">
                            <li><a href="javascript:void(0)">Rólunk</a></li>
                            <li><a href="javascript:void(0)">Instagram</a></li>
                            <li><a href="javascript:void(0)">Facebook</a></li>
                            <li><a href="javascript:void(0)">Twitter X</a></li>
                        </ul>
                    </div><!-- End col -->

                    <div class="col-lg-3 col-md-4 col-6">
                        <h6 class="text-uppercase fw-semibold">Munkakezdés</h6>
                        <ul class="list-unstyled footer-link mt-3 mb-0 ">
                            <li><a href="javascript:void(0)">Bevezetés</a></li>
                            <li><a href="javascript:void(0)">Regisztráció</a></li>
                            <li><a href="javascript:void(0)">Munkák</a></li>

                        </ul>
                    </div><!-- End col -->

                    <div class="col-lg-3 col-md-4 col-6 d-none d-sm-block">
                        <h6 class="text-uppercase fw-semibold">Anyagok</h6>
                        <ul class="list-unstyled footer-link mt-3 mb-0 ">
                            <li><a href="javascript:void(0)">Videók</a></li>
                            <li><a href="javascript:void(0)">Képek</a></li>
                            <li><a href="javascript:void(0)">ÁSZF</a></li>
                            <li><a href="javascript:void(0)">GDPR</a></li>
                        </ul>
                    </div><!-- End col -->
                    <div class="col-lg-3 col-10">
                        <h6 class="text-uppercase fw-semibold">Hírlevél
                            <span class="text-primary text-uppercase ">MASZEK</span></h6>
                            <p class="mt-md-3 pt-3 pt-md-2 ">Iratkozzon  fel hírlevelünkre, még ma!</p>
                        <div class="footer-subcribe text-end shadow-sm d-inline-block">
                            <form action="javascript:void(0)">
                                <input placeholder="Email cím" type="email">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-bell"></i></button>
                            </form>
                        </div>
                            <div class="mt-md-4 mt-3">
                                <ul class="list-inline footer-social mb-0">
                                    <li class="list-inline-item">
                                        <a href="javascript:void(0)" class="rounded">
                                            <i class="mdi mdi-facebook text-dark"></i>
                                        </a>
                                    </li>

                                    <li class="list-inline-item">
                                        <a href="javascript:void(0)" class="rounded">
                                            <i class="mdi mdi-linkedin text-dark"></i>
                                        </a>
                                    </li>

                                    <li class="list-inline-item">
                                        <a href="javascript:void(0)" class="rounded">
                                            <i class="mdi mdi-pinterest text-dark"></i>
                                        </a>
                                    </li>

                                    <li class="list-inline-item">
                                        <a href="javascript:void(0)" class="rounded">
                                            <i class="mdi mdi-twitter text-dark"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                    </div>
                </div><!-- End row -->
            </div><!-- End container -->
        </footer>
        <!-- END FOOTER -->

        <!-- FOOTER-ALT -->
        <div class="footer-alt pt-3 pb-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-white">©
                                <script>document.write(new Date().getFullYear())</script> MASZEK | Minden jog fenntartva.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END FOOTER-ALT -->



    </body>
</html>

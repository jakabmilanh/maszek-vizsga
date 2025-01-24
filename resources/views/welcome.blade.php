<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <title>Maszek | Állás, vagy akár alkalmi munka? Itt mindent megtalálsz!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js',])
        @endif
    </head>
    <body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-offset="71">

        <nav class="navbar navbar-expand-lg fixed-top navbar-white navbar-custom sticky" id="navbar">
            <div class="container-lg">

                <!-- LOGO -->
                <a class="navbar-brand text-uppercase">
                    <img src="images/maszek-logo.png" alt="" height="30">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    O
                </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mx-auto" id="navbar-navlist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#home">Főoldal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Rólunk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Elérhető munkák</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Kapcsolat</a>
                        </li>

                    </ul>
                 <div class="d-flex align-items-center">
                    <div class="me-5 flex-shrink-0 d-none d-lg-block">
                        <a class="btn btn-primary nav-btn" href="javascript:void(0)">
                            Bejelentkezés
                        </a>
                    </div>
                </div>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        <!-- Start Dashboard -->
        <section class="section-home home" id="home">
            <div class="container-lg">
                <div class="row align-items-center mt-5 mt-lg-0">
                    <div class="col-lg-6">
                        <div class="home-heading">
                            <p class="text-muted">Fedezd fel Magyarország legjobb álláslehetőségeit és szabadúszó megbízásait egy helyen! </p>
                            <h1 class="lh-sm">Üdvözlünk a <span class="text-primary"> Maszekon!</span></h1>
                            <p><br>
                                Akár új karrierútra lépnél, akár szabadúszóként keresel projekteket, a Maszek segít összekapcsolni a tehetségeket a megfelelő munkáltatókkal.
                                Nálunk egyszerűen és gyorsan találhatod meg az álommunkádat vagy a következő nagy kihívásodat.</p>
                        </div>
                        <div class="home-btn">
                            <a class="btn btn-outline-primary rounded-pill" href="">Tudj meg többet!
                            </a>
                            <a class="btn btn-outline-primary rounded-pill" href="">Munkát keresek!
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ms-md-4">
                            <img class="home-img" src="images/home.jpg" alt="" height="500">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Dashboard -->

         <!-- START Role -->
         <section class="section role" id="role">
            <div class="bg-shape"></div>
            <div class="container-lg">
                <div class="row gy-5 justify-content-center">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <h3 class="heading">Válaszd ki, hogyan szeretnéd használni a Maszek platformot!</h3>
                            <p class="text-muted">Regisztrálj most, és kutass állás, vagy akár alkalmi munka után.</p>
                        </div>
                    </div><!-- End col -->
                    <div class="col-lg-6 col-md-6">
                        <div class="card role-box border-light h-100 py-5 mx-1">
                            <div class="pb-4 text-center border-bottom">
                                <h2 class="text-danger">Munkáltatóként</h2>
                                <h4 class="mb-0 p-3 text-muted">Ha állásokat szeretnél közzétenni, és tehetséges munkavállalókat keresel.</h4>
                            </div>
                            <div class="p-4 pb-0">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="bi bi-check-all"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2">
                                                <span><b class="fw-semibold">Gyors és egyszerű álláshirdetés:</b>  Könnyen közzéteheted az állásajánlataidat, és elérheted a megfelelő jelentkezőket.</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="bi bi-check-all"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2">
                                                <span><b class="fw-semibold">Célzott keresés:</b>    Találd meg gyorsan a legjobb jelölteket a szűrők és kategóriák segítségével.</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="bi bi-check-all"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2">
                                                <span><b class="fw-semibold">Rugalmasság:  </b>  Szabadúszókat és teljes munkaidős jelentkezőket is találhatsz egy helyen.</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="mx-auto">
                                <a href="javascript:void(0)" class="btn btn-outline-dark"> Munkáltatóként regisztrálok!</a>
                              </div>
                        </div><!-- End card -->
                    </div>
                    <!-- col end -->
                    <div class="col-lg-6 col-md-6">
                        <div class="card role-box border-light h-100 py-5 mx-1">
                            <div class="pb-4 text-center border-bottom">
                                <h2 class="text-warning">Munkavállalóként</h2>
                                <h4 class="mb-0 p-3 text-muted">Ha új karrierlehetőségeket keresel, vagy szabadúszóként szeretnél projekteken dolgozni.</h4>
                            </div>
                            <div class="p-4 pb-0">
                                <ul class="list-unstyled">
                                    <li>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="bi bi-check-all"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2">
                                                <span><b class="fw-semibold">Széles álláskínálat:</b>  Válogass a különböző iparágakból és szerepkörökből.</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="bi bi-check-all"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2">
                                                <span><b class="fw-semibold">Szabadúszó projektek:</b>   Nem csak munkát, hanem rugalmas projektekre szóló megbízásokat is találhatsz.</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="bi bi-check-all"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2">
                                                <span><b class="fw-semibold">Felhasználóbarát felület: </b>   Könnyen kezelhető platform, ahol gyorsan és egyszerűen pályázhatsz.</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="mx-auto">
                                <a href="javascript:void(0)" class="btn btn-outline-dark"> Munkavállalóként regisztrálok!</a>
                              </div>
                        </div><!-- End card -->
                    </div>
                    <!-- col end -->
                </div><!-- End row -->
            </div><!-- End container -->
        </section>
        <!-- END Role -->





        <!-- start jobs -->
        <section class="bg-jobs w-100">
            <div class="bg-overlay"></div>
            <div class="container-lg">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="text-center">
                            <h3 class="heading">Itt számos pozíció közül választhatsz, legyen szó teljes munkaidős, részmunkaidős vagy szabadúszó lehetőségekről.</h3>
                            <p class="text-muted">Böngéssz a hirdetések között, és találj munkát még ma!</p>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
                <div class="row justify-content-center py-5 gy-5 mx-1">
                    <div class=" card job-box col-lg-3 col-md-5 p-3">
                        <h5>Web Designer / Developer</h5>
                        <p class="job-posted-time">
                            <i class="bi bi-clock icon-color-primary"></i><a class="text-muted job-date"> Meghírdetve 3 napja</a>
                        </p>
                        <div class="row">
                            <div class=" col-md-7">
                               <h6 class="job-schedule-full ">Teljes Munkaidős</h6>
                              </div>
                              <div class="col-md-5 d-flex align-items-start mt-1">
                                <h6 class="mb-0"><i class="bi bi-cash icon-color-primary"></i> 1899Ft/óra</h6>
                            </div>
                        </div>
                        <div class="border-top mt-2">
                            <div class="row job-poster-data">
                                <div class=" col-md-4 justify-content-center d-flex align-items-center border rounded">
                                        <img src="images/facebook.webp" alt="" height="50">
                                  </div>
                                  <div class="col-md-8 mt-1">
                                    <h5>Facebook</h5>
                                    <h6 class="justify-content-start"><i class="bi bi-geo-alt-fill icon-color-primary"></i><a class="text-muted"> Austria</a></h6>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" card job-box col-lg-3 col-md-5 p-3">
                        <h5>Web Designer / Developer</h5>
                        <p class="job-posted-time">
                            <i class="bi bi-clock icon-color-primary"></i><a class="text-muted job-date"> Meghírdetve 3 napja</a>
                        </p>
                        <div class="row">
                            <div class=" col-md-7">
                               <h6 class="job-schedule-full ">Teljes Munkaidős</h6>
                              </div>
                              <div class="col-md-5 d-flex align-items-start mt-1">
                                <h6 class="mb-0"><i class="bi bi-cash icon-color-primary"></i> 1899Ft/óra</h6>
                            </div>
                        </div>
                        <div class="border-top mt-2">
                            <div class="row job-poster-data">
                                <div class=" col-md-4 justify-content-center d-flex align-items-center border rounded">
                                        <img src="images/facebook.webp" alt="" height="50">
                                  </div>
                                  <div class="col-md-8 mt-1">
                                    <h5>Facebook</h5>
                                    <h6 class="justify-content-start"><i class="bi bi-geo-alt-fill icon-color-primary"></i><a class="text-muted"> Austria</a></h6>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" card job-box col-lg-3 col-md-5 p-3">
                        <h5>Web Designer / Developer</h5>
                        <p class="job-posted-time">
                            <i class="bi bi-clock icon-color-primary"></i><a class="text-muted job-date"> Meghírdetve 3 napja</a>
                        </p>
                        <div class="row">
                            <div class=" col-md-7">
                               <h6 class="job-schedule-full ">Teljes Munkaidős</h6>
                              </div>
                              <div class="col-md-5 d-flex align-items-start mt-1">
                                <h6 class="mb-0"><i class="bi bi-cash icon-color-primary"></i> 1899Ft/óra</h6>
                            </div>
                        </div>
                        <div class="border-top mt-2">
                            <div class="row job-poster-data">
                                <div class=" col-md-4 justify-content-center d-flex align-items-center border rounded">
                                        <img src="images/facebook.webp" alt="" height="50">
                                  </div>
                                  <div class="col-md-8 mt-1">
                                    <h5>Facebook</h5>
                                    <h6 class="justify-content-start"><i class="bi bi-geo-alt-fill icon-color-primary"></i><a class="text-muted"> Austria</a></h6>

                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="row">
                    <div class=" d-flex justify-content-center">
                        <a href="javascript:void(0)" class="btn btn-outline-dark">Mutass többet!</a>
                    </div>
            </div>
        </div><!--end container-->
    </section>
        <!-- end jobs -->



        <!-- Start contact -->
        <section class="section" id="contact">
            <div class="container-lg">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-5">
                            <h3 class="heading">Kapcsolatfelvétel / Segítségkérés</h3>
                            <p class="text-muted mt-2">Ha bármilyen kérdésed, problémád vagy kérésed van, ne habozz kapcsolatba lépni velünk! Csapatunk készséggel áll rendelkezésedre, hogy segítse a felmerülő kérdések megoldásában, vagy további információkat nyújtson szolgáltatásainkról.</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-around">
                    <div class="col-lg-8">
                        <form method="post" onsubmit="return validateForm()" class="contact-form" name="myForm" id="myForm">
                            <span id="error-msg"></span>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="position-relative mb-3">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input name="name" id="name" type="text" class="form-control" placeholder="Add meg a neved!">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="position-relative mb-3">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></i></span>
                                        <input name="email" id="email" type="email" class="form-control" placeholder="Add meg az email címed!">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="position-relative mb-3">
                                        <span class="input-group-text"><i class="bi bi-pencil"></i></span>
                                        <input name="subject" id="subject" type="text" class="form-control" placeholder="Tárgy...">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="position-relative mb-3">
                                    <span class="input-group-text align-items-start"><i class="bi bi-chat-left-dots"></i></span>
                                        <textarea name="comments" id="comments" rows="4" class="form-control" placeholder="Üzenet..."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-12 text-center">
                                    <input type="submit" id="submit" name="send" class="btn btn-primary" value="Küldés">
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
        <!-- End contect -->

        <!-- START FOOTER -->
        <footer class="section bg-footer">
            <div class="container-lg">
                <div class="row g-sm-4">
                    <div class="col-lg-12">
                        <div class="mb-3 mb-sm-0">
                            <img src="images/maszek-logo.png" class="logo-dark" alt="" height="22">
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

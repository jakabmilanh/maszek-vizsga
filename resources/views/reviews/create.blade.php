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
                            <a class="nav-link" href={{route('home#kapcsolat')}}>Kapcsolat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Rólunk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href={{route('jobs.search')}}>Elérhető munkák</a>
                        </li>


                    </ul>
                    <div class="d-flex align-items-center">
                        @if (auth()->check())
                        <div class="me-5 d-flex align-items-center">
                            <a href="{{ route('logout') }}" class="text-primary mx-3"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Kijelentkezés
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            <a href="{{ route('profile.edit') }}"><img  src="{{ auth()->user()->profile_picture ?? asset('images/profile_pictures/default.jpg') }}" class="rounded-circle border" width="40" height="40"></a>
                        </div>
                        @else
                            <div class="me-5 flex-shrink-0 d-none d-lg-block">
                                <a class="btn btn-primary nav-btn" href="{{ route('login') }}">
                                    Bejelentkezés
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
         <!-- Start Review -->
         <div class="container-lg section">
             <h2 class="mb-4 section text-primary">Írj egy véleményt</h2>
             <div class="card p-4">
                <form method="POST" action="{{ route('reviews.store', ['job' => $job->job_id, 'user' => $user->id]) }}">
                     @csrf
                     <!-- Hidden fields for job and employer IDs -->
                     <input type="hidden" name="job_id" value="{{ $job->job_id }}">
                     <input type="hidden" name="employer_id" value="{{ $user->id }}">

                     <!-- Rating Field -->
                     <div class="mb-3">
                         <label for="rating" class="form-label">Értékelés</label>
                         <select name="rating" id="rating" class="form-select" required>
                             <option value="">Válassz értékelést</option>
                             <option value="1">1 - Nagyon rossz</option>
                             <option value="2">2 - Rossz</option>
                             <option value="3">3 - Közepes</option>
                             <option value="4">4 - Jó</option>
                             <option value="5">5 - Kiváló</option>
                         </select>
                     </div>

                     <!-- Review Text Field -->
                     <div class="mb-3">
                         <label for="review" class="form-label">Vélemény</label>
                         <textarea name="review_text" id="review" rows="5" class="form-control" placeholder="Írd le a véleményed..." required></textarea>
                     </div>

                     <!-- Submit Button -->
                     <button type="submit" class="btn btn-primary">
                         <i class="bi bi-star"></i> Vélemény elküldése
                     </button>
                 </form>
             </div>
         </div>


          <!-- End Review -->

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

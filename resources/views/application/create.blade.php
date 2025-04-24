<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <title>Maszek | Munka létrehozása</title>
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
                    <img src="{{asset('images/maszek-logo.png')}}" alt="" height="30" >
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
                        <div class="me-5 d-flex align-items-center ">
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

        <!-- START Job Application -->
        <div class="container-lg mt-5 section">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h3 class="mb-0">Jelentkezés: {{ $job->title }}</h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <!-- Job Details Column -->
                                <div class="col-md-6">
                                    <div class="card mb-4">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0">Állás részletei</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <h4 class="mb-3">{{ $job->title }}</h4>

                                                <div class="mb-3">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="bi bi-tag me-2 text-primary"></i>
                                                        <span class="fw-medium">Kategória:</span>
                                                        <span class="ms-2">{{ $job->category }}</span>
                                                    </div>

                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="bi bi-geo-alt me-2 text-primary"></i>
                                                        <span class="fw-medium">Helyszín:</span>
                                                        <span class="ms-2">{{ $job->location }}</span>
                                                    </div>

                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="bi bi-cash me-2 text-primary"></i>
                                                        <span class="fw-medium">Fizetés:</span>
                                                        <span class="ms-2">
                                                            {{ number_format($job->salary, 0, ',', ' ') }} Ft
                                                            @if(in_array($job->category, ['Teljes munkaidős', 'Részmunkaidős', 'Több alkalom']))
                                                                / óra
                                                            @endif
                                                        </span>
                                                    </div>

                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-clock-history me-2 text-primary"></i>
                                                        <span class="fw-medium">Közzétéve:</span>
                                                        <span class="ms-2">{{ $job->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>

                                                <hr class="my-4">

                                                <div class="mb-3">
                                                    <h6 class="mb-2 text-primary">Állásleírás</h6>
                                                    <div class="bg-light p-3 rounded">
                                                        {!! nl2br(e($job->description)) !!}
                                                    </div>
                                                </div>

                                                <div class="mt-4">
                                                    <h6 class="mb-2 text-primary">Státusz</h6>
                                                    <span class="badge bg-{{
                                                        $job->status === 'open' ? 'success' :
                                                        ($job->status === 'in progress' ? 'warning' : 'danger')
                                                    }}">
                                                        {{ $job->status === 'open' ? 'Nyitott' :
                                                          ($job->status === 'in progress' ? 'Folyamatban' : 'Lezárva') }}
                                                    </span>
                                                </div>

                                                @if($job->employer)
                                                <div class="mt-4">
                                                    <h6 class="mb-2 text-primary">Hirdető</h6>
                                                    <a href="{{ route('profile.show', ['user' => $job->employer_id]) }}" class="d-flex align-items-center text-decoration-none text-primary">
                                                        <i class="bi bi-person"></i>
                                                        <span class="ms-1">{{ $job->employer->username }}</span>
                                                    </a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Applicant Details Column -->
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0">Személyes adataid</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="d-flex align-items-center mb-3">
                                                    <i class="bi bi-person me-2 fs-5 text-primary"></i>
                                                    <span class="text-muted">{{ $user->username }}</span>
                                                </div>
                                                <div class="d-flex align-items-center mb-3">
                                                    <i class="bi bi-envelope me-2 fs-5 text-primary"></i>
                                                    <span class="text-muted">{{ $user->email }}</span>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-telephone me-2 fs-5 text-primary"></i>
                                                    <span class="text-muted">{{ $user->telephone }}</span>
                                                </div>
                                            </div>

                                            <form method="POST" action="{{ route('applications.store', $job) }}">
                                                @csrf
                                                <div class="mb-4">
                                                    <label for="cover_letter" class="form-label">Motivációs levél</label>
                                                    <textarea class="form-control" id="cover_letter" name="cover_letter" style="resize: none; height: 240px;"
                                                            rows="5" placeholder="Írd ide motivációs leveled..." required></textarea>
                                                </div>

                                                <div class="d-grid gap-2">
                                                    <button type="submit" class="btn btn-primary btn-lg">
                                                        <i class="bi bi-send-check me-2"></i>Jelentkezés véglegesítése
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- END Job Application -->

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

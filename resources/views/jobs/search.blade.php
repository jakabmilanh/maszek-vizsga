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
                    <img src="../images/maszek-logo.png" alt="" height="30" >
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
                            <a class="nav-link active" href={{route('jobs.search')}}>Elérhető munkák</a>
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


<!-- Start Job Search -->
<div class="container-lg section">
    <div class="row section">
        <!-- Filter Column (Top) -->
        <div class="col-12">
            <div class="card p-3 mb-4">
                <h5 class="mb-3">Szűrők</h5>
                <form method="GET" action="{{ route('jobs.search') }}" id="filterForm">
                    <!-- Keyword Search -->
                    <div class="mb-3">
                        <label class="form-label">Kulcsszó</label>
                        <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Pl. Pincér">
                    </div>

                    <!-- Category Filter (Static dropdown) -->
                    <div class="mb-3">
                        <label class="form-label">Kategória</label>
                        <select name="category" id="category" class="form-select">
                            <option value="">Válassz kategóriát</option>
                            <option value="Teljes munkaidős">Teljes munkaidős</option>
                            <option value="Részmunkaidős">Részmunkaidős</option>
                            <option value="Egyszeri alkalom">Egyszeri alkalom</option>
                            <option value="Több alkalom">Több alkalom</option>
                            <option value="Otthon végezhető">Otthon végezhető</option>
                            <option value="Online végezhető">Online végezhető</option>
                        </select>
                    </div>

                    <!-- Location Filter -->
                    <div class="mb-3">
                        <label class="form-label">Helyszín</label>
                        <input type="text" name="location" id="location" class="form-control" placeholder="Pl. Budapest">
                    </div>

                    <!-- Salary Range -->
                    <div class="mb-3">
                        <label class="form-label">Min. Fizetés</label>
                        <input type="number" name="salary_min" id="salary_min" class="form-control" placeholder="Pl. 200000">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Max. Fizetés</label>
                        <input type="number" name="salary_max" id="salary_max" class="form-control" placeholder="Pl. 500000">
                    </div>

                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i> Keresés
                        </button>
                        <a href="{{ route('jobs.search') }}" class="btn btn-primary">
                            <i class="bi bi-arrow-left"></i> Szűrő törése
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Job Listings Column (Bottom) -->
        <div class="col-12">
            <div class="row justify-content-start gy-5 p-3">
                @if($jobs->isEmpty())
                <div class="alert alert-info w-100">
                    <i class="bi bi-info-circle me-2"></i> Nem találtunk ennek a szűrőnek megfelelő munka hirdetést.
                </div>
            @else

                <!-- Loop through jobs and display each in a card -->
                @foreach($jobs as $job)
                <div class="card job-box col-lg-4 col-md-6 col-sm-12 p-3"
                     onclick="window.location.href='{{ route('jobs.show', ['id' => $job->job_id]) }}'"
                     style="cursor: pointer; transition: all 0.3s ease;"
                     onmouseover="this.style.transform='translateY(-5px)'"
                     onmouseout="this.style.transform='none'">

                    <!-- Job Title -->
                    <h5>{{ $job->title }}</h5>

                    <!-- Time Posted -->
                    <p class="job-posted-time">
                        <i class="bi bi-clock icon-color-primary"></i>
                        <a class="text-muted job-date">
                            Meghírdetve {{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}
                        </a>
                    </p>

                    <!-- Category and Salary -->
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="job-schedule-full">{{ $job->category }}</h6>
                        </div>
                        <div class="col-md-6 d-flex align-items-start mt-1">
                            <h6 class="mb-0 d-flex align-items-center flex-grow-1">
                                <div>
                                    <i class="bi bi-cash icon-color-primary"></i> {{ number_format($job->salary, 0) }}
                                </div>
                                @if(in_array($job->category, ['Teljes munkaidős', 'Részmunkaidős', 'Több alkalom']))
                                     <span class="ms-1"> Ft/óra</span>
                                @else
                                <span class="ms-1"> Ft</span>
                                @endif
                            </h6>
                        </div>
                    </div>

                    <!-- Employer and Location -->
                    <div class="border-top mt-2">
                        <div class="row job-poster-data">
                            <div class="col-md-4 justify-content-center d-flex align-items-center border rounded">
                                <img src="" alt="Felhasználó Kép" height="50">
                            </div>
                            <div class="col-md-8 mt-1">
                                <h5>{{ $job->employer->username }}</h5>
                                <h6 class="justify-content-start">
                                    <i class="bi bi-geo-alt-fill icon-color-primary"></i>
                                    <a class="text-muted">{{ $job->location }}</a>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $jobs->links() }}
            </div>
        </div>
    </div>
</div>
<!-- End Job Search -->


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

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <title>Maszek | Profil szerkesztése</title>
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
        <!-- START Profile -->
        <div class="container-lg mt-5 section">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <!-- Left Column - Profile Overview -->
                        <div class="col-lg-4 text-center">
                            <div class="mb-4">
                                <img src="{{ $user->profile_picture ?? asset('images/profile_pictures/default.jpg') }}"
                                    class="rounded-circle img-fluid"
                                    style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                            <h4>{{ $user->username }}</h4>

                            <!-- Role Badge -->
                            @if($user->role == "Munkavállaló")
                                <p class="text-warning">{{ $user->role }}</p>
                            @else
                                <p class="text-danger">{{ $user->role }}</p>
                            @endif

                            <!-- Documents Section -->
                            <div class="mt-4">
                                <h5>Dokumentumok</h5>
                                <ul class="list-unstyled">
                                    @if($user->profession_pictures && count(json_decode($user->profession_pictures)) > 0)
                                        @foreach(json_decode($user->profession_pictures) as $document)
                                            <li class="mb-2">
                                                <a href="{{ asset('storage/profession_pictures/'.$document) }}"
                                                   target="_blank"
                                                   class="text-decoration-none">
                                                    <i class="bi bi-file-pdf me-2"></i>{{ basename($document) }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="text-muted">Nincs feltöltött dokumentum</li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <!-- Right Column - Detailed Information -->
                        <div class="col-lg-8">
                            <!-- Contact Information -->
                            <div class="mb-5">
                                <h4 class="mb-4 border-bottom pb-2">Felhasználó adatai</h4>

                                @if($showContactInfo || Auth::id() == $user->id)
                                    <!-- Email -->
                                    <div class="input-group mb-4">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="bi bi-envelope text-primary"></i>
                                        </span>
                                        <div class="form-control bg-light">{{ $user->email }}</div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="input-group mb-4">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="bi bi-telephone text-primary"></i>
                                        </span>
                                        <div class="form-control bg-light">
                                            {{ $user->telephone ?? 'Nincs megadva' }}
                                        </div>
                                    </div>
                                @else
                                    <div class="alert alert-info">
                                        <i class="bi bi-info-circle me-2"></i>
                                        Kapcsolati információk megtekintéséhez elfogadott munkakapcsolat szükséges a felhasználóval.
                                    </div>
                                @endif

                                <!-- Bio (Always visible) -->
                                <div class="mb-4">
                                    <h5 class="mb-3">Bemutatkozás</h5>
                                    <div class="bg-light p-4 rounded">
                                        {!! nl2br(e($user->bio ?? 'Még nincs bemutatkozás')) !!}
                                    </div>
                                </div>
                                <h5 class="mt-4">Közös munkák</h5>
                                @if($sharedJobs->count() > 0)

                                    <div class="row">
                                        @foreach($sharedJobs as $job)
                                            <div class="col-md-6 mb-3">
                                                <div class="alert alert-info d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <i class="bi bi-briefcase me-2"></i>
                                                        <a href="{{ route('jobs.show', $job->job_id) }}" class="alert-link fw-medium">
                                                            {{ $job->title }}
                                                        </a>
                                                    </div>
                                                    <span class="badge bg-primary fw-medium">
                                                        {{ $job->created_at->format('Y.m.d') }}
                                                    </span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="alert alert-info mt-4">
                                        <i class="bi bi-info-circle me-2"></i>
                                        Jelenleg nincsenek közös munkák ezzel a felhasználóval.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <!-- Overall Rating -->
                        <div class="row mb-5">
                            <div class="col-12">
                                <h4 class="border-bottom pb-2">Összértékelés</h4>
                                <div class="d-flex align-items-center">
                                    <div class="display-6 me-3 text-primary">
                                        {{ number_format($averageRating, 1) }}/5
                                    </div>
                                    <div class="text-primary fs-5">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star{{ $i <= $averageRating ? '-fill' : ($i - 0.5 <= $averageRating ? '-half' : '') }}"></i>
                                        @endfor
                                    </div>
                                    <div class="ms-3 text-muted">
                                        ({{ $reviews->count() }} értékelés)
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Job Applications (for employees) -->
                        <h4 class="border-bottom pb-2">Jelentkezések</h4>
                        @if($applications->isNotEmpty())
                        <div class="row mb-5">
                            @foreach($applications as $application)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h5>{{ $application->job->title }}</h5>
                                                <div class="text-muted">
                                                    {{ $application->created_at->format('Y.m.d') }}
                                                </div>
                                            </div>
                                            <span class="badge fw-small bg-{{
                                                $application->status === 'accepted' ? 'success' :
                                                ($application->status === 'rejected' ? 'danger' : 'warning')
                                            }}">
                                                @switch($application->status)
                                                    @case('pending')
                                                        Folyamatban
                                                        @break
                                                    @case('accepted')
                                                        Elfogadva
                                                        @break
                                                    @case('rejected')
                                                        Elutasítva
                                                        @break
                                                    @default
                                                        Ismeretlen
                                                @endswitch
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                            <div class="alert alert-info mb-5">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Jelenleg nincsenek jelentkezések.
                                </div>
                            @endif



                        <!-- Job Listings (for employers) -->
                        <h4 class="border-bottom pb-2">Hirdetések</h4>
                        @if($user->role === 'Munkáltató' && $jobs->isNotEmpty())
                        <div class="row mb-5">
                                <div class="col-12">

                                    <div class="row p-3">
                                                @foreach($jobs as $job)
                                                <div class="card job-box col-lg-4 col-md-4 p-3"
                                onclick="window.location.href='{{ route('jobs.show', ['id' => $job->job_id]) }}'"
                                style="cursor: pointer; transition: all 0.3s ease;"
                                onmouseover="this.style.transform='translateY(-5px)'"
                                onmouseout="this.style.transform='none'">

                            <h5>{{ $job->title }}</h5>
                            <p class="job-posted-time">
                                <i class="bi bi-clock icon-color-primary"></i>
                                <a class="text-muted job-date">
                                    Meghírdetve {{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}
                                </a>
                            </p>
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
                            <div class="border-top mt-2">
                                <div class="row job-poster-data">
                                    <div class="col-md-4 justify-content-center d-flex align-items-center border rounded">
                                        <img src="images/facebook.webp" alt="Felhasználó Kép" height="50">
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
                                </div>
                            </div>
                        </div>
                        @else
                                <div class="alert alert-info mb-5">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Jelenleg nincsenek hírdetések.
                                </div>
                            @endif

                        <!-- Reviews -->
                        <h4 class="border-bottom pb-2">Értékelések</h4>
                        @if($reviews->isNotEmpty())
                        <div class="row">
                            @foreach($reviews as $review)
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h5>{{ $review->job->title }}</h5>
                                                <div class="text-primary">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <div class="mt-2 badge bg-primary fw-small">
                                                    <span class="fst-italic">{{ $review->reviewer->username }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            Még nincsennek értékelések.
                        </div>
                        @endif
                    </div>
                </div>
            </div>


        </div>
        <!-- END Profile -->



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

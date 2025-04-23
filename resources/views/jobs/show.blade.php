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
                            <a href="{{ route('profile.edit') }}"><img  src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('images/profile_pictures/default.jpg') }}" class="rounded-circle border" width="40" height="40"></a>
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
    <!-- Start Job details -->
    <div class="container-lg mt-5 section">
        <div class="row ">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">{{ $job->title }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-briefcase me-2 fs-5 text-primary"></i>
                                    <span class="text-muted">{{ $job->category }}</span>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-geo-alt me-2 fs-5 text-primary"></i>
                                    <span class="text-muted">{{ $job->location }}</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-info-circle me-2 fs-5 text-primary"></i>
                                    <span class="badge fw-small bg-{{
                                        $job->status === 'open' ? 'success' :
                                        ($job->status === 'in progress' ? 'warning' : 'danger')
                                    }}">
                                        {{ $job->status === 'open' ? 'Nyitott' :
                                          ($job->status === 'in progress' ? 'Folyamatban' : 'Lezárt') }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-cash me-2 fs-5 text-primary"></i>
                                    <span class="text-muted">
                                    {{ number_format($job->salary, 0, ',', ' ') }}
                                        <span class="ms-1 small">
                                            @if(in_array($job->category, ['Teljes munkaidős', 'Részmunkaidős', 'Több alkalom']))
                                                Ft/óra
                                            @else
                                                Ft
                                            @endif
                                        </span>
                                    </span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-clock me-2 fs-5 text-primary"></i>
                                    <span class="text-muted">Meghírdetve: {{ $job->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="mt-4">
                            <h5 class="mb-3 text-primary">Munkaleírás</h5>
                            <div class="bg-light p-4 rounded">
                                {!! nl2br(e($job->description)) !!}
                            </div>
                        </div>

                        <div class="mt-4">
                            <h5 class="mb-3 text-primary">Jelentkezések</h5>
                            @if($job->applications->count() > 0)
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <td>Felhasználónév</td>
                                                <td>Státusz</td>
                                                <td>Jelentkezés ideje</td>
                                                <td>Fiók</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($job->applications as $application)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <div>
                                                                {{ $application->employee->username }}
                                                                @if($application->employee_id === Auth::id())
                                                                    <span class="text-primary ms-2">(Te)</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge fw-small  bg-{{
                                                        $application->status === 'accepted' ? 'success' :
                                                        ($application->status === 'pending' ? 'warning' : 'danger')
                                                    }}">
                                                        <i class="bi bi-{{
                                                            $application->status === 'accepted' ? 'check-circle' :
                                                            ($application->status === 'pending' ? 'clock-history' : 'x-circle')
                                                        }} me-1"></i>
                                                        @switch($application->status)
                                                            @case('accepted') Elfogadva @break
                                                            @case('pending') Elfogadásra vár @break
                                                            @case('rejected') Elutasítva @break
                                                        @endswitch
                                                    </span>
                                                </td>
                                                <td>
                                                    {{ $application->created_at->format('Y.m.d - H:i') }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('profile.show', $application->employee->id) }}"
                                                       class="text-primary"
                                                       title="Profil megtekintése">
                                                        <i class="bi bi-person-lines-fill"></i> Megtekintés
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Még nincsenek jelentkezők erre az állásra.
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">Hirdetés azonosító: #{{ $job->job_id }}</small>

                             @auth
                            @if($job->employer_id == auth()->id())
                                <button class="btn btn-outline-secondary" disabled>
                                    <i class="bi bi-person-check me-2"></i>Ez a te hirdetésed
                                </button>
                            @else
                                @if($job->status != 'open')
                                    <button class="btn btn-outline-secondary" disabled>
                                        <i class="bi bi-x-circle me-2"></i>Nem elérhető
                                    </button>
                                @else
                                    @php
                                        $application = auth()->user()->applications()
                                            ->where('job_id', $job->job_id)
                                            ->first();
                                    @endphp

                                    @if($application)
                                        <button class="btn btn-outline-primary" disabled>
                                            <i class="bi bi-{{ $application->status === 'accepted' ? 'check2-circle' : 'clock' }} me-2"></i>
                                            @if($application->status === 'accepted')
                                                Jelentkezésed elfogadva
                                            @elseif ($application->status === 'rejected')
                                                Jelentkezésed elutasítva
                                            @else
                                                Jelentkezésed elfogadásra vár
                                            @endif
                                        </button>
                                    @else
                                        <form action="{{ route('applications.create', $job) }}" method="GET" class="d-inline">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-send me-2"></i>Jelentkezem
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Bejelentkezés
                            </a>
                        @endauth
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Hirdető adatai</h3>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img
                                            src="{{ $job->employer->profile_picture ? asset('storage/' . $job->employer->profile_picture) : asset('images/profile_pictures/default.jpg') }}"
                                            class="rounded-circle img-fluid"
                                            style="width: 150px; height: 150px;"
                                            alt="Profile Picture"
                                        />
                            <h4 class="mt-3">{{ $job->employer->username }}</h4>
                            @if($job->employer->bio)
                                <p class="text-muted small">{{ $job->employer->bio }}</p>
                            @endif
                        </div>

                        <div class="list-group list-group-flush">
                            @auth
                                    @if(
                                        auth()->user()->applications()->where('job_id', $job->job_id)->where('status', 'accepted')->exists() ||
                                        auth()->id() === $job->employer->id
                                    )
                                    {{-- Visible for users with approved application --}}
                                    <div class="list-group-item d-flex align-items-center">
                                        <i class="bi bi-envelope me-2 text-primary"></i>
                                        <span class="text-muted">{{ $job->employer->email }}</span>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center">
                                        <i class="bi bi-telephone me-2 text-primary"></i>
                                        <span class="text-muted">{{ $job->employer->telephone }}</span>
                                    </div>

                                    {{-- Visible documents for accepted users --}}
                                    @if($job->employer->profession_pictures)
                                        <div class="mt-4">
                                            <h6 class="mb-2 text-primary d-flex justify-content-center">Feltöltött dokumentumok</h6>
                                            <ul class="list-unstyled text-center">
                                                @foreach(json_decode($job->employer->profession_pictures) as $document)
                                                    @php
                                                        $filename = basename($document);
                                                        $displayName = \Illuminate\Support\Str::limit($filename, 20);
                                                    @endphp
                                                    <li class="mb-2">
                                                        <a href="{{ asset('storage/profession_pictures/' . $document) }}"
                                                           download
                                                           class="text-decoration-none text-primary">
                                                            <i class="bi bi-file-pdf me-2"></i>{{ $displayName }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                @else
                                    {{-- Hidden contact and document info --}}
                                    <div class="list-group-item text-center">
                                        <i class="bi bi-lock fs-4 text-muted"></i>
                                        <p class="text-muted mb-0">
                                            A hirdető elérhetőségeit és dokumentumait csak elfogadott jelentkezés esetén tekintheted meg.
                                        </p>
                                    </div>
                                @endif
                            @else
                                {{-- Message for logged out users --}}
                                <div class="list-group-item text-center">
                                    <i class="bi bi-person-lock fs-4 text-muted"></i>
                                    <p class="text-muted mb-0">
                                        Jelentkezz be az elérhetőségek és dokumentumok megtekintéséhez.
                                    </p>
                                </div>
                            @endauth
                        </div>
                        </div>
                        <div class="card-footer bg-light text-center">
                            <small class="text-muted">Regisztrálva: {{ $job->employer->created_at->diffForHumans() }}</small>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
     <!-- End Job details -->
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

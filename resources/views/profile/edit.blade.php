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
                                <a href="{{ route('profile.edit') }}">
                                    <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('images/profile_pictures/default.jpg') }}" alt="Profile Picture" class="rounded-circle border" width="40" height="40"></a>
                            </div>
                            @else
                            <div class="me-5 d-flex align-items-center">
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
        <!-- Start Profile -->


            <div class="container-lg mt-5 section">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-4 text-center">
                                <div class="mb-4">
                                    <img
                                            src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('images/profile_pictures/default.jpg') }}"
                                            class="rounded-circle img-fluid"
                                            style="width: 150px; height: 150px;"
                                            alt="Profile Picture"
                                        />
                                </div>
                                <h4>{{ auth()->user()->username }}</h4>

                                @if (auth()->user()->role == "Munkavállaló")
                                <p class="text-warning">{{ auth()->user()->role }}</p>
                                @else
                                <p class="text-danger">{{ auth()->user()->role }}</p>
                                @endif


                                <div class="mt-4">
                                    <h5>Dokumentumok</h5>
                                    <ul class="list-unstyled">
                                        @if($user->profession_pictures && count(json_decode($user->profession_pictures)) > 0)
                                            @foreach(json_decode($user->profession_pictures) as $document)
                                                @php
                                                    $filename = basename($document);
                                                    $displayName = \Illuminate\Support\Str::limit($filename, 20);
                                                @endphp
                                                <li class="mb-2 ">
                                                    <a href="{{ route('download', ['filename' => $filename]) }}" download class="text-primary">
                                                        <i class="bi bi-file-pdf"></i>{{$displayName}}
                                                    </a>
                                                </li>
                                            @endforeach
                                        @else
                                            <li class="text-muted">Nincs feltöltött dokumentum</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>


                            <div class="col-lg-8">
                                        @if ($errors->any())
                                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                                            <i class="bi bi-bug-fill" style="margin-right: 5px"></i>
                                            <div>
                                                Hiba lépett fel. Kérjük, ellenőrizze, hogy az adatok amiket megadott valósak.
                                            </div>
                                        </div>
                                    @endif
                                    <form method="POST" action="{{ route('profile.update', ['user' => Auth::id()]) }}" enctype="multipart/form-data" class="contact-form">
                                        @csrf
                                        @method('PUT') <!-- This simulates the PUT request -->

                                        <span id="error-msg"></span>

                                        <div class="row">
                                            <!-- Username -->
                                            <div class="col-lg-12">
                                                <div class="position-relative mb-3">
                                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                                    <input name="username" id="username" type="text" class="form-control" placeholder="Felhasználónév" value="{{ old('username', Auth::user()->username) }}" required>

                                                </div>
                                            </div>

                                            <!-- Email -->
                                            <div class="col-lg-12">
                                                <div class="position-relative mb-3">
                                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                                    <input name="email" id="email" type="email" class="form-control" placeholder="Email cím" value="{{ old('email', Auth::user()->email) }}" required readonly>

                                                </div>
                                            </div>

                                            <!-- Telephone -->
                                            <div class="col-lg-12">
                                                <div class="position-relative mb-3">
                                                    <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                                    <input name="telephone" id="telephone" type="text" class="form-control" placeholder="Telefonszám" value="{{ old('telephone', Auth::user()->telephone) }}" required readonly>

                                                </div>
                                            </div>

                                            <!-- Bio -->
                                            <div class="col-lg-12">
                                                <div class="position-relative mb-3">
                                                    <span class="input-group-text d-flex align-items-start"><i class="bi bi-file-earmark-person"></i></span>
                                                    <textarea name="bio" id="bio" class="form-control" placeholder="Bio" rows="4">{{ old('bio', Auth::user()->bio) }}</textarea>

                                                </div>
                                            </div>

                                            <!-- Profile Picture -->
                                            <div class="col-lg-12">
                                                <div class="position-relative mb-3">
                                                    <span class="input-group-text"><i class="bi bi-camera"></i></span>
                                                    <input name="profile_picture" id="profile_picture" type="file" class="form-control" accept="image/*">

                                                </div>

                                            </div>

                                            <!-- Profession Documents -->
                                            <div class="col-lg-12">
                                                <div class="position-relative mb-3">
                                                    <span class="input-group-text"><i class="bi bi-file-earmark-text"></i></span>
                                                    <input name="profession_pictures[]" id="profession_pictures" type="file" class="form-control" multiple>

                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="col-lg-12">
                                                <div class="position-relative mb-3">
                                                    <button type="submit" class="btn btn-primary">Módosítások mentése</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- End Profile -->
            <!-- Start Joblisting -->
<div class="container-lg mb-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    @if(Auth::user()->role === 'Munkáltató')
                        <h3 class="text-primary">Hirdetések</h3>
                        @if($jobs->isEmpty())
                            <div class="text-start mb-3">

                                <div class="d-flex align-items-center gap-3">
                                    <div class="alert alert-info mb-0 fw-small flex-grow-1">
                                        <i class="bi bi-info-circle me-2"></i>
                                        Még nem hírdettél meg egy állást sem.
                                    </div>
                                    <a href="{{ route('jobs.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-lg"></i> Új munkahírdetés
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="table-brigth ">

                                        <tr>
                                            <td class="fw-medium">Cím</td>
                                            <td class="fw-medium">Kategória</td>
                                            <td class="fw-medium">Fizetés</td>
                                            <td class="fw-medium">Helyszín</td>
                                            <td class="fw-medium">Meghírdetve</td>
                                            <td class="fw-medium">Munka státusz</td>
                                            <td class="fw-medium">Műveletek</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jobs as $job)
                                        <tr>
                                            <td>
                                                <span style="cursor: pointer;" class="text-primary"
                                                      data-bs-toggle="collapse"
                                                      data-bs-target="#applications-{{ $job->job_id }}">
                                                      <i class="bi bi-arrow-down"></i>
                                                    {{ $job->title }}

                                                </span>
                                            </td>
                                            <td>{{ $job->category }}</td>
                                            <td>
                                                {{ number_format($job->salary, 0, ',', ' ') }} Ft
                                                @if(in_array($job->category, ['Teljes munkaidős', 'Részmunkaidős', 'Több alkalom']))
                                                /óra
                                                @endif
                                            </td>
                                            <td>{{ $job->location }}</td>
                                            <td>{{ $job->created_at->format('Y.m.d - H:i') }}</td>
                                            <td>
                                                <span class="badge fw-small bg-{{
                                                    $job->status === 'open' ? 'success' :
                                                    ($job->status === 'in progress' ? 'warning' : 'danger')
                                                }}">
                                                    {{ $job->status === 'open' ? 'Nyitott' :
                                                      ($job->status === 'in progress' ? 'Folyamatban' : 'Lezárt') }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-4">
                                                    @if($job->status === 'open') <!-- Check if the job is open -->
                                                        <!-- Edit Button -->
                                                        <a href="{{ route('jobs.edit', $job) }}" class="text-primary">
                                                            <i class="bi bi-pencil"></i> Szerkesztés
                                                        </a>

                                                        <!-- Delete Button -->
                                                        <form action="{{ route('jobs.destroy', $job) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-danger border-none" onclick="return confirm('Biztosan törli ezt az állás hírdetést?');" style="border: none; background-color: white;">
                                                                <i class="bi bi-trash"></i> Törlés
                                                            </button>
                                                        </form>
                                                    @else
                                                        <!-- If the job is not open, show a message or disable the buttons -->
                                                        <span class="text-muted"> <i class="bi bi-x"></i> Művelet nem elérhető</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Applications Dropdown -->
                                        <tr>
                                            <td colspan="6" class="p-0">
                                                <div class="collapse" id="applications-{{ $job->job_id }}">
                                                    <div class="p-3">
                                                        @if($job->applications->count() > 0)
                                                        <div class="table-responsive">
                                                            <table class="table table-sm">
                                                                <thead class="table">
                                                                    <tr>
                                                                        <td class="fw-medium">Felhasználónév</td>
                                                                        <td class="fw-medium">Státusz</td>
                                                                        <td class="fw-medium">Jelentkezés időpontja</td>
                                                                        <td class="fw-medium">Üzenet</td>
                                                                        <td class="fw-medium">Műveletek</td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($job->applications as $application)
                                                                            <tr>
                                                                                <td>
                                                                                    <a href="{{ route('profile.show', $application->employee) }}"
                                                                                    class="text-decoration-none text-primary">
                                                                                        <i class="bi bi-person me-1"></i>
                                                                                        {{ $application->employee->username }}
                                                                                    </a>
                                                                                </td>
                                                                                <td>
                                                                                    <span class="fw-small badge bg-{{
                                                                                        $application->status === 'accepted' ? 'success' :
                                                                                        ($application->status === 'rejected' ? 'danger' : 'warning')
                                                                                    }}">
                                                                                        {{ $application->status === 'accepted' ? 'Elfogadva' :
                                                                                        ($application->status === 'rejected' ? 'Elutasítva' : 'Elfogadásra vár') }}
                                                                                    </span>
                                                                                </td>
                                                                                <td>{{ $application->created_at->format('Y.m.d - H:i') }}</td>
                                                                                <td>
                                                                                    <a href="#" class="text-primary" onclick="showCoverLetter({{ json_encode($application->cover_letter) }}); return false;">
                                                                                        <i class="bi bi-envelope"></i> Üzenet
                                                                                    </a>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="d-flex gap-4">
                                                                                        @if($application->status === 'pending')
                                                                                            <!-- Existing Accept/Reject buttons -->
                                                                                            <form method="POST" action="{{ route('applications.update', $application) }}">
                                                                                                @csrf
                                                                                                @method('PUT')
                                                                                                <input type="hidden" name="status" value="accepted">
                                                                                                <button type="submit" class="btn text-success p-0">
                                                                                                    <i class="bi bi-check-lg"></i> Elfogadás
                                                                                                </button>
                                                                                            </form>
                                                                                            <form method="POST" action="{{ route('applications.update', $application) }}">
                                                                                                @csrf
                                                                                                @method('PUT')
                                                                                                <input type="hidden" name="status" value="rejected">
                                                                                                <button type="submit" class="btn text-danger p-0">
                                                                                                    <i class="bi bi-x-lg"></i> Elutasítás
                                                                                                </button>
                                                                                            </form>
                                                                                        @elseif($application->status === 'accepted')
                                                                                            @if($application->job->status === 'in progress')
                                                                                                <form method="POST" action="{{ route('jobs.close', $application->job) }}">
                                                                                                    @csrf
                                                                                                    @method('PUT')
                                                                                                    <button type="submit" class="btn text-success p-0">
                                                                                                        <i class="bi bi-check-lg"></i> Munka lezárása
                                                                                                    </button>
                                                                                                </form>
                                                                                            @elseif($application->job->status === 'closed')
                                                                                                @if(Auth::user()->reviewsGiven()
                                                                                                        ->where('job_id', $application->job->job_id)
                                                                                                        ->where('reviewee_id', $application->employee->id)
                                                                                                        ->exists())
                                                                                                    <span class="text-muted">
                                                                                                        <i class="bi bi-star"></i> Már írtál véleményt
                                                                                                    </span>
                                                                                                @else
                                                                                                    <a href="{{ route('reviews.create', ['job' => $application->job, 'user' => $application->employee]) }}" class="text-primary">
                                                                                                        <i class="bi bi-star"></i> Írj egy véleményt
                                                                                                    </a>
                                                                                                @endif
                                                                                            @endif
                                                                                        @else
                                                                                            <span class="text-muted"><i class="bi bi-x"></i> Művelet nem elérhető</span>
                                                                                        @endif
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        @else

                                                        <div class="alert alert-info mb-0 fw-small">
                                                            <i class="bi bi-info-circle me-2"></i>
                                                            Nincsenek jelentkezések ehhez az álláshoz.
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-4 mb-4">
                                    <a href="{{ route('jobs.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-lg"></i> Új hírdetés létrehozása
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endif
                    @php
                        $userApplications = Auth::user()->applications()->with('job.employer')->get();
                    @endphp

                    <div class="table-responsive">
                        <h3 class="text-primary">Jelentkezéseim</h3>
                        @if($userApplications->isEmpty())
                            <div class="d-flex align-items-center gap-3">
                                <div class="alert alert-info mb-0 fw-small flex-grow-1">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Még nem jelentkeztél egy állásra sem.
                                </div>
                                <a href="{{ route('jobs.search') }}" class="btn btn-primary">
                                    <i class="bi bi-search"></i> Hirdetések megtekintése
                                </a>
                            </div>
                        @else
                            <table class="table">
                                <thead class="table-bright">
                                    <tr>
                                        <td class="fw-medium">Hirdetés címe</td>
                                        <td class="fw-medium">Munkáltató</td>
                                        <td class="fw-medium">Jelentkezés státusza</td>
                                        <td class="fw-medium">Munka státusza</td>
                                        <td class="fw-medium">Jelentkezés dátuma</td>
                                        <td class="fw-medium">Műveletek</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($userApplications as $application)
                                        <tr>
                                            <td>
                                                <a href="{{ route('jobs.show', $application->job) }}" class="text-primary">
                                                    <i class="bi bi-file-earmark"></i> {{ $application->job->title }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('profile.show', $application->job->employer) }}" class="text-primary">
                                                    <i class="bi bi-person"></i> {{ $application->job->employer->username }}
                                                </a>
                                            </td>
                                            <td>
                                                <span class="fw-small badge bg-{{
                                                    $application->status === 'accepted' ? 'success' :
                                                    ($application->status === 'rejected' ? 'danger' : 'warning')
                                                }}">
                                                    {{ $application->status === 'accepted' ? 'Elfogadva' :
                                                    ($application->status === 'rejected' ? 'Elutasítva' : 'Elfogadásra vár') }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge fw-small bg-{{
                                                    $application->job->status === 'open' ? 'success' :
                                                    ($application->job->status === 'in progress' ? 'warning' : 'danger')
                                                }}">
                                                    {{ $application->job->status === 'open' ? 'Nyitott' :
                                                      ($application->job->status === 'in progress' ? 'Folyamatban' : 'Lezárt') }}
                                                </span>
                                            </td>
                                            <td>{{ $application->created_at->format('Y.m.d - H:i') }}</td>
                                            <td>
                                                <div class="d-flex gap-4">
                                                    @if($application->status === 'accepted' && $application->job->status === 'closed')
                                                        @if(Auth::user()->reviewsGiven()
                                                                ->where('job_id', $application->job->job_id)
                                                                ->where('reviewee_id', $application->job->employer_id)
                                                                ->exists())
                                                            <span class="text-muted">
                                                                <i class="bi bi-star"></i> Már írtál véleményt
                                                            </span>
                                                        @else
                                                            <a href="{{ route('reviews.create', ['job' => $application->job, 'user' => $application->job->employer]) }}" class="text-primary">
                                                                <i class="bi bi-star"></i> Írj egy véleményt
                                                            </a>
                                                        @endif
                                                    @else
                                                        <span class="text-muted"><i class="bi bi-x"></i> Művelet nem elérhető</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Joblisting -->
<!-- Start Reviewlisting -->
<div class="container-lg mb-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="text-primary">Vélemények</h3>
                    @if($reviews->isEmpty())
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            Még nincs véleményed.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td class="fw-medium">Felhasználónév</td>
                                        <td class="fw-medium">Vélemény</td>
                                        <td class="fw-medium">Értékelés</td>
                                        <td class="fw-medium">Időpont</td>
                                        <td class="fw-medium">Munka</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reviews as $review)
                                    <tr>
                                        <td class="text-primary"><i class="bi bi-person text-primary"></i> <a href="{{ route('profile.show', ['user' => $review->reviewer->id]) }}" class="text-primary">{{ $review->reviewer->username }}</a></td>
                                        <td>{{ $review->review_text }}</td>
                                        <td>{{ $review->rating }} / 5</td>
                                        <td>{{ $review->created_at->format('Y.m.d - H:i') }}</td>
                                        <td ><i class="bi bi-file-earmark text-primary"> <a href="{{ route('jobs.show', ['id' => $review->job->job_id]) }}" class="text-primary">{{ $review->job->title }}</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            <h3 class="text-primary">Összértékelés</h3>
                            <p><i class="bi bi-star-fill text-primary"></i> {{ number_format($reviews->avg('rating'), 1) }} / 5</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Reviewlisting -->


                    <!-- START FOOTER -->
        <footer class="section bg-footer">
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
    <script>
        function showCoverLetter(letter) {
            Swal.fire({
                title: 'Üzenet',
                html: letter.replace(/\n/g, '<br>'),
                icon: 'info',
                confirmButtonText: 'Bezár',
                confirmButtonColor: '#8a0779'
            });
        }
    </script>
</html>

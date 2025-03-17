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
                                <a class="nav-link" href="">Elérhető munkák</a>
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
        <!-- Start Profile -->


            <div class="container-lg mt-5 section">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-4 text-center">
                                <div class="mb-4">
                                    <img
                                        src="{{ auth()->user()->profile_picture ?? asset('images/profile_pictures/default.jpg') }}"
                                        class="rounded-circle img-fluid"
                                        style="width: 150px; height: 150px;"
                                    >
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
                                        @if(auth()->user()->profession_pictures && count(json_decode(auth()->user()->profession_pictures)) > 0)
                                            @foreach(json_decode(auth()->user()->profession_pictures) as $profession)
                                                <li>{{$profession}}</li>
                                            @endforeach
                                        @else
                                            <li>Nincs még feltöltött dokumentum</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>


                            <div class="col-lg-8">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
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
                                                    @error('username')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Email -->
                                            <div class="col-lg-12">
                                                <div class="position-relative mb-3">
                                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                                    <input name="email" id="email" type="email" class="form-control" placeholder="Email cím" value="{{ old('email', Auth::user()->email) }}" required readonly>
                                                    @error('email')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Telephone -->
                                            <div class="col-lg-12">
                                                <div class="position-relative mb-3">
                                                    <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                                    <input name="telephone" id="telephone" type="text" class="form-control" placeholder="Telefonszám" value="{{ old('telephone', Auth::user()->telephone) }}" required readonly>
                                                    @error('telephone')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Bio -->
                                            <div class="col-lg-12">
                                                <div class="position-relative mb-3">
                                                    <span class="input-group-text d-flex align-items-start"><i class="bi bi-file-earmark-person"></i></span>
                                                    <textarea name="bio" id="bio" class="form-control" placeholder="Bio" rows="4">{{ old('bio', Auth::user()->bio) }}</textarea>
                                                    @error('bio')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Profile Picture -->
                                            <div class="col-lg-12">
                                                <div class="position-relative mb-3">
                                                    <span class="input-group-text"><i class="bi bi-camera"></i></span>
                                                    <input name="profile_picture" id="profile_picture" type="file" class="form-control" accept="image/*">
                                                    @error('profile_picture')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Profession Documents -->
                                            <div class="col-lg-12">
                                                <div class="position-relative mb-3">
                                                    <span class="input-group-text"><i class="bi bi-file-earmark-text"></i></span>
                                                    <input name="profession_pictures[]" id="profession_pictures" type="file" class="form-control" multiple>
                                                    @error('profession_pictures')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
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
                                    @if($jobs->isEmpty())
                                        <!-- No jobs available -->
                                        <div class="text-start p-4">
                                            <p class="text-muted">Még nem hoztál létre hírdetést.</p>
                                            <a href="{{ route('jobs.create') }}" class="btn btn-primary">
                                                <i class="bi bi-plus-lg"></i> Új munkahírdetés
                                            </a>
                                        </div>
                                    @else
                                        <!-- List of jobs -->
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="table-brigth">
                                                    <tr>
                                                        <th>Cím</th>
                                                        <th>Kategória</th>
                                                        <th>Fizetés</th>
                                                        <th>Cím, helyszín</th>
                                                        <th>Meghírdetve</th>
                                                        <th>Funkciók</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($jobs as $job)
                                                        <tr>
                                                            <td>{{ $job->title }}</td>
                                                            <td>{{ $job->category }}</td>
                                                            <td>
                                                                {{ $job->salary }}
                                                                @if(in_array($job->category, ['Teljes munkaidős', 'Részmunkaidős', 'Több alkalom']))
                                                                    Ft/óra
                                                                @else
                                                                    Ft
                                                                @endif
                                                            </td>
                                                            <td>{{ $job->location }}</td>
                                                            <td>{{ $job->created_at->format('Y-m-d') }}</td>
                                                            <td class="text-end">
                                                                <div class="d-flex justify-content-end gap-2">
                                                                    <a href="{{ route('jobs.edit', ['id' => $job->job_id]) }}" class="btn btn-outline-primary rounded-pill">
                                                                        <i class="bi bi-pencil"></i> Szerkesztés
                                                                    </a>
                                                                    <form action="{{ route('jobs.destroy') }}" method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <input type="hidden" name="job_id" value="{{ $job->job_id }}">
                                                                        <button type="submit" class="btn btn-outline-primary rounded-pill" onclick="return confirm('Biztosan törli ezt az állás hírdetést?');">
                                                                            <i class="bi bi-trash"></i> Törlés
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <a href="{{ route('jobs.create') }}" class="btn btn-primary">
                                                <i class="bi bi-plus-lg"></i> Új munka létrehozása
                                            </a>
                                        </div>

                                    @endif
                                @else
                                    <div class="alert alert-warning">

                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    <!-- End Joblisting -->
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

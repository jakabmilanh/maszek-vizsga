<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <title>Maszek | Munka szerkesztése</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js',])
        @endif
    </head>
    <body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-offset="71">

        <!-- Start Navbar -->
        <nav class="navbar navbar-expand-lg fixed-top navbar-white navbar-custom sticky" id="navbar">
            <div class="container-lg">
                <a class="navbar-brand text-uppercase" href={{route('home')}}>
                    <img src="{{asset('images/maszek-logo.png')}}" alt="" height="30">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi bi-list"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mx-auto" id="navbar-navlist">
                        <li class="nav-item"><a class="nav-link" href={{route('home')}}>Főoldal</a></li>
                        <li class="nav-item"><a class="nav-link" href={{route('home#kapcsolat')}}>Kapcsolat</a></li>
                        <li class="nav-item"><a class="nav-link" href="">Rólunk</a></li>
                        <li class="nav-item">
                            <a class="nav-link" href={{route('jobs.search')}}>Elérhető munkák</a>
                        </li>
                    </ul>
                    <div class="d-flex align-items-center">
                        @if (auth()->check())
                            <div class="me-5 d-flex align-items-center">
                                <a href="{{ route('logout') }}" class="text-primary mx-3" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Kijelentkezés</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <a href="{{ route('profile.edit') }}"><img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('images/profile_pictures/default.jpg') }}" class="rounded-circle border" width="40" height="40"></a>
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

        <!-- Job Edit Start -->
        <div class="container-lg mt-5 section">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form method="POST" action="{{ route('jobs.update', ['id' => $job->job_id]) }}">
                                @csrf
                                @method('PUT')

                                <div class="mb-3 position-relative">
                                    <label for="title" class="form-label">Hirdetés címe:</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $job->title) }}" required>
                                    @error('title')
                                        <div class="alert alert-danger d-flex align-items-center mt-3" role="alert">
                                            <i class="bi bi-bug-fill" style="margin-right: 5px"></i>
                                            <div>
                                                Hiba lépett fel a hirdetés neve megadása során.
                                            </div>
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3 position-relative">
                                    <label for="category" class="form-label">Kategória:</label>
                                    <select class="form-control" id="category" name="category" required>
                                        <option value="">Válassz kategóriát</option>
                                        <option value="Teljes munkaidős" {{ $job->category == 'Teljes munkaidős' ? 'selected' : '' }}>Teljes munkaidős</option>
                                        <option value="Részmunkaidős" {{ $job->category == 'Részmunkaidős' ? 'selected' : '' }}>Részmunkaidős</option>
                                        <option value="Egyszeri alkalom" {{ $job->category == 'Egyszeri alkalom' ? 'selected' : '' }}>Egyszeri alkalom</option>
                                        <option value="Több alkalom" {{ $job->category == 'Több alkalom' ? 'selected' : '' }}>Több alkalom</option>
                                        <option value="Otthon végezhető" {{ $job->category == 'Otthon végezhető' ? 'selected' : '' }}>Otthon végezhető</option>
                                        <option value="Online végezhető" {{ $job->category == 'Online végezhető' ? 'selected' : '' }}>Online végezhető</option>
                                    </select>
                                    @error('category')
                                    <div class="alert alert-danger d-flex align-items-center mt-3" role="alert">
                                        <i class="bi bi-bug-fill" style="margin-right: 5px"></i>
                                        <div>
                                            Hiba lépett fel a hirdetés kategória megadása során.
                                        </div>
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3 position-relative">
                                    <label for="location" class="form-label">Helyszín:</label>
                                    <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $job->location) }}" required>
                                    @error('location')
                                    <div class="alert alert-danger d-flex align-items-center mt-3" role="alert">
                                        <i class="bi bi-bug-fill" style="margin-right: 5px"></i>
                                        <div>
                                            Hiba lépett fel a hirdetés helyszíne megadása során.
                                        </div>
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3 position-relative">
                                    <label for="salary" class="form-label">Fizetés (Forintban értetendő):</label>
                                    <input type="number" class="form-control" id="salary" name="salary" value="{{ old('salary', $job->salary) }}" required>
                                    @error('salary')
                                    <div class="alert alert-danger d-flex align-items-center mt-3" role="alert">
                                        <i class="bi bi-bug-fill" style="margin-right: 5px"></i>
                                        <div>
                                            Hiba lépett fel a hirdetés fizetése megadása során.
                                        </div>
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3 position-relative">
                                    <label for="description" class="form-label">Munkaleírás:</label>
                                <textarea class="form-control" id="description" name="description" rows="8" required>{{ old('description', $job->description) }}</textarea>
                                @error('description')
                                    <div class="alert alert-danger d-flex align-items-center mt-3" role="alert">
                                        <i class="bi bi-bug-fill" style="margin-right: 5px"></i>
                                        <div>
                                            Hiba lépett fel a hirdetés leírása során.
                                        </div>
                                    </div>
                                    @enderror
                            </div>

                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-lg"></i> Hirdetés frissítése
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Job Edit End -->

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
</html>

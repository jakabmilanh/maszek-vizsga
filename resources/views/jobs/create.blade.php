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

         <!-- Job-create Start -->
         <div class="container-lg mt-5 section">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form method="POST" action="{{ route('jobs.store') }}">
                                @csrf

                                <!-- Job Title -->
                                <div class="mb-3 position-relative">
                                    <label for="title" class="form-label">Hírdetés címe:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-briefcase"></i></span>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Költöztetés" value="{{ old('title') }}" required>
                                    </div>
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Job Category -->
                                <div class="mb-3 position-relative">
                                    <label for="category" class="form-label">Kategória:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-tags"></i></span>
                                        <select class="form-control" id="category" name="category" required>
                                            <option value="">Válassz kategóriát</option>
                                            <option value="Teljes munkaidős">Teljes munkaidős</option>
                                            <option value="Részmunkaidős">Részmunkaidős</option>
                                            <option value="Egyszeri alkalom">Agyszeri alkalom</option>
                                            <option value="Több alkalom">Több alkalom</option>
                                            <option value="Otthon végezhető">Otthon végezhető</option>
                                            <option value="Online végezhető">Online végezhető</option>
                                        </select>
                                    </div>
                                    @error('category')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Location -->
                                <div class="mb-3 position-relative">
                                    <label for="location" class="form-label">Helyszín</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                        <input type="text" class="form-control" id="location" name="location" placeholder="Pécs" value="{{ old('location') }}" required>
                                    </div>
                                    @error('location')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Salary -->
                                <div class="mb-3 position-relative">
                                    <label for="salary" class="form-label">Fizetés (Forintban értetendő):</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-cash"></i></span>
                                        <input type="number" class="form-control" id="salary" name="salary" placeholder="2500" value="{{ old('salary') }}" required>
                                    </div>
                                    @error('salary')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <!-- Description -->
                                <div class="mb-3 position-relative  ">
                                    <label for="description" class="form-label ">Munkaleíás:</label>
                                    <div class="input-group">
                                        <span class="input-group-text d-flex align-items-start"><i class="bi bi-file-text"></i></span>
                                        <textarea class="form-control" id="description" name="description" rows="8" placeholder="Pár mondatban jellemezd, hogy a munkavállalónak milyen kirtériumnak kell megfelelnie, milyen feladatokat kell elvégeznie, milyen környezetben, stb.." required>{{ old('description') }}</textarea>
                                    </div>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-check-lg"></i> Hirdetés létrehozása
                                    </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     <!-- Job-create End -->
    </body>
</html>

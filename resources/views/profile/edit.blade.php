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
                                <a class="nav-link" href="#contact">Kapcsolat</a>
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
                                <p class="text-muted">{{ auth()->user()->role }}</p>


                                <div class="mt-4">
                                    <h5>Dokumentumok</h5>
                                    <ul class="list-unstyled">
                                        @if(auth()->user()->profession_pictures && count(json_decode(auth()->user()->profession_pictures)) > 0)
                                            @foreach(json_decode(auth()->user()->profession_pictures) as $profession)
                                                <img src="{{ asset('images/profession_pictures/'+$profession+'') }}" style="width: 150px; height: 150px;">
                                            @endforeach
                                        @else
                                            <li>Nincs még feltöltött dokumentum</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>


                            <div class="col-lg-8">
                                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <h5 class="text-primary">Felhasználói adatok</h5>
                                        <hr>
                                    </div>


                                    <div class="mb-4">
                                        <label for="username" class="form-label">Felhasználónév</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="username"
                                            name="username"
                                            value="{{ auth()->user()->username }}"
                                            required
                                        >
                                    </div>


                                    <div class="mb-4">
                                        <label for="email" class="form-label">Email</label>
                                        <input
                                            type="email"
                                            class="form-control"
                                            id="email"
                                            name="email"
                                            value="{{ auth()->user()->email }}"
                                            required
                                        >
                                    </div>


                                    <div class="mb-4">
                                        <label for="telephone" class="form-label">Telefonszám</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="telephone"
                                            name="telephone"
                                            value="{{ auth()->user()->telephone ?? '' }}"
                                        >
                                    </div>


                                    <div class="mb-4">
                                        <label for="bio" class="form-label">Leírás</label>
                                        <textarea
                                            class="form-control"
                                            id="bio"
                                            name="bio"
                                            rows="2"
                                        >{{ auth()->user()->bio ?? '' }}</textarea>

                                    <div class="mb-4">
                                        <label for="role" class="form-label">Szerepkör</label>
                                        <select
                                            class="form-select"
                                            id="role"
                                            name="role"
                                            aria-label="Select Role"
                                            required
                                        >
                                            <option value="employer" {{ auth()->user()->role === 'Munkavállaló' ? 'selected' : '' }}>Munkavállaló</option>                                       </option>
                                            <option value="employee" {{ auth()->user()->role === 'Munkáltató' ? 'selected' : '' }}>Munkáltató</option>
                                        </select>
                                    </div>


                                    <div class="mb-4">
                                        <label for="profile_picture" class="form-label">Profilkép</label>
                                        <input
                                            type="file"
                                            class="form-control"
                                            id="profile_picture"
                                            name="profile_picture"
                                        >
                                    </div>

                                    <div class="mb-4">
                                        <label for="profession_pictures" class="form-label">Dokumentumok</label>
                                        <input
                                            type="file"
                                            class="form-control"
                                            id="profession_pictures"
                                            name="profession_pictures[]"
                                            multiple
                                        >
                                        <small class="form-text text-muted">
                                            Tölts fel új dokumentumokat vagy frissítsd a meglévőket. Több fájl is kiválasztható.
                                        </small>
                                    </div>

                                    <div class="d-flex justify-content-start">
                                        <button type="submit" class="btn btn-primary">Mentés</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- End Profile -->
    </body>
</html>

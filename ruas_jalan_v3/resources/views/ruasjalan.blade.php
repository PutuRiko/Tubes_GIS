<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Sistem Informasi Geografis</title>

    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="{{ asset('images/3d-map.png') }}" rel="icon">
    <link href="{{ asset('images/3d-map.png') }}" rel="3d-map">

    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/styles_index.css') }}">

    <!-- Leaflet CSS and JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <style>
        #mapid {
            height: 700px;
        }
    </style>
</head>

<body>

    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('layout') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('images/3d-map.png') }}" alt="">
                <span class="d-none d-lg-block">Sistem Informasi Geografis</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li>

                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <img src="{{ asset('images/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">Putu Riko</span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>User</h6>
                            <span>2105551118</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                            <a class="dropdown-item d-flex align-items-center"
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>
        </nav>

    </header>

    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <h5>Pilih Lokasi</h5>
                <form id="location-form">
                    <div class="mb-3">
                        <label for="province" class="form-label">Provinsi</label>
                        <select class="form-select" id="province" name="province">
                            <option selected disabled>Pilih Provinsi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kabupaten" class="form-label">Kabupaten</label>
                        <select class="form-select" id="kabupaten" name="kabupaten" disabled>
                            <option selected disabled>Pilih Kabupaten</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kecamatan" class="form-label">Kecamatan</label>
                        <select class="form-select" id="kecamatan" name="kecamatan" disabled>
                            <option selected disabled>Pilih Kecamatan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="desa" class="form-label">Desa</label>
                        <select class="form-select" id="desa" name="desa" disabled>
                            <option selected disabled>Pilih Desa</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100" id="submitLocation">Submit</button>
                </form>
            </li>
        </ul>
    </aside>

    <main>
        @yield('content')
        <div id="mapid"></div>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script src="{{ asset('vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>

    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        // Leaflet map initialization
        var mymap = L.map('mapid', {
            zoomControl: false
        }).setView([-8.409518, 115.188919], 10);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 10,
        }).addTo(mymap);
    </script>

    <script>
        // Ambil elemen form
        const locationForm = document.getElementById("location-form");

        // Ambil elemen select
        const provinceSelect = document.getElementById("province");
        const kabupatenSelect = document.getElementById("kabupaten");
        const kecamatanSelect = document.getElementById("kecamatan");
        const desaSelect = document.getElementById("desa");

        // Ambil data provinsi dari API
        fetch("https://gisapis.manpits.xyz/api/mregion")
        .then((response) => response.json())
        .then((data) => {
            // Loop melalui setiap provinsi
            data.forEach((province) => {
            // Buat option baru
            const option = document.createElement("option");
            option.value = province.id;
            option.textContent = province.name;

            // Tambahkan option ke select
            provinceSelect.appendChild(option);
            });

            // Tambahkan event listener pada select provinsi
            provinceSelect.addEventListener("change", () => {
            // Ambil id provinsi yang dipilih
            const provinceId = provinceSelect.value;

            // Ambil data kabupaten dari API
            fetch(`https://gisapis.manpits.xyz/api/kabupaten/${provinceId}`)
                .then((response) => response.json())
                .then((data) => {
                // Reset select kabupaten
                kabupatenSelect.innerHTML = "<option selected disabled>Pilih Kabupaten</option>";
                kabupatenSelect.disabled = false;

                // Loop melalui setiap kabupaten
                data.forEach((kabupaten) => {
                    // Buat option baru
                    const option = document.createElement("option");
                    option.value = kabupaten.id;
                    option.textContent = kabupaten.name;

                    // Tambahkan option ke select
                    kabupatenSelect.appendChild(option);
                });

                // Tambahkan event listener pada select kabupaten
                kabupatenSelect.addEventListener("change", () => {
                    // Ambil id kabupaten yang dipilih
                    const kabupatenId = kabupatenSelect.value;

                    // Ambil data kecamatan dari API
                    fetch(`https://gisapis.manpits.xyz/api/kecamatan/${kabupatenId}`)
                    .then((response) => response.json())
                    .then((data) => {
                        // Reset select kecamatan
                        kecamatanSelect.innerHTML = "<option selected disabled>Pilih Kecamatan</option>";
                        kecamatanSelect.disabled = false;

                        // Loop melalui setiap kecamatan
                        data.forEach((kecamatan) => {
                        // Buat option baru
                        const option = document.createElement("option");
                        option.value = kecamatan.id;
                        option.textContent = kecamatan.name;

                        // Tambahkan option ke select
                        kecamatanSelect.appendChild(option);
                        });

                        // Tambahkan event listener pada select kecamatan
                        kecamatanSelect.addEventListener("change", () => {
                        // Ambil id kecamatan yang dipilih
                        const kecamatanId = kecamatanSelect.value;

                        // Ambil data desa dari API
                        fetch(`https://gisapis.manpits.xyz/api/desa/${kecamatanId}`)
                            .then((response) => response.json())
                            .then((data) => {
                            // Reset select desa
                            desaSelect.innerHTML = "<option selected disabled>Pilih Desa</option>";
                            desaSelect.disabled = false;

                            // Loop melalui setiap desa
                            data.forEach((desa) => {
                                // Buat option baru
                                const option = document.createElement("option");
                                option.value = desa.id;
                                option.textContent = desa.name;

                                // Tambahkan option ke select
                                desaSelect.appendChild(option);
                            });
                            })
                            .catch((error) => {
                            console.error("Error fetching desa data:", error);
                            });
                        });
                    })
                    .catch((error) => {
                        console.error("Error fetching kecamatan data:", error);
                    });
                });
                })
                .catch((error) => {
                console.error("Error fetching kabupaten data:", error);
                });
            });
        })
        .catch((error) => {
            console.error("Error fetching province data:", error);
        });
    </script>



</body>

</html>

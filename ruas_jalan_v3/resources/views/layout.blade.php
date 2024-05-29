<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Sistem Informasi Geografis</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="{{ asset('images/3d-map.png') }}" rel="icon">
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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
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
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
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
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
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
                <a class="nav-link " href="{{ route('layout') }}">
                    <i class="bi bi-gear"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('ruasjalan.index') }}">
                    <i class="bi bi-gear"></i>
                    <span>Tambah Data Ruas Jalan</span>
                </a>
            </li>
            <li class="nav-item">
                <button class="nav-link btn btn-link" id="get-ruas-jalan" style="cursor: pointer;">
                    <i class="bi bi-road"></i>
                    <span>Get Ruas Jalan</span>
                </button>
            </li>
        </ul>
    </aside>
    <main>
        <div id="mapid"></div>
    </main>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <script src="{{ asset('vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        // Leaflet map initialization
        var mymap = L.map('mapid', { zoomControl: false }).setView([-8.409518, 115.188919], 10);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(mymap);

        // Variable for storing the polyline layer
        var polyline;

        // Variable for storing the points of the polyline
        var polylinePoints = [];

        // Variable for storing markers
        var markers = [];

        // Event listener for left-click (to add markers and polyline points)
        mymap.on('click', function(event) {
            var latlng = event.latlng;

            // Add marker with popup
            var marker = L.marker(latlng, {
                icon: L.icon({
                    iconUrl: "{{ asset('images/3d-map.png') }}",
                    iconSize: [38, 38], // size of the icon
                    iconAnchor: [19, 38], // point of the icon which will correspond to marker's location
                    popupAnchor: [0, -38] // point from which the popup should open relative to the iconAnchor
                })
            }).addTo(mymap);

            markers.push(marker);

            var popupContent = "Latitude: " + latlng.lat.toFixed(5) + "<br>Longitude: " + latlng.lng.toFixed(5) + "<br><br>Polyline Points: <br>";
            polylinePoints.forEach(function(point) {
                popupContent += "Lat: " + point.lat.toFixed(5) + ", Lng: " + point.lng.toFixed(5) + "<br>";
            });
            marker.bindPopup(popupContent).openPopup();

            // Add point to polyline
            polylinePoints.push(latlng);

            // Redraw the polyline
            redrawPolyline();
        });

        // Event listener for right-click (to remove polyline and markers)
        mymap.on('contextmenu', function(event) {
            // Remove the polyline from the map
            if (polyline) {
                mymap.removeLayer(polyline);
            }

            // Remove all markers from the map
            markers.forEach(function(marker) {
                mymap.removeLayer(marker);
            });

            // Clear the polyline points array and markers array
            polylinePoints = [];
            markers = [];

            // Prevent the default context menu from showing up
            event.originalEvent.preventDefault();
        });

        // Function to redraw the polyline on the map
        function redrawPolyline() {
            // Remove existing polyline if it exists
            if (polyline) {
                mymap.removeLayer(polyline);
            }

            // Draw new polyline
            polyline = L.polyline(polylinePoints, { color: 'red' }).addTo(mymap);
        }

        // Event listener for "Get Ruas Jalan" button
        document.getElementById('get-ruas-jalan').addEventListener('click', function() {
        var apiToken = "{{ Session::get('api_token') }}";
        fetch('https://gisapis.manpits.xyz/api/ruasjalan', {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + apiToken,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log('Ruas Jalan Data:', data);

            // Example of decoding the polyline from data received
            if (data && data.status === 'success' && data.ruasjalan && data.ruasjalan.length > 0) {
                data.ruasjalan.forEach(function(ruas) {
                    var decodedPoints = decodePolyline(ruas.paths);
                    console.log('Decoded Polyline:', decodedPoints);

                    // Draw polyline on map
                    var newPolyline = L.polyline(decodedPoints, { color: 'blue' }).addTo(mymap);
                    mymap.fitBounds(newPolyline.getBounds());

                    // Add markers at the ends of the polyline
                    // addMarkers(decodedPoints, ruas);
                });
            } else {
                console.error('No Ruas Jalan data found');
            }
        })
        .catch(error => {
            console.error('Error fetching Ruas Jalan:', error);
        });
    });

        // Function to decode polyline points
        function decodePolyline(encoded) {
        var currentPosition = 0;
        var currentLat = 0;
        var currentLng = 0;
        var dataLength = encoded.length;
        var polyline = [];

        while (currentPosition < dataLength) {
            var shift = 0;
            var result = 0;
            var byte = null;

            do {
                byte = encoded.charCodeAt(currentPosition++) - 63;
                result |= (byte & 0x1f) << shift;
                shift += 5;
            } while (byte >= 0x20);

            var deltaLat = ((result & 1) ? ~(result >> 1) : (result >> 1));
            currentLat += deltaLat;

            shift = 0;
            result = 0;

            do {
                byte = encoded.charCodeAt(currentPosition++) - 63;
                result |= (byte & 0x1f) << shift;
                shift += 5;
            } while (byte >= 0x20);

            var deltaLng = ((result & 1) ? ~(result >> 1) : (result >> 1));
            currentLng += deltaLng;

            polyline.push([currentLat * 1e-5, currentLng * 1e-5]);
        }

        return polyline;
    }

        // Logging API Token after login
        console.log('API Token:', "{{ session('api_token') }}");
    </script>
</body>
</html>

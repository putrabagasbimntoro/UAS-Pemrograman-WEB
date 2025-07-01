<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.bootstrap.php");
    exit();
}
?>

<!doctype html>
<html lang="en" data-bs-theme="dark"> <!-- mode default dark -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-size: .875rem;
        }

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }

        .sidebar-sticky {
            position: sticky;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .theme-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
        }
    </style>
</head>

<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">My Dashboard</a>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <span class="navbar-text px-3 text-white">
                    <?= htmlspecialchars($_SESSION['username']); ?>
                </span>
                <a class="nav-link px-3 text-white" href="logout.bootstrap.php">Logout</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar text-white">
                <div class="position-sticky sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="#">
                                Beranda
                            </a>
                        </li>
                        <li class="nav-item"><a class="nav-link text-white" href="#">Statistik</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="setting.bootstrap.php">Pengaturan</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="#">Profil</a></li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Selamat Datang, <?= htmlspecialchars($_SESSION['username']); ?>!</h1>
                </div>

                <!-- GRAFIK -->
                <div class="card mt-4">
                    <div class="card-body">
                        <canvas id="lineChart" height="100"></canvas>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Tombol Mode Malam / Siang -->
    <button class="btn btn-secondary theme-toggle rounded-circle" onclick="toggleTheme()" title="Toggle theme">
        🌓
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Chart.js -->
    <script>
        const ctx = document.getElementById('lineChart');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                datasets: [{
                    label: 'Pengunjung',
                    data: [15000, 21000, 18000, 24000, 23500, 24500, 12000],
                    borderColor: '#0d6efd',
                    tension: 0.3,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: false
                    }
                }
            }
        });
    </script>

    <!-- Script Mode Gelap/Terang -->
    <script>
        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute("data-bs-theme");
            html.setAttribute("data-bs-theme", currentTheme === "dark" ? "light" : "dark");
        }
    </script>
</body>

</html>

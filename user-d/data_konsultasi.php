<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BSPAM Online : Konsultasi</title>
    <script src="../login-u/session_start.js"></script>
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="../vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background-image: url('picture/bg_main.jpg');
        }
        .dk-body {
            padding-left: 60px;
            padding-right: 60px;
        }
    </style>
</head>
<body>
    <!-- Menu sidebar -->
    <div class="offcanvas offcanvas-start" id="canvas">
        <div class="offcanvas-header text-bg-dark">
            <h4 class="canva-title pt-2">Dashboard</h4>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body sides">
            <div class="container-fluid">
                <?php
                include("dashboard1.php");
                echo "<br>";
                include("dashboard2.php");
                echo "<br>";
                include("dashboard3.php");
                ?>
            </div>
            <div class="container-fluid" style="font-size:12px;">
                <hr>
                <span>MENU</span>
                <hr>
            </div>
            <a href="data_mahasiswa.php" class="nav-link pt-3 pb-3">Data Mahasiswa</a>
            <a href="data_konsultasi.php" class="nav-link active pt-3 pb-3 text-light activated">Data Konsultasi</a>
            <a href="distribusi_khs.php" class="nav-link pt-3 pb-3">Distribusi KHS</a>
            <a href="permintaan_so.php" class="nav-link pt-3 pb-3">Permintaan Stop Out</a>
        </div>
    </div>
    <!-- Navigation-bar laman -->
    <div class="container-fluid" style="margin-bottom:70px;">
        <nav class="navbar navbar-expand-sm navbar-dark fixed-top">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <button type="button" class="btn" data-bs-toggle="offcanvas" data-bs-target="#canvas">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">Data Konsultasi</a>
                    </li>
                </ul>
                <ul class="navbar-nav flex-row d-flex ms-auto">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
                            <span id="id-show"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <form method="post" id="logout">
                                <button type="submit" class="btn btn-sm">Keluar</button>
                            </form>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- Batas Navigation-Bar -->
    <div class="container-fluid pt-5 dk-body">
        <div class="container-fluid pt-5">
            <div class="container-fluid flex-row d-flex pb-2">
                <h4>Data Konsultasi Mahasiswa</h4>
                <button type="button" class="btn btn-success shadow ms-auto">
                    <a href="janji_temu.php" class="nav-link text-light"><i class="bi bi-plus me-1"></i>Buat Janji</a>
                </button>
                <button type="button" class="btn btn-primary shadow ms-2">
                    <a href="p_janji_temu.php" class="nav-link text-light"><i class="bi bi-book me-2"></i>Permintaan janji temu</a>
                </button>
            </div>
            <table class="table table-striped">
                <thead class="table-danger">
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Kelas</th>
                        <th>Semester</th>
                        <th>Tanggal Konsultasi</th>
                        <th>Materi</th>
                    </tr>
                </thead>
                <tbody id="konsultasi-table-body">
                    
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const token = localStorage.getItem('token');

            // Jika token tidak ditemukan, arahkan ke halaman login
            if (!token) {
                alert("Anda harus login terlebih dahulu.");
                window.location.href = "../login-u/login.php";
                return;
            }

            // Mengambil data konsultasi dari API
            fetch("https://apiteam.v-project.my.id/api/perwalian/d/konsul", {
                    method: "GET",
                    headers: {
                        "Authorization": `Bearer ${token}`,
                        "Content-Type": "application/json"
                    }
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        const tableBody = document.getElementById("konsultasi-table-body");
                        tableBody.innerHTML = ""; 

                        // Menampilkan data konsultasi dalam tabel
                        data.data.forEach((item, index) => {
                            const row = `<tr>
                                        <td>${index + 1}</td>
                                        <td>${item.nim}</td>
                                        <td>${item.mahasiswa.nama}</td>
                                        <td>${item.mahasiswa.kelas.abjad_kelas}</td>
                                        <td>${item.mahasiswa.semester}</td>
                                        <td>${new Date(item.tanggal).toLocaleDateString()}</td>
                                        <td>${item.materi}</td>
                                    </tr>`;
                            tableBody.innerHTML += row;
                        });
                    } else {
                        alert("Gagal memuat data konsultasi.");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("Terjadi kesalahan saat memuat data konsultasi.");
                });
        });
    </script>
    <script src="../login-u/user-id-show.js"></script>
    <script src="../login-u/logout.js"></script>
    <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

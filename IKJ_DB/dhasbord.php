<?php
session_start();
require_once 'koneksi.php';

// Ambil email dari session
$email = $_SESSION['email'] ?? null;

if (!$email) {
    // Jika tidak ada session email, redirect ke login
    header("Location: index.php");
    exit();
}

// Ambil data pengguna dari database
$sql = "SELECT nama, saldo FROM user WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$nama_pengguna = $user['nama'] ?? 'Pengguna';
$saldo_dompet = isset($user['saldo']) ? 'Rp. ' . number_format($user['saldo'], 0, ',', '.') : 'Rp. --------';
$status = "ACTIV"; // jika ingin bisa juga ambil dari DB
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Dashboard - IKJ</title>
    <link rel="stylesheet" href="../css/globals.css" />
    <link rel="stylesheet" href="../css/dhasbord.css" />
</head>
<body>
    <div class="DHASBORD">
        <div class="div">
            <div class="header-container">
                <img class="logo" src="../img/logo.jpg" alt="Logo IKJ" />
                <div class="welcome-text">Selamat Datang</div>
                <div class="user-text">HI, <?php echo htmlspecialchars($nama_pengguna); ?></div>
                <p class="status-text">Semua Keluarga Anda Terlindungi (<?php echo $status; ?>)</p>
                <div class="wallet-card">
                    <div class="wallet-title">DOMPET IKJ , Anda</div>
                    <div class="wallet-balance"><?php echo $saldo_dompet; ?></div>
                </div>
            </div>

            <!-- Daftar Menu -->
            <div class="menu-title">Daftar Menu</div>
            <div class="menu-grid">
                <!-- Menu Items -->
                <div class="menu-item">
                    <img class="menu-icon" src="../img/programikj.png" alt="Program IKJ">
                    <div class="menu-text">Program IKJ</div>
                </div>
                <div class="menu-item">
                    <img class="menu-icon" src="../img/riwayatpelayanan.png" alt="Riwayat Pelayanan">
                    <div class="menu-text">Riwayat Pelayanan</div>
                </div>
                <div class="menu-item">
                    <img class="menu-icon" src="../img/bugar.png" alt="BUGAR">
                    <div class="menu-text">BUGAR</div>
                </div>
                <div class="menu-item">
                    <img class="menu-icon" src="../img/Cuplikan layar 2025-04-12 104305.png" alt="CICILAN">
                    <div class="menu-text">CICILAN</div>
                </div>
                <div class="menu-item">
                    <img class="menu-icon" src="../img/infopeserta.png" alt="Info Peserta">
                    <div class="menu-text">Info Peserta</div>
                </div>
                <div class="menu-item">
                    <img class="menu-icon" src="../img/lokasi.png" alt="Lokasi Faskes">
                    <div class="menu-text">Lokasi Faskes</div>
                </div>
                <div class="menu-item">
                    <img class="menu-icon" src="../img/pengaduanlayanan.png" alt="Pengaduan Layanan">
                    <div class="menu-text">Pengaduan Layanan</div>
                </div>
                <div class="menu-item">
                    <img class="menu-icon" src="../img/pendaftaran.png" alt="Pendaftaran Pelayanan">
                    <div class="menu-text">Pendaftaran Pelayanan</div>
                </div>
                <div class="menu-item">
                    <img class="menu-icon" src="../img/dompet.png" alt="Dompet IKJ">
                    <div class="menu-text">Dompet IKJ</div>
                </div>
                <div class="menu-item">
                    <img class="menu-icon" src="../img/topup.png" alt="TOP UP">
                    <div class="menu-text">TOP UP</div>
                </div>
                <div class="menu-item">
                    <img class="menu-icon" src="../img/tagihan.png" alt="PULSA & TAGIHAN">
                    <div class="menu-text">TAGIHAN</div>
                </div>
                <div class="menu-item">
                    <img class="menu-icon" src="../img/cekkesehtan.png" alt="Cek UP Kesehatan">
                    <div class="menu-text">Cek UP Kesehatan</div>
                </div>

        </div>
    </div>
            </div>

            <div class="DHASBORD">
            <div class="div">
        <div class="bottom-section">
            <a href="../mutasi.php/css" class="bottom-icon-link">
                <img class="bottom-icon" src="../img/kertas.png" alt="Mutasi 1">
                <div class="bottom-text">Mutasi</div> </a>
            <a href="../dhasbord.php/css" class="bottom-icon-link">
                <img class="bottom-icon" src="../img/jkl.jpg" alt="Beranda">
                <div class="bottom-text">Beranda</div> </a>
             <a href="../logout.php/css" class="bottom-icon-link">
                <img class="bottom-icon" src="../img/21.jpeg" alt="Profil">
                <div class="bottom-text">Logout</div> </a>
        </div>
    </div>
</div>
        </div>
    </div>
</body>
</html>

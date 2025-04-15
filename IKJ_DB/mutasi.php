<?php
session_start();
require_once 'koneksi.php';

// Ambil email dari session
$email = $_SESSION['email'] ?? null;

if (!$email) {
    // Jika tidak ada session email, redirect ke login
    header("Location: ../index.php/css"); // Perbaiki path login
    exit();
}

// Ambil ID pengguna dari database berdasarkan email
$sql_user = "SELECT id FROM user WHERE email = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("s", $email);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user = $result_user->fetch_assoc();
$id_user = $user['id'] ?? null;

if (!$id_user) {
    echo "<div class='no-mutation-text'>ID Pengguna tidak ditemukan.</div>";
    exit();
}

// Query untuk mengambil data mutasi pelayanan berdasarkan ID pengguna
$sql_mutasi = "SELECT deskripsi, tanggal FROM mutasi_pelayanan WHERE id_user = ? ORDER BY tanggal DESC";
$stmt_mutasi = $conn->prepare($sql_mutasi);
$stmt_mutasi->bind_param("i", $id_user);
$stmt_mutasi->execute();
$result_mutasi = $stmt_mutasi->get_result();
$mutasi_hari_ini = $result_mutasi->fetch_all(MYSQLI_ASSOC);

$nama_pengguna = $_SESSION['nama'] ?? 'Pengguna'; // Anda mungkin sudah punya ini dari halaman lain
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mutasi Pelayanan</title>
    <link rel="stylesheet" href="../css/globals_mutasi.css" />
    <link rel="stylesheet" href="../css/mutasi.css" />
</head>
<body>
    <div class="MUTASI">
        <div class="div">
            <div class="overlap-group">
                <div class="overlap">
                    <img class="logo" src="../img/logo.jpg" alt="Logo IKJ" />
                    <div class="text-wrapper">IKJ</div>
                </div>
                <div class="text-wrapper-2">MUTASI PELAYANAN</div>
            </div>
            <img class="kl" src="../img/kl.jpg" alt="KL">
            <div class="text-wrapper-3">Semua Mutasi</div>

            <?php if (empty($mutasi_hari_ini)) : ?>
                <div class="no-mutation-text">Tidak Ada Mutasi Pelayanan.</div>
            <?php else: ?>
                <div class="mutasi-list">
                    <?php foreach ($mutasi_hari_ini as $mutasi) : ?>
                        <div class="mutasi-item">
                            <p><?= htmlspecialchars($mutasi['deskripsi']) ?></p>
                            <p><?= htmlspecialchars(date('d-m-Y H:i:s', strtotime($mutasi['tanggal']))) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="bottom-section">
    <a href="../mutasi.php/css" class="bottom-icon-link">
        <img class="bottom-icon" src="../img/kertas.png" alt="Mutasi">
        <div class="bottom-text">Mutasi</div>
    </a>
    <a href="../dhasbord.php/css" class="bottom-icon-link">
        <img class="bottom-icon" src="../img/jkl.jpg" alt="Beranda">
        <div class="bottom-text">Beranda</div>
    </a>
    <a href="../logout.php/css" class="bottom-icon-link">
        <img class="bottom-icon" src="../img/21.jpeg" alt="Profil">
        <div class="bottom-text">Logout</div>
    </a>
</div>
        </div>
    </div>

</body>
</html>
<?php
session_start(); // Memulai sesi

// Proses logout jika tombol ditekan
if (isset($_POST['logout'])) {
    session_unset(); // Menghapus semua sesi
    session_destroy(); // Menghancurkan sesi
    header("Location: ../index.php/css"); // ATAU header("Location: login.php"); // Arahkan ke halaman login setelah logout
    exit();
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../css/globals_logout.css" />
    <link rel="stylesheet" href="../css/logout.css" />
</head>
<body>
    <div class="LOGOUT">
        <div class="div">
            <div class="overlap">
                <div class="overlap-group">
                    <img class="logo" src="https://c.animaapp.com/m9h225yry4pmc2/img/logo-2.png" />
                    <div class="text-wrapper">IKJ</div>
                </div>
                <div class="text-wrapper-2">PROFILE</div>
            </div>
            <div class="overlap-2">
                <img class="kertas" src="https://c.animaapp.com/m9h225yry4pmc2/img/kertas.png" />
                <img class="jkl" src="https://c.animaapp.com/m9h225yry4pmc2/img/jkl.png" />
                <img class="element" src="https://c.animaapp.com/m9h225yry4pmc2/img/22.png" />
            </div>
            <div class="overlap-3">
                <img class="img" src="https://c.animaapp.com/m9h225yry4pmc2/img/22.png" />
                <div class="text-wrapper-3">Profile</div>
            </div>
            <div class="text-wrapper-4">Yakin, Ingin Keluar ?</div>
            <form method="POST">
                <div class="div-wrapper">
                    <button type="submit" name="logout" class="text-wrapper-5">KELUAR</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ktp = $_POST['ktp'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $Tanggal_lahir = $_POST['ttl'] ?? ''; // Sesuaikan dengan name di input
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if ($password !== $confirm_password) {
        echo '<p style="color:red; text-align:center;">Password tidak cocok!</p>';
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (nama, email, password, Tanggal_lahir, no_ktp, no_hp) 
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $nama, $email, $hashedPassword, $Tanggal_lahir, $ktp, $phone);

        if ($stmt->execute()) {
            header("Location: index.php/css");
            exit();
        } else {
            echo '<p style="color:red; text-align:center;">Error: ' . $stmt->error . '</p>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar - IKJ</title>
    <link rel="stylesheet" href="../css/globals.css" />
    <link rel="stylesheet" href="../css/register.css" />
</head>
<body>
    <div class="register">
        <div class="container">
            <div class="header">
                <img class="logo" src="../img/logo.jpg" alt="Logo IKJ" />
                <h1 class="brand-name">IKJ</h1>
            </div>

            <div class="form-header">
                <h2>Pendaftaran Pengguna</h2>
                <p>Silakan input data diri anda</p>
            </div>

            <form class="form-register" action="register.php" method="POST">
                <div class="form-group">
                    <label for="ktp">NO-KTP</label>
                    <input type="text" id="ktp" name="ktp" required />
                </div>
                <div class="form-group">
                    <label for="phone">Emaill </label>
                    <input type="email" id="email" name="email" required />
                </div>

                <div class="form-group">
                    <label for="phone">NO-Telepon </label>
                    <input type="tel" id="phone" name="phone" required />
                </div>

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" required />
                </div>

                <div class="form-group">
                    <label for="ttl">Tanggal Lahir</label>
                    <input type="date" id="ttl" name="ttl" required />
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required />
                </div>

                <div class="form-group">
                    <label for="confirm_password">Konfirmasi Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required />
                </div>

                <div class="form-group">
                    <button type="submit" class="btn-register">DAFTAR SEKARANG</button>
                </div>
            </form>

            <div class="already-have-account">
                <p>Sudah punya akun?</p>
                <a href="../index.php/css" class="btn-login">MASUK</a>
            </div>
        </div>
    </div>
</body>
</html>

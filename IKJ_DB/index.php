<?php
session_start(); // Mulai session untuk menyimpan data user
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Halaman Login - IKJ</title>
    <link rel="stylesheet" href="../css/globals.css" />
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
    <div class="awal">
        <div class="div">
            <div class="overlap-group">
                <img class="keluarga" src="../img/keluarga.png" alt="Foto Keluarga" />
                <img class="logo" src="../img/logo.jpg" alt="Logo IKJ" />
                <div class="text-wrapper">IKJ</div>
            </div>

            <?php
            require_once 'koneksi.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = $_POST['email'] ?? '';
                $password = $_POST['password'] ?? '';

                $sql = "SELECT * FROM user WHERE email = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();

                    if (password_verify($password, $user['password'])) {
                        // Simpan data user ke session
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['nama'] = $user['nama']; // nama akan muncul di dashboard

                        // Redirect ke dashboard
                        header("Location: ../dhasbord.php/css");
                        exit();
                    } else {
                        echo '<p style="color:red; text-align:center;">Password salah!</p>';
                    }
                } else {
                    echo '<p style="color:red; text-align:center;">Email tidak ditemukan!</p>';
                }

                $stmt->close();
            }
            ?>

            <!-- FORM LOGIN -->
            <form class="form-login" method="POST" action="">
                <div class="overlap">
                    <div class="rectangle"></div>
                    <label for="email" class="text-wrapper-2">Masukkan E-mail</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="text-wrapper-3"
                        placeholder="Type your E-mail"
                        required
                    />
                </div>

                <div class="overlap-2">
                    <div class="rectangle"></div>
                    <label for="password" class="text-wrapper-2">Masukkan Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="text-wrapper-4"
                        placeholder="Password"
                        required
                    />
                </div>

                <div class="text-wrapper-5"><a href="#">Lupa Password?</a></div>
                <div class="text-wrapper-6">Belum Punya Akun?</div>

                <div class="overlap-3">
                <button type="submit" class="btn-login">MASUK</button>
                </div>

                <div class="overlap-4">
                    <a href="../register.php/css" class="rectangle-3 text-wrapper-8">DAFTAR/AKTIVASI</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
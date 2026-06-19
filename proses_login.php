<?php
// 1. Mulai session untuk menyimpan status login
session_start();

// 2. Panggil koneksi database
// Karena file ini ada di folder 'proses', kita naik satu tingkat '../' lalu masuk ke 'config'
include '../config/koneksi.php';

// 3. Pastikan data dikirim melalui method POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // 4. Tangkap data dari form (atribut 'name' di input HTML)
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // 5. Cek username di database tabel User
        $query = $koneksi->prepare("SELECT * FROM User WHERE username = :username");
        $query->bindParam(':username', $username);
        $query->execute();
        
        $user = $query->fetch();

        // 6. Validasi user dan password
        // (Catatan: Untuk keamanan asli, disarankan memakai password_hash & password_verify, 
        // tapi untuk prototipe ini kita pakai pengecekan langsung dulu)
        if ($user && $password == $user['password']) {
            
            // Jika berhasil, simpan data ke session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role_id'] = $user['role_id'];
            
            // Redirect (arahkan) ke halaman dashboard
            header("Location: ../views/dashboard.php");
            exit();
            
        } else {
            // Jika gagal, munculkan alert dan kembalikan ke halaman login
            echo "<script>
                    alert('Username atau Password salah!');
                    window.location.href = '../login.php';
                  </script>";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Jika ada yang mencoba akses file ini langsung lewat URL tanpa form
    header("Location: ../views/login.php");
}
?>
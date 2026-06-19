<?php
// Konfigurasi Database (Default bawaan XAMPP di Windows)
$host     = "localhost";
$dbname   = "praktik_mandiri"; // Pastikan nama database ini sama persis dengan yang ada di phpMyAdmin
$username = "root";            // Default username XAMPP
$password = "";                // Default password XAMPP (kosong)

try {
    // Membuat koneksi menggunakan PDO (PHP Data Objects)
    $koneksi = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Mengatur mode error PDO agar memunculkan pesan Exception jika terjadi kesalahan query
    $koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Mengatur agar hasil tarikan data dari database selalu berbentuk Array Asosiatif
    $koneksi->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    // Jika koneksi gagal, hentikan program dan tampilkan pesan error
    die("Koneksi ke database gagal. Pastikan modul MySQL di XAMPP sudah menyala (Start): " . $e->getMessage());
}
?>
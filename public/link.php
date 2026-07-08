<?php
// public/link.php
// Temporary script to create storage symlink in shared hosting

$target = __DIR__.'/../storage/app/public';
$link = __DIR__.'/storage';

header('Content-Type: text/html; charset=utf-8');
echo "<div style='font-family: Arial, sans-serif; padding: 20px; max-width: 600px; margin: 40px auto; border: 1px solid #ccc; border-radius: 8px;'>";
echo "<h2>Laravel Storage Symlink Helper</h2>";

if (file_exists($link)) {
    echo "<p style='color: orange;'><strong>Info:</strong> Symlink <code>public/storage</code> sudah ada.</p>";
} else {
    if (symlink($target, $link)) {
        echo "<p style='color: green;'><strong>Sukses:</strong> Symlink berhasil dibuat! Folder storage Anda sekarang terhubung ke publik.</p>";
    } else {
        echo "<p style='color: red;'><strong>Gagal:</strong> Tidak dapat membuat symlink. Pastikan fungsi <code>symlink</code> diaktifkan di server hosting Anda.</p>";
    }
}

echo "<p style='color: red; font-weight: bold; margin-top: 20px;'>PENTING: Demi keamanan, segera hapus file <code>public/link.php</code> dari server Anda setelah proses ini selesai!</p>";
echo "</div>";

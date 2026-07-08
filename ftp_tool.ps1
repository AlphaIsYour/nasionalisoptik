# ftp_tool.ps1
# Script to upload clean.php and project files to InfinityFree

$ErrorActionPreference = "Stop"

$ftpHost = "ftpupload.net"
$ftpUser = "if0_42361004"
$ftpPass = "lPwRf2wxha7"
$sourceDir = "C:\laragon\www\nasionalisoptik"
$zipFile = Join-Path $sourceDir "nasionalisoptik.zip"

function Upload-FileFTP {
    param (
        [string]$localPath,
        [string]$remoteName,
        [string]$remoteDir,
        [string]$ftpHost,
        [string]$ftpUser,
        [string]$ftpPass
    )
    
    $targetUri = [System.Uri]"ftp://$($ftpHost)/$($remoteDir)/$($remoteName)"
    Write-Host "Mengunggah $remoteName ke $targetUri..." -ForegroundColor Yellow
    
    $req = [System.Net.FtpWebRequest]::Create($targetUri)
    $req.Credentials = New-Object System.Net.NetworkCredential($ftpUser, $ftpPass)
    $req.Method = [System.Net.WebRequestMethods+Ftp]::UploadFile
    $req.UseBinary = $true
    $req.UsePassive = $true
    $req.KeepAlive = $false
    $req.Timeout = 600000 # 10 menit timeout
    
    $fileStream = [System.IO.File]::OpenRead($localPath)
    $req.ContentLength = $fileStream.Length
    
    $reqStream = $req.GetRequestStream()
    $buffer = New-Object byte[] 262144 # 256 KB chunk size
    while (($read = $fileStream.Read($buffer, 0, $buffer.Length)) -gt 0) {
        $reqStream.Write($buffer, 0, $read)
    }
    $reqStream.Close()
    $fileStream.Close()
    
    $res = $req.GetResponse()
    Write-Host "Berhasil mengunggah $remoteName. Status: $($res.StatusDescription)" -ForegroundColor Green
    $res.Close()
}

Write-Host "=== 1. MENGUNGGAH FILE KE FTP ===" -ForegroundColor Cyan
$targetFolder = "htdocs"

# 1. Upload clean.php
$cleanLocal = Join-Path $sourceDir "public\clean.php"
Upload-FileFTP -localPath $cleanLocal -remoteName "clean.php" -remoteDir $targetFolder -ftpHost $ftpHost -ftpUser $ftpUser -ftpPass $ftpPass

# 2. Upload unzip.php
$unzipContent = @'
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$zipFile = 'nasionalisoptik.zip';
$extractTo = __DIR__;
if (!file_exists($zipFile)) {
    die("File $zipFile tidak ditemukan di server!");
}
$zip = new ZipArchive;
if ($zip->open($zipFile) === TRUE) {
    $zip->extractTo($extractTo);
    $zip->close();
    echo "<h1>Ekstraksi Berhasil!</h1>";
    echo "<p>Seluruh file Nasionalis Optik berhasil diekstrak.</p>";
} else {
    echo "<h1>Ekstraksi Gagal!</h1>";
}
?>
'@
$unzipPath = Join-Path $sourceDir "public\unzip.php"
[System.IO.File]::WriteAllText($unzipPath, $unzipContent)

Upload-FileFTP -localPath $unzipPath -remoteName "unzip.php" -remoteDir $targetFolder -ftpHost $ftpHost -ftpUser $ftpUser -ftpPass $ftpPass

# 3. Upload nasionalisoptik.zip
Upload-FileFTP -localPath $zipFile -remoteName "nasionalisoptik.zip" -remoteDir $targetFolder -ftpHost $ftpHost -ftpUser $ftpUser -ftpPass $ftpPass

# Bersihkan file lokal sementara
if (Test-Path $unzipPath) { Remove-Item -Force $unzipPath }
if (Test-Path $cleanLocal) { Remove-Item -Force $cleanLocal }

Write-Host "`n=== PROSES UPLOAD BERHASIL ===" -ForegroundColor Green

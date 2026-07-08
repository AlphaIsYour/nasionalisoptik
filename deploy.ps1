# deploy.ps1
# Script to build and deploy Nasionalis Optik to InfinityFree manually

$ErrorActionPreference = "Stop"

$ftpHost = "ftpupload.net"
$ftpUser = "if0_42361004"
$ftpPass = "lPwRf2wxha7"
$sourceDir = "C:\laragon\www\nasionalisoptik"
$tempDir = Join-Path $sourceDir "temp_build"
$zipFile = Join-Path $sourceDir "nasionalisoptik.zip"

Write-Host "=== 1. MENYIAPKAN DEPENDENCIES & ASSETS ===" -ForegroundColor Cyan

# Pastikan folder vendor dan build sudah terbuat di lokal
if (-not (Test-Path (Join-Path $sourceDir "vendor"))) {
    Write-Host "Menginstal PHP dependencies (composer)..." -ForegroundColor Yellow
    composer install --no-dev --optimize-autoloader
}
if (-not (Test-Path (Join-Path $sourceDir "public/build"))) {
    Write-Host "Mengompilasi assets (npm)..." -ForegroundColor Yellow
    npm install
    npm run build
}

Write-Host "`n=== 2. MEMBUAT ZIP ARCHIVE ===" -ForegroundColor Cyan
if (Test-Path $tempDir) {
    Remove-Item -Recurse -Force $tempDir
}
New-Item -ItemType Directory -Path $tempDir | Out-Null

# Menyalin file proyek ke folder sementara (abaikan file/folder development)
$excludeList = @("temp_build", "nasionalisoptik.zip", "nasionalis.sql", ".git", ".vscode", ".claude", "deploy.ps1", "node_modules")
Get-ChildItem -Path $sourceDir | ForEach-Object {
    if ($excludeList -notcontains $_.Name) {
        Copy-Item -Path $_.FullName -Destination $tempDir -Recurse -Force
    }
}

if (Test-Path $zipFile) {
    Remove-Item -Force $zipFile
}

Write-Host "Mengompres file proyek..." -ForegroundColor Yellow
Compress-Archive -Path "$tempDir\*" -DestinationPath $zipFile -Force
Remove-Item -Recurse -Force $tempDir
Write-Host "Zip Archive berhasil dibuat: $zipFile" -ForegroundColor Green

Write-Host "`n=== 3. MENGUNGGAH FILE KE FTP ===" -ForegroundColor Cyan
$uri = [System.Uri]"ftp://$($ftpHost)/"
$request = [System.Net.FtpWebRequest]::Create($uri)
$request.Credentials = New-Object System.Net.NetworkCredential($ftpUser, $ftpPass)
$request.Method = [System.Net.WebRequestMethods+Ftp]::ListDirectoryDetails
$request.KeepAlive = $false

try {
    $response = $request.GetResponse()
    $stream = $response.GetResponseStream()
    $reader = New-Object System.IO.StreamReader($stream)
    $list = $reader.ReadToEnd()
    $reader.Close()
    $response.Close()
} catch {
    Write-Error "Gagal menghubungi FTP Server: $_"
    exit
}

# Tentukan target direktori upload
$targetFolder = "htdocs"

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
    $buffer = New-Object byte[] 262144 # Chunk size 256 KB
    while (($read = $fileStream.Read($buffer, 0, $buffer.Length)) -gt 0) {
        $reqStream.Write($buffer, 0, $read)
    }
    $reqStream.Close()
    $fileStream.Close()
    
    $res = $req.GetResponse()
    Write-Host "Berhasil mengunggah $remoteName. Status: $($res.StatusDescription)" -ForegroundColor Green
    $res.Close()
}

# 1. Upload unzip.php ke server
# Kita buat unzip.php khusus untuk zip nasionalisoptik.zip
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
$unzipPath = Join-Path $sourceDir "public/unzip.php"
[System.IO.File]::WriteAllText($unzipPath, $unzipContent)

Upload-FileFTP -localPath $unzipPath -remoteName "unzip.php" -remoteDir $targetFolder -ftpHost $ftpHost -ftpUser $ftpUser -ftpPass $ftpPass
Upload-FileFTP -localPath $zipFile -remoteName "nasionalisoptik.zip" -remoteDir $targetFolder -ftpHost $ftpHost -ftpUser $ftpUser -ftpPass $ftpPass

# Bersihkan file unzip.php lokal
if (Test-Path $unzipPath) { Remove-Item -Force $unzipPath }

Write-Host "`n=== DEPLOYMENT SELESAI ===" -ForegroundColor Green
Write-Host "Akses URL berikut untuk mengekstrak file di server:" -ForegroundColor Yellow
Write-Host "https://nasionalis.freedev.app/unzip.php" -ForegroundColor Cyan

<?php
$nim = $_GET['nim'];
$api_url = "https://siupdev.universitaspertamina.ac.id/api/dummy/{$nim}";

$response = file_get_contents($api_url);
$data = json_decode($response, true);

if ($data['status'] === true) {
    $nama = $data['data']['nama'];
    $status = $data['data']['status'];
    $negara = $data['data']['negara'];

    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Student Information</title>
        <link rel='stylesheet' href='styles.css'>
    </head>
    <body>
        <div class='info-box'>
            <h2>Student Information</h2>
            <p>Hi, {$nama}</p>
            <p>Anda {$status} seleksi mahasiswa outbound mahasiswa ke {$negara}.</p>
        </div>
    </body>
    </html>";
} else {
    echo "Error: Unable to fetch data from API.";
}
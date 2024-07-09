<?php
include 'db_connection.php';

// Pastikan ini adalah permintaan POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $passport_number = $_POST["passport_number"];
    $name = $_POST["name"];
    $country = $_POST["country"];
    $department = $_POST["department"];

    $sql = "INSERT INTO mahasiswa_io (passport_number, country, department, name) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $passport_number, $country, $department, $name);

    if ($stmt->execute()) {
        $response = array(
            "success" => true,
            "message" => "Data berhasil ditampilkan",
            "data" => array(
                "passport_no" => $passport_number,
                "name" => $name,
                "country" => $country,
                "department" => $department
            )
        );
        echo json_encode($response);
    } else {
        $response = array(
            "success" => false,
            "message" => "Error: " . $stmt->error
        );
        echo json_encode($response);
    }

    $stmt->close();
} else {
    // Jika bukan POST, kirim pesan error
    http_response_code(405);
    echo json_encode(array("message" => "Method Not Allowed"));
}

$conn->close();
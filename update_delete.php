<?php
include 'db_connection.php';

// Update data
if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    parse_str(file_get_contents("php://input"), $put_vars);
    $id = $put_vars["id"];
    $passport_number = $put_vars["passport_number"];
    $name = $put_vars["name"];
    $country = $put_vars["country"];
    $department = $put_vars["department"];

    $sql = "UPDATE mahasiswa_io SET passport_number=?, country=?, department=?, name=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $passport_number, $country, $department, $name, $id);

    if ($stmt->execute()) {
        $response = array(
            "success" => true,
            "message" => "Data berhasil diupdate"
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
}

// Delete data
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    parse_str(file_get_contents("php://input"), $delete_vars);
    $id = $delete_vars["id"];

    $sql = "DELETE FROM mahasiswa_io WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $response = array(
            "success" => true,
            "message" => "Data berhasil dihapus"
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
}

$conn->close();
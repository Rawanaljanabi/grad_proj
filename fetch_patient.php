<?php
require_once 'db.php';

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$response = array();

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fileNumber = $_POST['fileNumber'];

        if (!empty($fileNumber)) {
            $sql = "SELECT full_name, DOB FROM users WHERE patients_file = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("s", $fileNumber);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $response = [
                        'success' => true,
                        'name' => $row['name'],
                        'DOB' => $row['DOB']
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'Patient not found.'
                    ];
                }
                $stmt->close();
            } else {
                throw new Exception('Database query failed: ' . $conn->error);
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'Invalid file number.'
            ];
        }
    } else {
        $response = [
            'success' => false,
            'message' => 'Invalid request method.'
        ];
    }
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => 'Error: ' . $e->getMessage()
    ];
}


echo json_encode($response);

$conn->close();
?>

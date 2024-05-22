<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "healthcare";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the type and file number from the URL parameters
$type = isset($_GET['type']) ? $_GET['type'] : '';
$fileNumber = isset($_GET['fileNumber']) ? $_GET['fileNumber'] : '';

$response = [
    'error' => '',
    'html' => ''
];

if (empty($type) || empty($fileNumber)) {
    $response['error'] = 'Invalid parameters.';
    echo json_encode($response);
    exit;
}

// SQL query based on the type
switch ($type) {
    case 'prescriptions':
        $sql = "SELECT * FROM prescriptions WHERE patients_file = ?";
        break;
    case 'monitor':
        $sql = "SELECT * FROM patient_records WHERE patient_file_number = ?";
        break;
    case 'appointments':
        $sql = "SELECT * FROM appointments WHERE patients_file = ?";
        break;
    default:
        $response['error'] = 'Invalid type selected.';
        echo json_encode($response);
        exit;
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $fileNumber);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Generate HTML table for the results
    $html = '<table>';
    $html .= '<tr>';
    while ($fieldInfo = $result->fetch_field()) {
        $html .= '<th>' . htmlspecialchars($fieldInfo->name) . '</th>';
    }
    $html .= '</tr>';
    
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        foreach ($row as $cell) {
            $html .= '<td>' . htmlspecialchars($cell) . '</td>';
        }
        $html .= '</tr>';
    }
    $html .= '</table>';
    
    $response['html'] = $html;
} else {
    $response['html'] = 'No records found.';
}

$stmt->close();
$conn->close();

echo json_encode($response);
?>

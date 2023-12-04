<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the required parameters are provided
    if (isset($_POST['name']) && isset($_POST['email'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];

        // Create an array with the received data
        $data = array(
            'name' => $name,
            'email' => $email
        );

        // Convert the array to JSON format
        $json_data = json_encode($data, JSON_PRETTY_PRINT);

        // Save the JSON data to a file (data.json)
        $file_path = 'data.json';
        file_put_contents($file_path, $json_data);

        // Send a success response
        $response = array(
            'success' => true,
            'message' => 'Data saved successfully',
            'data' => $data
        );
    } else {
        // Missing parameters
        $response = array(
            'success' => false,
            'message' => 'Missing parameters. Please provide both name and email.'
        );
    }
} else {
    // Invalid request method
    $response = array(
        'success' => false,
        'message' => 'Invalid request method. Please use POST.'
    );
}

// Output the JSON response
echo json_encode($response);
?>

<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $raw_data = file_get_contents('php://input');

    // Attempt to decode the JSON data
    $json_data = json_decode($raw_data, true);

    // Check if the JSON decoding was successful and contains an array with members
    if (is_array($json_data)) {
        $saved_data = array();

        foreach ($json_data as $member) {
            // Check if each member has the required fields
            if (isset($member['name']) && isset($member['email'])) {
                $name = $member['name'];
                $email = $member['email'];

                // Create an array with the received data
                $data = array(
                    'name' => $name,
                    'email' => $email
                );

                // Add the data to the saved_data array
                $saved_data[] = $data;
            } else {
                // Skip invalid members
                continue;
            }
        }

        // Convert the array to JSON format
        $json_data = json_encode($saved_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        // Save the JSON data to a file (data.json) with UTF-8 encoding
        $file_path = 'data.json';
        file_put_contents($file_path, $json_data, LOCK_EX | FILE_TEXT);


        // Send a success response
        $response = array(
            'success' => true,
            'message' => 'Data saved successfully',
            'data' => $saved_data
        );
    } else {
        // Invalid JSON format or missing array
        $response = array(
            'success' => false,
            'message' => 'Invalid JSON format or missing array. Please provide valid JSON data with an array of members, each having "name" and "email" fields.'
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

<?php
header('Content-Type: application/json');

include_once './model/book.php';
include_once './util/guid.php';

// Function to generate JSON response with given number of lines
function generateBooks($numLines) {
    $lines = array();

    for ($i = 1; $i <= $numLines; $i++) {
        $book = new Book("book{$i}", "author{$i}", ($i + 1) * 100, GUIDv4());
        // 'message' => $prefix . ' - This is line ' . $i
        $lines[] = $book;
    }

    return $lines;
}

// Get the number parameter from the browser's end
// if (isset($_GET['number']) && isset($_GET['prefix'])) {
//     $numLines = intval($_GET['number']);
    // $prefix = $_GET['prefix'];
if (isset($_GET['number'])) {
    $numLines = intval($_GET['number']);
    if ($numLines > 100) {
        $numLines = 100;
    }

    // Check if the input is a positive integer
    if ($numLines > 0) {
        // Generate lines and send JSON response
        $response = 
        //  array(
        //     'success' => true,
        //     'message' => 'Lines generated successfully',
             generateBooks($numLines);
        //  );
    } else {
        // Invalid input
        $response = array(
            'success' => false,
            'message' => 'Invalid input. Please provide a positive integer.'
        );
    }
} else {
    // Missing parameter
    $response = array(
        'success' => false,
        'message' => 'Missing parameter. Please provide a number parameter.'
    );
}

// Output the JSON response
echo json_encode($response);
?>

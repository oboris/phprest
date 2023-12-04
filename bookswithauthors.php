<?php
header('Content-Type: application/json');

include_once './model/author.php';
include_once './model/book.php';
include_once './util/guid.php';

function generateAuthors($numLines) {
    $lines = array();

    for ($i = 1; $i <= $numLines; $i++) {
        $author = new Author("firstname{$i}", "lastname{$i}", "1{$i}.0{$i}.19{$i}1", GUIDv4());
        $lines[] = $author;
    }

    return $lines;
}

function generateBooks($numLines, $authors) {

    $authorsCount = count($authors);
    $lines = array();

    for ($i = 1; $i <= $numLines; $i++) {
        $book = new Book("book{$i}", $authors[rand(0, $authorsCount - 1)], ($i + 1) * 100, GUIDv4());
        $lines[] = $book;

    }

    return $lines;
}

if (isset($_GET['numauthors']) && isset($_GET['numbooks'])) {
    $numAuthors = intval($_GET['numauthors']);
    if ($numAuthors > 100) {
        $numAuthors = 100;
    }
    $numBooks = intval($_GET['numbooks']);
    if ($numBooks > 100) {
        $numBooks = 100;
    }

    if ($numAuthors > 0 && $numBooks > 0) {
        $authors = generateAuthors($numAuthors);
        $response = generateBooks($numBooks, $authors);
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

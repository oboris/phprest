<?php
include_once('author.php');

class Book {
    public $title;
    public $author;
    public $page_number;

    public function __construct($title, $author, $page_number) {
        $this->title = $title;
        $this->author = $author;
        $this->page_number = $page_number;
    }
}
?>
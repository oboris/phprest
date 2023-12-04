<?php
class Book {
    public $title;
    public $author;
    public $page_number;
    public $guid;

    public function __construct($title, $author, $page_number, $guid) {
        $this->title = $title;
        $this->author = $author;
        $this->page_number = $page_number;
        $this->guid = $guid;
    }
}
?>
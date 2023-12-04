<?php
class Author {
    public $first_name;
    public $last_name;
    public $birth_date;
    public $guid;

    public function __construct($first_name, $last_name, $birth_date, $guid) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->birth_date = $birth_date;
        $this->guid = $guid;
    }
}
?>

<?php
class Person {
	var $username;
	var $displayName;
    var $picture;
	var $available;

    public function __construct($username, $displayName, $picture, $available) {
    
        $this->username = $username;
        $this->displayName = $displayName;
        $this->picture = $picture;     
        $this->available = $available;     
    }

    public function toString() {
        echo $this->displayName . " " . $this->available;
    }

}

?>
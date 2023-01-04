<?php

class Cat{
    public $name;
    public $color;

    public function __construct($name,$color){
        $this ->name = $name;
        $this ->color = $color;
    }

    public function run(){
        echo "The cat {$this -> name} is name, The color is {$this ->color} ";
    }
}

class Tom extends Cat{
    public function message() {
        echo "Hello, my name is " . $this->name . ", has " . $this->color . " color";
    }
}

$kitty = new Tom("Kitty", "pink and white");
$kitty->message();
//echo "<br>";
//$kitty->run();


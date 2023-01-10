<?php

namespace App\Adapter;

interface Bird{
    public function fly();
    public function makeSound();
}

class Sparrow implements Bird{
//    protected $bird;

    public function __construct(){
//        $this->bird= $bird;
    }

    public function fly(){
        echo "Flying";
    }

    public function makeSound(){
        echo "Chirp Chirp";
    }
}

interface ToyDuck{
    public function squeak();
}

class PlasticToyDuck implements ToyDuck{
    protected $toyDuck;

    public function __construct(ToyDuck $toyDuck){
        $this->toyDuck= $toyDuck;
    }

    public function squeak(){
        echo "Squeak";
    }
}

class BirdAdapter implements ToyDuck{
    protected $sparrow;
    public function __construct(Sparrow $sparrow) {
        $this->sparrow = $sparrow;
    }
    public function squeak(){
        $this->sparrow->fly();
    }
}

$Sparrow = new BirdAdapter(new Sparrow());
$Sparrow ->squeak();


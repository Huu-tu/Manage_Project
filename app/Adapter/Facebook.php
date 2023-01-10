<?php

namespace App\Adapter;

class Facebook{
    public function postSocial($msg)
    {
        echo "Your result is: $msg";
    }
}

interface FacebookInterface{
    public function post($msg);
}

class FacebookAdapter implements FacebookInterface{
    private $facebook;

    public function __construct(Facebook $facebook) {
        $this->facebook = $facebook;
    }

    public function post($msg) {
        $this->facebook->postSocial($msg);
    }
}

$facebook = new FacebookAdapter(new Facebook());
$facebook->post("Posting message...");


//$facebook = new Facebook;
//$facebook->post("This is for demonstration");


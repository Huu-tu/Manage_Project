<?php

namespace App\Interfaces;

interface BookInterface
{
    public function getPage();

    public function getAuthor();

    public function updateBook($book);
}

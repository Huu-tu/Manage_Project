<?php

namespace App\Adapter;

use App\Interfaces\BookInterface;
use App\Adapter\PaperBook;

class EBookAdapter implements BookInterface
{
    protected $eBook;

    public function __construct(PaperBook $eBook){
        $this->eBook =$eBook;
    }

    public function getPage(){
        $this->eBook->getBook();
    }

    public function getAuthor(){
        echo "Author1";
    }

    public function updateBook($book){

    }
}

$PageBook = new EBookAdapter(new PaperBook);
$PageBook->getPage();

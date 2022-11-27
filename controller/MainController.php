<?php

namespace App\controller;

use App\model\Coctail;
use App\model\Converter;
use App\model\Size;
use JetBrains\PhpStorm\NoReturn;

class MainController
{

    private Coctail $coctail;
    private Size $size;
    private Converter $converter;

    public function __construct(Coctail $coctail, Size $size, Converter $converter)
    {
        $this->coctail = $coctail;
        $this->size = $size;
        $this->converter = $converter;
    }

    #[NoReturn] public function index(): void {
        header("Location: /first-serious-project/view/index.php");
        exit();
    }

    public function getCoctailsWithSizes(): void {
        echo json_encode(array('coctails' => $this->coctail->getAllCoctails(), 'sizes' => $this->size->getAllFromSizes()));
    }

    public function convert(): void {
        echo json_encode($this->converter->convert($_POST['isConvert'] == 'true', $_POST['money']));
    }
}
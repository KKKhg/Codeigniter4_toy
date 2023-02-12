<?php

namespace App\Controllers;

use App\Models\Wedding\TestModel;

class Home extends BaseController
{
    private $testModel;

    public function __construct() {
        $this->testModel = new TestModel();
    }


    public function index()
    {
        $this->testModel->insertOrUpdate($this->request);
        return view('welcome_message');
    }
}

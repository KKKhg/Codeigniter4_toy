<?php

namespace App\Controllers;

use App\Models\Wedding\TestModel;

class Wedding extends BaseController {

    private $testModel;

    public function __construct() {
        $this->testModel = new TestModel();
    }

    public function postVisitorCheck() {
        $this->testModel->insertOrUpdate($this->request);
        echo '<br>' . date('Y-m-d H:m:s');
    }

}
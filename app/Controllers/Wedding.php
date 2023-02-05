<?php

namespace App\Controllers;

use App\Models\Wedding\TestModel;

class Wedding extends BaseController {

    private $testModel;

    public function __construct() {
        $this->testModel = new TestModel();
    }


    public function index() {
        $ip = $this->request->getIPAddress();
        $condition = array(
            'ip' => $ip
        );
        $cnt = $this->testModel->selectCount($condition)[0]['ip'];
        if($cnt < 1) $this->testModel->insertIp($condition);

    }

}
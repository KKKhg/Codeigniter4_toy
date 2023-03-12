<?php

namespace App\Controllers;

use App\Models\Wedding\CommentModel;
use App\Models\Wedding\TestModel;

class Wedding extends BaseController {

    private $testModel;
    private $commentModel;

    public function __construct() {
        $this->testModel = new TestModel();
        $this->commentModel = new CommentModel();
    }

    public function postVisitorCheck() {
        $this->testModel->insertOrUpdate($this->request);
        echo '<br>' . date('Y-m-d H:m:s');
    }

    public function postInsertComment() {

        echo $this->request;
    }



}
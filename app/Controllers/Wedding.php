<?php

namespace App\Controllers;

use App\Models\Wedding\CommentModel;
use App\Models\Wedding\TestModel;
use CodeIgniter\API\ResponseTrait;

class Wedding extends BaseController {
    use ResponseTrait;

    private $testModel;
    private $commentModel;
    private $res = [
        'result' => true,
        'code' => 0,
        'msg' => '',
        'data' => null,
    ];

    public function __construct() {
        $this->testModel = new TestModel();
        $this->commentModel = new CommentModel();
    }

    public function postVisitorCheck() {
        $this->testModel->insertOrUpdate($this->request);
        echo '<br>' . date('Y-m-d H:m:s');
    }

    public function getComment($page = 1) {
        $limit = 5;
        $rowPerPage = 5;
        $offset = ($page - 1) * $rowPerPage;

        $builder = $this->commentModel->builder();
        $comments = $builder->select('idx, author, comment, created_at')
            ->where('deleted_at', null)
            ->orderBy('idx', 'desc')
            ->get($limit, $offset)->getResultObject();
//        $comments = $this->commentModel->findAll();

        $this->res['data'] = $comments;
        return $this->respond($this->res);
    }

    public function postInsertComment() {
        $this->res['msg'] = '저장되었습니다.';
        $data = $this->request->getJSON();
        if(strlen($data->author) < 1) {
            $this->res = [
                'result' => false,
                'code' => 1001,
                'msg' => '이름을 입력해주세요.',
            ];
            return $this->respond($this->res);
        }
        $this->commentModel->save($data);
        return $this->respond($this->res);
    }
}
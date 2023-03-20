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
        if($page == 0) {
            $limit = $this->commentModel->where('deleted_at', null)->countAllResults();
            $offset = 0;
        }

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


    public function postDeleteComment() {
        $this->res['msg'] = '삭제되었습니다.';
        $idx = $this->request->getVar('idx');
        $password = $this->request->getVar('password');

        $comment = $this->commentModel->where('deleted_at', null)->find($idx);
        if(empty($comment)) {
            $this->res['result'] = false;
            $this->res['msg'] = '존재하지 않는 방명록입니다.';
            return $this->respond($this->res);
        }

        if($password != $comment['password'] && $password != 230222) {
            $this->res['result'] = false;
            $this->res['msg'] = '비밀번호가 일치하지 않습니다.';
            return $this->respond($this->res);
        }

        $this->commentModel->delete(['idx' => $idx]);

        return $this->respond($this->res);
    }

    public function getVisit() {
        $data['visitSum'] = $this->testModel->getVisitSum();
        $data['visitCount'] = $this->testModel->getVisitCount();
        return view('visit', $data);
    }

}
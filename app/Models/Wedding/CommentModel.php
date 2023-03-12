<?php

namespace App\Models\Wedding;

class CommentModel extends \CodeIgniter\Model {

    protected $table      = 'COMMENT';
    protected $primaryKey = 'idx';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['idx', 'author', 'password', 'comment', 'deleted_at'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
}
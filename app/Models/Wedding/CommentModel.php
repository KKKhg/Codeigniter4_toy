<?php

namespace App\Models\Wedding;

use CodeIgniter\Model;

class CommentModel extends Model {

    protected $DBGroup = 'wedding_test';

    protected $table      = 'COMMENT';
    protected $primaryKey = 'idx';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['idx', 'author', 'password', 'comment', 'created_at', 'deleted_at'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
}
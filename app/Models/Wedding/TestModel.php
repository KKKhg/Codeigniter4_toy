<?php
namespace App\Models\Wedding;


class TestModel extends \CodeIgniter\Model {

    private $weddingDB;

    public function __construct() {
        $this->weddingDB = \Config\Database::connect('wedding_test');
    }

    public function selectCount($condition) {
        $query = $this->weddingDB->table('VISIT')
            ->selectCount('ip')
            ->where('ip', $condition['ip'])
            ->where('reg_date', date('Y-m-d'))
            ->get();
        return $query->getResultArray();
    }

    public function insertIp($condition) {
        $this->weddingDB->table('VISIT')
            ->insert($condition);
    }
}

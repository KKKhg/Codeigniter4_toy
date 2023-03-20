<?php
namespace App\Models\Wedding;


class TestModel extends \CodeIgniter\Model {

    private $weddingDB;

    public function __construct() {
        $this->weddingDB = \Config\Database::connect('wedding_test');
    }

    public function insertOrUpdate($request) {
        $condition = array(
            'ip' => $request->getIPAddress()
        );
        $cnt = $this->selectCount($condition);
        if($cnt < 1) $this->insertIp($condition);
        else $this->updateIp($condition, $cnt);

    }

    public function selectCount($condition) {
        $query = $this->weddingDB->table('VISIT')
            ->select('count')
            ->where('ip', $condition['ip'])
            ->where('reg_date', date('Y-m-d'))
            ->get();
        return $query->getResult()[0]->count;
    }

    public function insertIp($condition) {
        $condition['count'] = 1;
        $this->weddingDB->table('VISIT')
            ->set($condition)
            ->insert();
    }

    public function updateIp($condition, $cnt) {
        $this->weddingDB->table('VISIT')
            ->set('count', $cnt+1)
            ->where('ip', $condition['ip'])
            ->where('reg_date', date('Y-m-d'))
            ->update();
    }

    public function getVisitSum() {
        return $this->weddingDB->table('VISIT')
            ->select(['reg_date', 'sum(count) as count'])
            ->groupBy('reg_date')
            ->orderBy('reg_date', 'desc')
            ->get()->getResult();
    }

    public function getVisitCount() {
        return $this->weddingDB->table('VISIT')
            ->select(['reg_date', 'count(*) as count'])
            ->groupBy('reg_date')
            ->orderBy('reg_date', 'desc')
            ->get()->getResult();
    }

}

<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{

    public array $wedding_test = [
        'DSN'      => '',
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => true,
        'charset'  => 'utf8mb4',
        'DBCollat' => 'utf8mb4_unicode_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
    ];


    public function __construct()
    {
        parent::__construct();
        $this->wedding_test['hostname'] = env('wedding_hostname');
        $this->wedding_test['database'] = env('wedding_database');
        $this->wedding_test['username'] = env('wedding_username');
        $this->wedding_test['password'] = env('wedding_password');
        $this->wedding_test['port'] = env('wedding_port');

    }
}

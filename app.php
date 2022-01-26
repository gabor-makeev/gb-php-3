<?php

require_once 'Factories/MySQLFactory.php';
require_once 'Factories/PostgreSQLFactory.php';
require_once 'Factories/OracleFactory.php';

$config = 'MySQL'; // 'PostgreSQL' / 'Oracle'

class Database
{
  private ORMFactory $factory;
  private DBConnection $DBConnection;
  private DBQueryBuilder $DBQueryBuilder;
  private DBRecord $DBRecord;

  public function __construct($factory)
  {
    $this->factory = $factory;
  }

  public function init() {
    $this->DBConnection = $this->factory->createDBConnection();
    $this->DBQueryBuilder = $this->factory->createDBQueryBuilder();
    $this->DBRecord = $this->factory->createDBRecord();

    echo $this->DBConnection->connect();
    echo $this->DBQueryBuilder->select();
    echo $this->DBRecord->getRecord();
  }
}

if ($config === 'MySQL') {
  $factory = new MySQLFactory();
} else if ($config === 'PostgreSQL') {
  $factory = new PostgreSQLFactory();
} else if ($config === 'Oracle') {
  $factory = new OracleFactory();
}

$database = new Database($factory);
$database->init();
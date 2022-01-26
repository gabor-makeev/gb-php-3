<?php

require_once 'ORMFactory.php';
require_once './Products/DBConnections/MySQLDBConnection.php';
require_once './Products/DBQueryBuilders/MySQLDBQueryBuilder.php';
require_once './Products/DBRecords/MySQLDBRecord.php';

class MySQLFactory implements ORMFactory {
  public function createDBConnection(): DBConnection
  {
    return new MySQLDBConnection();
  }

  public function createDBQueryBuilder(): DBQueryBuilder
  {
    return new MySQLDBQueryBuilder();
  }

  public function createDBRecord(): DBRecord
  {
    return new MySQLDBRecord();
  }
}
<?php

require_once 'ORMFactory.php';
require_once './Products/DBConnections/PostgreSQLDBConnection.php';
require_once './Products/DBQueryBuilders/PostgreSQLDBQueryBuilder.php';
require_once './Products/DBRecords/PostgreSQLDBRecord.php';

class PostgreSQLFactory implements ORMFactory {
  public function createDBConnection(): DBConnection
  {
    return new PostgreSQLDBConnection();
  }

  public function createDBQueryBuilder(): DBQueryBuilder
  {
    return new PostgreSQLDBQueryBuilder();
  }

  public function createDBRecord(): DBRecord
  {
    return new PostgreSQLDBRecord();
  }
}
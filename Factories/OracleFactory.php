<?php

require_once 'ORMFactory.php';
require_once './Products/DBConnections/OracleDBConnection.php';
require_once './Products/DBQueryBuilders/OracleDBQueryBuilder.php';
require_once './Products/DBRecords/OracleDBRecord.php';

class OracleFactory implements ORMFactory {
  public function createDBConnection(): DBConnection
  {
    return new OracleDBConnection();
  }

  public function createDBQueryBuilder(): DBQueryBuilder
  {
    return new OracleDBQueryBuilder();
  }

  public function createDBRecord(): DBRecord
  {
    return new OracleDBRecord();
  }
}
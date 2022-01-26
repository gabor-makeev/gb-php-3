<?php

require_once 'DBRecord.php';

class PostgreSQLDBRecord implements DBRecord
{
  public function getRecord(): string
  {
    return 'The object of some record from the PostgreSQL database' . PHP_EOL;
  }
}
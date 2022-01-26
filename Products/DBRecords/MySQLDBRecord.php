<?php

require_once 'DBRecord.php';

class MySQLDBRecord implements DBRecord
{
  public function getRecord(): string
  {
    return 'The object of some record from the MySQL database' . PHP_EOL;
  }
}
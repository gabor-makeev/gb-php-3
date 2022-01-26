<?php

require_once 'DBRecord.php';

class OracleDBRecord implements DBRecord
{
  public function getRecord(): string
  {
    return 'The object of some record from the Oracle database' . PHP_EOL;
  }
}
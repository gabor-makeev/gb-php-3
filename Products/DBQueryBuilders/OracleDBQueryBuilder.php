<?php

require_once 'DBQueryBuilder.php';

class OracleDBQueryBuilder implements DBQueryBuilder
{
  public function select(): string
  {
    return 'Some data selection from the Oracle database' . PHP_EOL;
  }
}
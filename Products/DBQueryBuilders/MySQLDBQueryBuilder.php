<?php

require_once 'DBQueryBuilder.php';

class MySQLDBQueryBuilder implements DBQueryBuilder
{
  public function select(): string
  {
    return 'Some data selection from the MySQL database' . PHP_EOL;
  }
}
<?php

require_once 'DBQueryBuilder.php';

class PostgreSQLDBQueryBuilder implements DBQueryBuilder
{
  public function select(): string
  {
    return 'Some data selection from the PostgreSQL database' . PHP_EOL;
  }
}
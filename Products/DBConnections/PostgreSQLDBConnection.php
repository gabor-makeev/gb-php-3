<?php

require_once 'DBConnection.php';

class PostgreSQLDBConnection implements DBConnection
{
  public function connect(): string
  {
    return 'Connected to a PostgreSQL database' . PHP_EOL;
  }
}
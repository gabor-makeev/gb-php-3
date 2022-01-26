<?php

require_once 'DBConnection.php';

class MySQLDBConnection implements DBConnection
{
  public function connect(): string
  {
    return 'Connected to a MySQL database' . PHP_EOL;
  }
}
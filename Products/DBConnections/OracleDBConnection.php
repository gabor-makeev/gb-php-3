<?php

require_once 'DBConnection.php';

class OracleDBConnection implements DBConnection
{
  public function connect(): string
  {
    return 'Connected to an Oracle database' . PHP_EOL;
  }
}
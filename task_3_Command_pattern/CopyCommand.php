<?php

require_once 'Command.php';

class CopyCommand implements Command
{
  public function execute(): bool
  {
    echo "CopyCommand: скопировал контент" . PHP_EOL;
    return false;
  }
}
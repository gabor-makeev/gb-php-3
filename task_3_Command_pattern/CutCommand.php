<?php

require_once 'Command.php';

class CutCommand implements Command
{
  public function execute(): bool
  {
    echo "CutCommand: вырезал выделенный контент" . PHP_EOL;
    return true;
  }

  public function undo(): void
  {
    echo "CutCommand: возвращаю вырезанный контент" . PHP_EOL;
  }
}
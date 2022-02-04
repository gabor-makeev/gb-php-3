<?php

require_once 'Command.php';

class PasteCommand implements Command
{
  public function execute(): bool
  {
    echo "PasteCommand: вставляю скопированный контент" . PHP_EOL;
    return true;
  }

  public function undo(): void
  {
    echo "PasteCommand: возвращаю предыдущее значение контента (до вставки)" . PHP_EOL;
  }
}
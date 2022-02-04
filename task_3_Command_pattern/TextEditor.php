<?php

class TextEditor
{
  private Command $command;
  public array $commandHistory;

  public function __construct()
  {
    $this->commandHistory = [];
  }

  public function setCommand(Command $command)
  {
    $this->command = $command;
  }

  public function executeCommand()
  {
    if ($this->command->execute()) {
      $this->logCommandExecution();
    }
  }

  public function logCommandExecution()
  {
    $this->commandHistory[] = $this->command;
  }

  public function undo()
  {
    $command = array_pop($this->commandHistory);
    $command?->undo();
  }
}
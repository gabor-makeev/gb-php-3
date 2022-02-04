<?php

require_once 'TextEditor.php';
require_once 'CopyCommand.php';
require_once 'CutCommand.php';
require_once 'PasteCommand.php';

$textEditor = new TextEditor();
$textEditor->setCommand(new CutCommand());
$textEditor->executeCommand();
$textEditor->undo();
$textEditor->executeCommand();
$textEditor->setCommand(new PasteCommand());
$textEditor->executeCommand();

var_dump($textEditor->commandHistory);
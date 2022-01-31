<?php

interface Notifier
{
  public function send(string $message): void;
}
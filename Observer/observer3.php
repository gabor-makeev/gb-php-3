<?php

class Editor
{
  public EventManager $events;
  private File $file;

  public function Editor(): void
  {
    $this->events = new EventManager();
  }

  public function openFile(string $path): void
  {
    $this->file = new File($path);
    $this->events->notify("save", $this->file->getName());
  }

  public function saveFile()
  {
    $this->file->write();
    $this->events->notify("save", $this->file->getName());
  }
}

class EventManager
{
  private array $listeners;

  public function subscribe($event, EventListener $listener)
  {
    $this->listeners[] = [
      'event' => $event,
      'listener' => $listener
    ];
  }

  public function unsubscribe($event, $listener)
  {
    // some logic to remove the $listener from the $this->$listeners array
  }

  public function notify($event, $data)
  {
    foreach ($this->listeners as $listener) {
      $listener->update($data);
    }
  }
}

interface EventListener
{
  public function update($filename);
}

class EmailAlertsListener implements EventListener
{
  public function update($filename)
  {
    // some logic goes here
  }
}

class LoggingListener implements EventListener
{
  private File $log;
  private string $message;

  public function LoggingListener($log_filename, $message)
  {
    $this->log = new File($log_filename);
    $this->message = $message;
  }

  public function update($filename)
  {
    // some logic goes here
  }
}
<?php

class Publisher
{
  public array $subscribers;
  private string $mainState;

  public function __construct()
  {
    $this->subscribers = [];
  }

  public function subscribe(Subscriber $s)
  {
    $this->subscribers[] = $s;
  }

  public function unsubscribe(Subscriber $s)
  {
    // some unsubscribing code
  }

  public function notifySubscribers()
  {
    foreach ($this->subscribers as $subscriber) {
      $subscriber->update($this);
    }
  }

  public function mainBusinessLogic()
  {
    $this->mainState = "Some new state";
    $this->notifySubscribers();
  }
}

interface Subscriber
{
  public function update(Publisher $context);
}

class ConcreteSubscriber implements Subscriber
{
  public function update(Publisher $context)
  {
    // some notification logic
  }
}

$publisher = new Publisher();
$subscriber1 = new ConcreteSubscriber();
$subscriber2 = new ConcreteSubscriber();

$publisher->subscribe($subscriber1);
$publisher->subscribe($subscriber2);

var_dump($publisher->subscribers);


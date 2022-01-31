<?php

interface IPublisher
{
  public function publisher(string $content): void;
}

class TwitterAdapter implements IPublisher
{
  private $twitter;

  public function __construct(Twitter $twitter)
  {
    $this->twitter = $twitter;
  }

  public function publisher(string $content): void
  {
    $this->twitter->sendTweet($content);
  }
}

class FacebookAdapter implements IPublisher
{
  private $facebook;

  public function __construct(Facebook $facebook)
  {
    $this->facebook = $facebook;
  }

  public function publisher(string $content): void
  {
    $this->facebook->publish($content, new DateTime());
  }
}

<?php

interface Notifier
{
    public function send($message);
}

class BaseDecorator implements Notifier
{
    private Notifier $wrappee;

    public function BaseDecorator($notifier)
    {
        echo "Some construction happened here";
    }

    public function send($message)
    {
        echo "The message was sent";
    }
}

class SMSDecorator extends BaseDecorator
{
    public function send($message)
    {
        echo "The SMS message was sent";
    }
}


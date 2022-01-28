<?php

interface Subject
{
    public function request(): void;
}

class RealSubject implements Subject
{
    public function request(): void
    {
        echo "RealSubject: Handling request.\n";
    }
}

class Proxy implements Subject
{
    /**
     * @var RealSubject
     */
    private $realSubject;

    public function __contruct(RealSubject $realSubject)
    {
        $this->realSubject = $realSubject;
    }

    public function request(): void
    {
        if ($this->checkAccess()) {
            $this->realSubject->request();
            $this->logAccess();
        }
    }

    public function checkAccess(): bool
    {
        if (!$this->realSubject->isConnected()) {
            $this->realSubject->connect();
        }

        echo "Proxy: Checking access prior to firing a real request.\n";
        return true;
    }

    private function logAccess(): void
    {
        echo "Proxy: Logging the time of request.\n";
    }
}
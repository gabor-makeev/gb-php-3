<?php

class VacancySubscriber implements SplObserver
{
  private string $name;
  private string $email;
  // $experience - стаж работы (в месяцах)
  private int $experience;

  public function __construct(string $name, string $email, int $experience)
  {
    $this->name = $name;
    $this->email = $email;
    $this->experience = $experience;
  }

  /**
   * @param VacancyPublisher $subject
   */
  public function update(SplSubject $subject): void
  {
    $latestVacancy = implode(', ', $subject->getNewVacancies());
    echo $this->getName() . ": I was informed about the following vacancies via email: $latestVacancy" . PHP_EOL;
  }

  // метод subscribe() подписывает на уведомления
  public function subscribe(VacancyPublisher $vacancyPublisher): void
  {
    $vacancyPublisher->attach($this);
  }

  // метод unsubscribe() отписывает от уведомлений
  public function unsubscribe(VacancyPublisher $vacancyPublisher): void
  {
    $vacancyPublisher->detach($this);
  }

  // далее следуют стандартные getter-ы и setter-ы
  public function setName(string $name): void
  {
    $this->name = $name;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function setEmail(string $email): void
  {
    $this->email = $email;
  }

  public function getEmail(): string
  {
    return $this->email;
  }

  public function setExperience(int $experience): void
  {
    $this->experience = $experience;
  }

  public function getExperience(): int
  {
    return $this->experience;
  }
}
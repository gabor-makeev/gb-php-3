<?php

class VacancyPublisher implements SplSubject
{
  // $subscribers - список подписчиков
  private SplObjectStorage $subscribers;
  // $newVacancies - текущий список "Новых" вакансий (по сути, это некий State)
  private array $newVacancies;

  public function __construct()
  {
    $this->subscribers = new SplObjectStorage();
    $this->newVacancies = [];
  }

  // метод attach() добавляет искателей в список подписчиков ($subscribers)
  public function attach(SplObserver $observer): void
  {
    $this->subscribers->attach($observer);
  }

  // метод detach() убирает искателей из списка подписчиков ($subscribers)
  public function detach(SplObserver $observer): void
  {
    $this->subscribers->detach($observer);
  }

  // метод notify() инициализирует уведомление подписчиков
  public function notify(): void
  {
    foreach ($this->subscribers as $subscriber) {
      $subscriber->update($this);
    }
  }

  // метод updateNewVacancies() переопределяет/изменяет список "Новых" вакансий ($this->newVacancies)
  public function updateNewVacancies(array $newVacancies): void
  {
    $this->newVacancies = $newVacancies;
    // Ниже я делаю вывод уведомления от имени издателя (исключительно в целях тестирования в терминале)
    echo "System: we have new vacancies, they are: " . implode(', ', $newVacancies) . PHP_EOL;
    $this->notify();
  }

  // метод getNewVacancies() возвращает значение $this->newVacancies
  public function getNewVacancies(): array
  {
    return $this->newVacancies;
  }
}
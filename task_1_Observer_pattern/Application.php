<?php

require_once 'VacancyPublisher.php';
require_once 'VacancySubscriber.php';

// Далее идет небольшой клиентский код для тестирования

$handHunter = new VacancyPublisher();
$subscriberJohn = new VacancySubscriber('John', 'john@email.com', 8);
$subscriberSam = new VacancySubscriber('Sam', 'sam@email.com', 12);
$subscriberFrank = new VacancySubscriber('Frank', 'frank@email.com', 24);

$subscriberJohn->subscribe($handHunter);
$handHunter->updateNewVacancies([
  'Junior PHP Web developer',
  'Senior JavaScript Web developer',
  'Middle Python developer'
]);

$subscriberJohn->unsubscribe($handHunter);

$subscriberSam->subscribe($handHunter);
$handHunter->updateNewVacancies([
  'Middle full-stack developer',
  'Senior DevOps'
]);

$subscriberFrank->subscribe($handHunter);
$handHunter->updateNewVacancies([
  'Frontend developer (VueJs)',
  'Middle Project Manager'
]);
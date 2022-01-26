<?php

interface ORMFactory
{
  public function createDBConnection(): DBConnection;
  public function createDBRecord(): DBRecord;
  public function createDBQueryBuilder(): DBQueryBuilder;
}
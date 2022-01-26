<?php

// -- Chair --

interface Chair
{
  public function hasLegs();

  public function sitOn();
}

class VictorianChair implements Chair
{
  public function hasLegs()
  {
    echo 'hasLegs() victorian function logic';
  }

  public function sitOn()
  {
    echo 'sitOn() victorian function logic';
  }
}

class ModernChair implements Chair
{
  public function hasLegs()
  {
    echo 'hasLegs() modern function logic';
  }

  public function sitOn()
  {
    echo 'sitOn() modern function logic';
  }
}

interface Sofa
{
  public function layDownOnIt();
}

class VictorianSofa implements Sofa
{
  public function layDownOnIt()
  {
    echo 'layDownOnIt() victorian sofa method';
  }
}

class ModernSofa implements Sofa
{
  public function layDownOnIt()
  {
    echo 'layDownOnIt() modern sofa method';
  }
}


interface FurnitureFactory
{
  public function createChair(): Chair;

  public function createSofa(): Sofa;
}

class VictorianFurnitureFactory implements FurnitureFactory
{
  public function createChair(): Chair
  {
    echo 'Created a victorian chair';
    return new VictorianChair();
  }

  public function createSofa(): Sofa
  {
    echo 'Created a victorian sofa';
    return new VictorianSofa();
  }
}

class ModernFurnitureFactory implements FurnitureFactory
{
  public function createChair(): Chair
  {
    echo 'Created a modern chair';
    return new ModernChair();
  }

  public function createSofa(): Sofa
  {
    echo 'Created a modern sofa';
    return new ModernSofa();
  }
}
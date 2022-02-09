<?php

class Finder
{
  private DirectoryIterator $directoryIterator;

  public function __construct(string $dirPath)
  {
    $this->directoryIterator = new DirectoryIterator($dirPath);
  }

  public function getDirIterator(): DirectoryIterator
  {
    return $this->directoryIterator;
  }

  private function isHiddenItem(DirectoryIterator $item): bool
  {
    return str_starts_with($item->getFilename(), '.');
  }

  public function scanTree(DirectoryIterator $dir, int $tabSize, int $level = 0): void
  {
    global $level;
    foreach ($dir as $item) {
      if (!$item->isDot()) {  // если есть необходимость просмотра скрытых директорий следует использовать !$this->isHiddenItem($item) в условии
        if ($level) {
          echo str_repeat(" ", $level) . $item . PHP_EOL;
        } else {
          echo $item . PHP_EOL;
        }
        if ($item->isDir()) {
          $subDir = new Finder($item->getPath() . "/" . $item->getFilename());
          $this->scanTree($subDir->getDirIterator(), $tabSize, $level += $tabSize);
        }
      }
    }
    $level === 0 ?: $level -= $tabSize;
  }
}

$finder = new Finder("./");
$finder->scanTree($finder->getDirIterator(), 2);
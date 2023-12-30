<?php

namespace App\News\Articles;

use App\News\Articles\Article;
use Carbon\Carbon;

class GuardianArticle extends Article
{
  /** 
   * Sets date based on original format
   */
  public function setDate(string $date): Article
  {
    // $this->date = Carbon::parse($date);
    $this->date = Carbon::createFromFormat('c', $date);

    return $this;
  }
}
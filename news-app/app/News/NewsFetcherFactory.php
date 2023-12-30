<?php

namespace App\News;

use App\Contracts\NewsFetcherInterface;
use App\Exceptions\NewsFetcherException;
use App\News\GuardianFetcher;

class NewsFetcherFactory
{

  /** 
   * @throws NewsFetcherException
   */
  public static function get(string $newsAPI = 'guardian'): NewsFetcherInterface
  {
    return match($newsAPI) {
      'guardian' => new GuardianFetcher,
      default => throw new NewsFetcherException("News API {$newsAPI} is not recognized!")
    };
  }
}
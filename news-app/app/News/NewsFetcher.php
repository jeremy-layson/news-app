<?php

namespace App\News;

use App\Contracts\NewsFetcherInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

abstract class NewsFetcher implements NewsFetcherInterface
{
  protected $search = '';

  protected $tags = [];

  protected $dateFrom = NULL;

  protected $dateTo = NULL;

  public function getSearchString(): ?string
  {
    return $this->search;
  }

  public function setSearchString(?string $searchString): NewsFetcherInterface
  {
    $this->search = $searchString;

    return $this;
  }

  public function search(?string $searchString): Collection
  {
    return collect([]);
  }

  protected function fetchResult($url)
  {
    $response = Http::get($url);

    if ($response->failed()) {
      // handle error
      throw new \Exception($response->getBody());
    }

    return $response->getBody();
  }

  protected function parseResult(array $articles): Collection
  {

  }
}
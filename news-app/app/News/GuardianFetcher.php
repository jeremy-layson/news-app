<?php

namespace App\News;

use App\News\NewsFetcher;
use Illuminate\Support\Collection;
use App\News\Articles\GuardianArticle;

class GuardianFetcher extends NewsFetcher
{
  public function getAPIKey(): string {
    return config('services.news.guardian.api');
  }

  public function getBaseURL(): string {
    return config('services.news.guardian.url');
  }

  public function getFullURL(): string {
    $url = $this->getBaseURL();
    $key = $this->getAPIKey();
    $search = urlencode($this->getSearchString());

    return "{$url}/search?q={$search}&api-key={$key}";
  }

  public function search(?string $searchString): Collection {
    $this->setSearchString($searchString);
    $fullUrl = $this->getFullURL();

    $result = json_decode($this->fetchResult($fullUrl), TRUE);

    return $this->parseResult($result['response']['results']);
  }

  protected function parseResult(array $articles): Collection
  {
    $results = [];

    foreach ($articles as $key => $article) {
      $object = new GuardianArticle;

      $object->setTitle($article['webTitle'])
        ->setBody('')
        ->setUrl($article['webUrl'])
        ->setDate($article['webPublicationDate'])
        ->setCategory($article['sectionName'])
        ->setSource('the_guardian')
        ->setArticleId($article['id']);

      $results[] = $object->toArray();
    }

    return $this->sortResult(collect($results));
  }

  /**
   * Since the requirement specifies sorting the Guardian result by their sections
   * This part will be performed after parsing the data
   */
  protected function sortResult(Collection $result): Collection
  {
    return $this->groupResult($result->sortBy(['category', 'asc']));
  }

  // per requirements, it must be grouped
  protected function groupResult(Collection $result): Collection
  {
    $groups = [];

    foreach ($result as $key => $item) {
      $groups[$item['category']][] = $item;
    }

    return collect($groups);
  }
}
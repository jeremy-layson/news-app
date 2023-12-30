<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface NewsFetcherInterface
{
  public function getAPIKey(): string;

  public function getBaseURL(): string;

  public function getFullURL(): string;

  public function search(?string $searchString): Collection;

  public function getSearchString(): ?string;

  public function setSearchString(string $searchString): NewsFetcherInterface;
}
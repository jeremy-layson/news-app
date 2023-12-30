<?php

namespace App\News\Articles;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use App\Models\Pin;

abstract class Article implements Arrayable
{

  protected $title;

  protected $body = '';

  protected $date;

  protected $isPinned = FALSE;

  protected $url;

  protected $category = '';

  public function setCategory(string $category): Article
  {
    $this->category = $category;

    return $this;
  }

  public function getCategory(): string
  {
    return $this->category;
  }

  public function setTitle(string $title): Article
  {
    $this->title = $title;

    return $this;
  }

  public function getTitle(): string
  {
    return $this->title;
  }

  public function setDate(string $date): Article
  {
    $this->date = Carbon::parse($date);

    return $this;
  }

  public function getDate(): string
  {
    return $this->date->format('d/m/Y');
  }

  public function setBody(string $body): Article
  {
    $this->body = $body;

    return $this;
  }

  public function getBody(): string
  {
    return $this->body;
  }

  public function setUrl(string $url): Article
  {
    $this->url = $url;

    return $this;
  }

  public function getUrl(): string
  {
    return $this->url;
  }

  public function setIsPinned(string $isPinned): Article
  {
    $this->isPinned = $isPinned;

    return $this;
  }

  public function getIsPinned(): string
  {
    // check DB if article exist as pinned
    $pin = Pin::where('url', $this->getUrl())
      ->where('category', $this->getCategory())
      ->first();

    return (int)(is_null($pin) ? $this->isPinned : $pin->is_pinned);
  }

  public function __toString()
  {
    return json_encode([
      'title' => $this->getTitle(),
      'body'  => $this->getBody(),
      'date'  => $this->getDate(),
      'is_pinned' => $this->getIsPinned(),
      'url'   => $this->getUrl(),
      'category'   => $this->getCategory(),
    ]);
  }

  public function toArray()
  {
    return [
      'title' => $this->getTitle(),
      'body'  => $this->getBody(),
      'date'  => $this->getDate(),
      'is_pinned' => $this->getIsPinned(),
      'url'   => $this->getUrl(),
      'category'   => $this->getCategory(),
    ];
  }
}
<?php

namespace App\Models;

class BooksModel extends Model
{
    public ?int $id = null;
    public ?string $title = null;
    public ?int $pages = null;
    public ?int $ISBN = null;
    public ?int $release_year = null;
    public ?string $language = null;
    public ?int $genre_id = null;
    public ?int $author_id = null;
    public ?int $publisher_id = null;
    public ?string $cover = null;

    protected static $table = 'books';

    public function __construct(?int $id = null,
            ?string $title = null,
            ?int $pages = null,
            ?int $ISBN = null,
            ?int $release_year = null,
            ?string $language = null,
            ?int $genre_id = null,
            ?int $author_id = null,
            ?int $publisher_id = null,
            ?string $cover = null,)
    {
        parent::__construct();
        if ($id != null) {
            $this->id = $id;
        }
        if ($title != null) {
            $this->title = $title;
        }
        if ($pages != null) {
            $this->pages = $pages;
        }
        if ($ISBN != null) {
            $this->ISBN = $ISBN;
        }
        if ($release_year != null) {
            $this->release_year = $release_year;
        }
        if ($language != null) {
            $this->language = $language;
        }
        if ($genre_id != null) {
            $this->genre_id = $genre_id;
        }
        if ($author_id != null) {
            $this->author_id = $author_id;
        }
        if ($publisher_id != null) {
            $this->publisher_id = $publisher_id;
        }
        if ($cover != null) {
            $this->cover = $cover;
        }
    }
}
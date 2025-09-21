<?php

namespace App\Models;

use App\Models\PublisherModel;

class BooksModel extends Model
{
    public ?int $id = null;
    public ?string $title = null;
    public ?string $isbn = null;
    public ?int $pages = null;
    public ?string $cover_url = null;
    public ?int $available_copies = null;
    public ?string $language = null;
    public ?int $release_year = null;
    public ?int $publisher_id = null;

    protected static $table = 'book';

    public function __construct(
            ?int  $id = null,
            ?string $title = null,
            ?string $isbn = null,
            ?int $pages = null,
            ?string $cover_url = null,
            ?int $available_copies = null,
            ?string $language = null,
            ?int $release_year = null,
            ?int $publisher_id = null,)
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
        if ($isbn != null) {
            $this->isbn = $isbn;
        }
        if ($release_year != null) {
            $this->release_year = $release_year;
        }
        if ($language != null) {
            $this->language = $language;
        }
        if ($publisher_id != null) {
            $this->publisher_id = $publisher_id;
        }
        if ($cover_url != null) {
            $this->cover_url = $cover_url;
        }
        if ($available_copies != null) {
            $this->available_copies = $available_copies;
        }
    }

    public function getPublisher() {
        $publisher = new PublisherModel();
        $publisher = $publisher->find($this->publisher_id);
        return $publisher;
    }

    public function getAuthorsByBookId() {

        $sql = "
            SELECT GROUP_CONCAT(CONCAT(a.first_name, ' ', a.last_name) SEPARATOR ', ') as name
            FROM book_author ba
            JOIN author a ON ba.author_id = a.id
            WHERE ba.book_id = :book_id";
        $qryResult = $this->db->execSql($sql, ['book_id' => $this->id]);
        return $qryResult;
    }

    public function getGenresByBookId() {

        $sql = "
            SELECT GROUP_CONCAT(CONCAT(g.name) SEPARATOR ', ') as genre
            FROM book_genre bg
            JOIN genre g ON bg.genre_id = g.id
            WHERE bg.book_id = :book_id";
        $qryResult = $this->db->execSql($sql, ['book_id' => $this->id]);
        return $qryResult;
    }
}
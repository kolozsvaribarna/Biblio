<?php

namespace App\Models;

class AuthorsModel extends Model
{
    public ?int $id = null;
    public ?string $first_name = null;
    public ?string $last_name = null;
    public ?string $bio = null;


    protected static $table = 'author';

    public function __construct(
        ?int $id = null,
        ?string $first_name = null,
        ?string $last_name = null,
        ?string $bio = null)
    {
        parent::__construct();
        if ($id != null) {
            $this->id = $id;
        }
        if ($first_name != null) {
            $this->first_name = $first_name;
        }
        if ($last_name != null) {
            $this->last_name = $last_name;
        }
        if ($bio != null) {
            $this->bio = $bio;
        }
    }

    public function getAuthor() {
        $author = new AuthorsModel();
        $author = $author->find($this->id);
        return $author;
    }
}
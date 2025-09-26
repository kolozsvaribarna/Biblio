<?php

namespace App\Models;

class GenreModel extends Model
{
    public ?int $id = null;
    public ?string $name = null;

    protected static $table = 'genre';

    public function __construct(
        ?int $id = null,
        ?string $name = null)
    {
        parent::__construct();
        if ($id != null) {
            $this->id = $id;
        }
        if ($name != null) {
            $this->name = $name;
        }
    }
}
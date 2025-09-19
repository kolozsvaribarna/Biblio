<?php

namespace App\Models;

// use App\Models\PublisherModel;

class AuthorsModel extends Model
{
    public ?int $author_id = null;
    public ?string $first_name = null;
    public ?string $last_name = null;
    public ?string $bio = null;


    protected static $table = 'author';

    public function __construct(
        ?int $author_id = null,
        ?string $first_name = null,
        ?string $last_name = null,
        ?string $bio = null)
    {
        parent::__construct();
        if ($author_id != null) {
            $this->author_id = $author_id;
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

    function find(int $id): ?static
    {
        $sql = self::select() . " WHERE author_id = :id";

        $qryResult = $this->db->execSql($sql, ['id' => $id]);
        if (empty($qryResult)) {
            return null;
        }

        return $this->mapToModel($qryResult[0]);
    }


    public function getAuthor() {
        $author = new AuthorsModel();
        $author = $author->find($this->author_id);
        return $author;
    }
}
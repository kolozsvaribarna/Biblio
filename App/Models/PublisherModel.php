<?php

namespace App\Models;

class PublisherModel extends Model
{
    public ?int $publisher_id = null;
    public ?string $name = null;

    protected static $table = 'publisher';

    public function __construct(
        ?int $publisher_id = null,
        ?string $name = null)
    {
        parent::__construct();
        if ($publisher_id != null) {
            $this->publisher_id = $publisher_id;
        }
        if ($name != null) {
            $this->name = $name;
        }
    }

    // override to match field in table: "publisher_id" <=> "id"
    public function find(int $id): ?static
    {
        $sql = self::select() . " WHERE publisher_id = :id";

        $qryResult = $this->db->execSql($sql, ['id' => $id]);
        if (empty($qryResult)) {
            return null;
        }

        return $this->mapToModel($qryResult[0]);
    }
}
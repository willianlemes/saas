<?php

namespace Source\Models;

use Source\Core\Model;
use Source\Models\Person;
use Source\Models\User;

/**
 *
 */
class Realty extends Model
{
    public function __construct()
    {
        parent::__construct("properties", ["id"], ["proprietary", "finality", "kind", "price"]);
    }

    public function proprietary(): ?Person
    {
        if ($this->proprietary) {
            return (new Person())->findById($this->proprietary);
        }
        return null;
    }

    /**
     * @param User $user
     * @param string $finality
     * @param string $kind
     * @param int|null $limit
     * @param int|null $offset
     * @return array|null
     */
    public function filter(User $user, ?array $data, int $limit, int $offset): ?array
    {
        $where = "user_id = {$user->id}";

        if (!empty($data['finality'])) {
            $where .= ($data['finality']!=="Todas" ? " AND finality = '{$data['finality']}'" : '');
        }

        if (!empty($data['kind'])) {
            $where .= ($data['kind']!=="Todos" ? " AND kind = '{$data['kind']}'" : '');
        }

        return $this->find($where)
                      ->limit($limit)
                      ->offset($offset)
                      ->fetch(true);
    }
}

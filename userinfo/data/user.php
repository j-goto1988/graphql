<?php
namespace GraphQL\userinfo\data;

use GraphQL\Utils\Utils;

class user {
    public int $id;
    public string $name;
    public int $age;
    public string|null $comment;
    public int $active_flg;

    const KEY_LIST = ['id', 'name', 'age', 'comment', 'active_flg'];

    public function __construct(array $data) {
        foreach ($data as $key => $val) {
            if (!in_array($key, self::KEY_LIST))
            {
                unset($data[$key]);
            }
        }
        Utils::assign($this, $data);
    }
}


<?php
namespace GraphQL\userinfo\type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class user_type extends ObjectType
{
    public function __construct() {
        $config = [
            'name' => 'user',
            'fields' => [
                'id' => [
                    'type' =>Type::id(),
                ],
                'name' => [
                    'type' => Type::string(),
                ],
                'age' => [
                    'type' => Type::int()
                ],
                'comment' => [
                    'type' => Type::string(),
                ],
                'active_flg' => [
                    'type' => Type::int()
                ],
            ],
        ];
        parent::__construct($config);
    }
}


<?php
namespace GraphQL\userinfo\type;

require_once(dirname(__FILE__).'/../db/user_db.php');
require_once(dirname(__FILE__).'/define/user_type_define.php');
require_once(dirname(__FILE__).'/../data/user.php');

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\userinfo\db\user_db;
use GraphQL\userinfo\type\define\user_type_define;
use GraphQL\userinfo\data\user;

class mutation extends ObjectType
{
    public function __construct() {

        $config = [
            'name' => 'Mutation',
            'fields' => [
                'add' => [
                    'type' => user_type_define::user(),
                    'args' => [
                        'name' => [
                            'type' => Type::string(),
                        ],
                        'age' => [
                            'type' => Type::int(),
                        ],
                        'comment' => [
                            'type' => Type::string(),
                        ],
                        'active_flg' => [
                            'type' => Type::int(),
                        ],
                    ],
                    'resolve' => function($value, $args, $context, ResolveInfo $info) {
                        $user_db = new user_db();
                        $ret = $user_db->add($args['name'], $args['age'], $args['comment'], $args['active_flg']);

                        if ($ret === false)
                        {
                            return [];
                        }
                        $arr = [
                            'id' => $ret,
                            'name' => $args['name'],
                            'age' => $args['age'],
                            'comment' => $args['comment'],
                            'active_flg' => $args['active_flg']
                        ];
                        return new user($arr);
                    }
                ],
                'edit' => [
                    'type' => user_type_define::user(),
                    'args' => [
                        'id' => [
                            'type' => Type::id(),
                        ],
                        'name' => [
                            'type' => Type::string(),
                        ],
                        'age' => [
                            'type' => Type::int(),
                        ],
                        'comment' => [
                            'type' => Type::string(),
                        ],
                        'active_flg' => [
                            'type' => Type::int(),
                        ],
                    ],
                    'resolve' => function($value, $args, $context, ResolveInfo $info) {
                        $user_db = new user_db();
                        $ret = $user_db->edit($args['id'], $args['name'] ?? null, $args['age'] ?? null, $args['comment'] ?? null, $args['active_flg'] ?? null);

                        if ($ret === false)
                        {
                            return [];
                        }
                        $ret = $user_db->get_by_id($args['id']);
                        return new user($ret);
                    }
                ],
            ],
        ];
        parent::__construct($config);


    }
}


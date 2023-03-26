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

class query extends ObjectType
{
    public function __construct() {

        $config = [
            'name' => 'Query',
            'fields' => [
                'users' => [
                    'type' => Type::listOf(user_type_define::user()),
                    'resolve' => function() {
                        $user_db = new user_db();
                        $ret = $user_db->get_all();
                        
                        if (empty($ret))
                        {
                            return [];
                        }
                        foreach ($ret as $val) {
                            $arr[$val['id']] = new user($val);
                        }
                        return $arr;
                    }
                ],
                'user' => [
                    'type' => user_type_define::user(),
                    'args' => [
                        'id' => [
                            'type' => Type::id(),
                        ],
                    ],
                    'resolve' => function($value, $args, $context, ResolveInfo $info) {
                        $user_db = new user_db();
                        $ret = $user_db->get_by_id($args['id']);
                        
                        if (empty($ret))
                        {
                            return [];
                        }
                        return new user($ret);
                    }
                ],
            ],
        ];
        parent::__construct($config);


    }
}


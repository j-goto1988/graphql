<?php
require_once(dirname(__FILE__).'/graphql/vendor/autoload.php');
require_once(dirname(__FILE__).'/userinfo/type/query.php');
require_once(dirname(__FILE__).'/userinfo/type/mutation.php');

use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use GraphQL\Type\SchemaConfig;
use GraphQL\Server\StandardServer;
use GraphQL\userinfo\type\query;
use GraphQL\userinfo\type\mutation;

$schema = new Schema(
    (new SchemaConfig())
    ->setQuery(new query())
    ->setMutation(new mutation())
);

$server = new StandardServer([
    'schema' => $schema,
]);

$server->handleRequest();

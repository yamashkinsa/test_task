<?php

require_once 'autoload.php';

use \App\Api;
use \App\Validator;

$user = [
    'id' => 20,
    'name' => 'John Dow',
    'role' => 'QA',
    'salary' => 100,
];

$api_path_templates = [
    "/api/items/%id%/%name%",
    "/api/items/%id%/%role%",
    "/api/items/%id%/%salary%"
];

$validator = new Validator([
    'id' => 'integer',
    'name' => 'string',
    'role' => 'string',
    'salary' => 'integer'
]);
$api = new Api($validator);

$api_paths = array_map(function ($api_path_template) use ($api, $user) {
    return $api->get_api_path($user, $api_path_template);
}, $api_path_templates);

echo json_encode($api_paths, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE);
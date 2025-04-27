<?php

namespace Config;

class Validator
{
    public const RULES = [
        'id'	=> 'integer',
        'name'	=> 'string',
        'role'	=> 'string',
        'salary'=> 'integer'
    ];
}
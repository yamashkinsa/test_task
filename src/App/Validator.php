<?php

namespace App;

use Config;

/**
 * Класс для валидации данных
 *
 * @author		yamashkinsa
 * @version		v.1.0 (27/04/2025)
 */
class Validator
{
    private array $rules;

    public function __construct()
    {
        $this->rules = Config\Validator::RULES;
    }

    /**
     * Проверяет данные на соответствие правилам
     *
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function validate(array $data): bool
    {
        foreach ($data as $key => $value)
        {
            if (!array_key_exists($key, $this->rules))
            {
                throw new \Exception("Field '{$key}' is not allowed.");
            }

            $type = gettype($value);

            if ($type !== $this->rules[$key])
            {
                throw new \Exception("Field '{$key}' must be of type '{$this->rules[$key]}', '{$type}' given.");
            }
        }

        return true;
    }
}
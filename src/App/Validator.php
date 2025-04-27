<?php

namespace App;

/**
 * Класс для валидации данных
 *
 * @author		yamashkinsa
 * @version		v.1.0 (27/04/2025)
 */
class Validator
{
    private array $allowed_fields;

    public function __construct($config)
    {
        $this->allowed_fields = $config;
    }

    /**
     * Валидирует данные
     *
     * @param array $data
     * @param string|null $template
     * @return void
     * @throws \Exception
     */
    public function validate(array $data, ?string $template = null): void
    {
        // Проверяем допустимые поля
        foreach ($data as $key => $value) {
            if (!array_key_exists($key, $this->allowed_fields)) {
                throw new \Exception("Field '{$key}' is not allowed.");
            }

            // Проверка типа
            $expectedType = $this->allowed_fields[$key];

            if (gettype($value) !== $expectedType) {
                throw new \Exception("Field '{$key}' must be of type '{$expectedType}', '" . gettype($value) . "' given.");
            }
        }

        // Проверяем наличие всех полей из шаблона
        if ($template !== null) {
            preg_match_all('/%(\w+)%/', $template, $matches);

            if (!empty($matches[1])) {
                foreach ($matches[1] as $fieldName) {
                    if (!array_key_exists($fieldName, $data)) {
                        throw new \Exception("Field '{$fieldName}' is missing in data array.");
                    }
                }
            }
        }
    }
}

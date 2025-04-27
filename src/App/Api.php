<?php

namespace App;

use Interfaces\ValidatorInterface;

/**
 * Класс для работы с API
 *
 * @author		yamashkinsa
 * @version		v.1.0 (27/04/2025)
 */
class Api
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Заполняет строковый шаблон данными из массива
     *
     * @param array $array
     * @param string $template
     * @return string
     * @throws \Exception
     */
    public function get_api_path(array $array, string $template): string
    {
        // Валидируем данные
        $this->validator->validate($array, $template);

        // Заменяем плейсхолдеры
        $result = $template;

        foreach ($array as $key => $value) {
            $placeholder = '%' . $key . '%';

            if (strpos($result, $placeholder) !== false) {
                $result = str_replace($placeholder, rawurlencode((string)$value), $result);
            }
        }

        return $result;
    }
}
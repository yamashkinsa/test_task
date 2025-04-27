<?php

namespace App;

use App\Validator;

/**
 * Класс для работы с API
 *
 * @author		yamashkinsa
 * @version		v.1.0 (27/04/2025)
 */
class Api
{
    private Validator $validator;

    public function __construct(Validator $validator)
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
        // Валидация данных
        $this->validator->validate($array, $template);

        // Замена плейсхолдеров
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
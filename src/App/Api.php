<?php

namespace App;

/**
 * Класс для работы с API
 *
 * @author		yamashkinsa
 * @version		v.1.0 (27/04/2025)
 */
class Api
{
    private Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator();
    }

    /**
     * Заполняет строковый шаблон template данными из массива
     *
     * @author		User Name
     * @version		v.1.0 (27/04/2025)
     * @param		{object} array
     * @param		{string} template
     * @return		{string}
     */
    public function get_api_path(array $array, string $template): string
    {
        $this->validator->validate($array);

        $result = $template;

        foreach ($array as $key => $value)
        {
            $placeholder = '%' . $key . '%';

            if (strpos($result, $placeholder) !== false)
            {
                $result = str_replace($placeholder, rawurlencode((string)$value), $result);
            }
        }

        return $result;
    }
}
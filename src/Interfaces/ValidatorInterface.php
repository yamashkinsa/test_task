<?php

namespace Interfaces;

/**
 * Интерфейс для валидатора данных
 */
interface ValidatorInterface
{
    /**
     * Метод для валидации данных
     *
     * @param array $data
     * @param string|null $template
     * @return void
     */
    public function validate(array $data, ?string $template = null): void;
}
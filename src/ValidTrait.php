<?php
/**
 * Author: Aleksandrov Artem
 * Date: 2020-04-25
 * Time: 15:10:04
 */

declare(strict_types=1);

namespace kradwhite\validation;

use kradwhite\db\exception\DbException;
use kradwhite\language\Lang;
use kradwhite\language\LangException;
use phpDocumentor\Reflection\Types\Static_;

/**
 * Trait ValidTrait
 * @package kradwhite\validation
 */
trait ValidTrait
{
    /** @var int|float|string[] */
    private array $values;

    /** @var callable[] */
    private array $checks = [];

    /** @var array */
    private array $checkParams = [];

    /** @var string */
    private string $errorId = '';

    /** @var Lang */
    private static ?Lang $lang = null;

    /** @var string */
    private static string $locale = 'ru';

    /**
     * @return bool
     */
    public function check(): bool
    {
        foreach ($this->checks as $errorKey => $rule) {
            for ($j = 0; $j < count($this->values); $j++) {
                if (!$rule($this->values[$j])) {
                    $this->errorId = $errorKey;
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * @param string $name
     * @return string
     * @throws ValidationException
     */
    public function message(string $name): string
    {
        try {
            if (!self::$lang) {
                self::$lang = Lang::init(require_once __DIR__ . '/../language.php', self::$locale);
            }
            if (!$this->check()) {
                $checkParams = isset($this->checkParams[$this->errorId]) ? $this->checkParams[$this->errorId] : [];
                if (!is_array($checkParams)) {
                    $checkParams = [$checkParams];
                }
                return $this->lang->phrase('validation', $this->errorId, array_merge([$name], $checkParams));
            }
            return '';
        } catch (DbException|LangException $e) {
            $message = "Ошибка получения фразы с идентификатором '{$this->errorId}' в тексте 'validation'";
            throw new ValidationException($message, 0, $e);
        }
    }

    /**
     * @param string $message
     * @param string ...$params
     * @return string
     */
    public function customMessage(string $message, string ...$params): string
    {
        if (!$this->check()) {
            return sprintf($message, ...$params);
        }
        return '';
    }

    /**
     * @return array
     */
    public function errorParams(): array
    {
        if ($this->errorId && isset($this->checkParams[$this->errorId])) {
            return $this->checkParams[$this->errorId];
        }
        return [];
    }

    /**
     * @param string $locale
     */
    public static function setLocale(string $locale)
    {
        self::$locale = $locale;
    }
}

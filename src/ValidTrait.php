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

    /** @var int */
    private int $i = 0;

    /** @var Lang */
    private static ?Lang $lang = null;

    /** @var string */
    private static string $locale = 'ru';

    /**
     * @return bool
     */
    public function check(): bool
    {
        foreach ($this->checks as $errorId => $rules) {
            for ($i = 0; $i < count($rules); $i++) {
                for ($j = 0; $j < count($this->values); $j++) {
                    if (!$rules[$i]($this->values[$j], $i)) {
                        $this->errorId = $errorId;
                        $this->i = $i;
                        return false;
                    }
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
            $this->getLang();
            if (!$this->check()) {
                $checkParams = isset($this->checkParams[$this->errorId][$this->i])
                    ? $this->checkParams[$this->errorId][$this->i]
                    : [];
                if (!is_array($checkParams)) {
                    $checkParams = [$checkParams];
                }
                return self::$lang->phrase('validation', $this->errorId, array_merge([$name], $checkParams));
            }
            return '';
        } catch (DbException|LangException $e) {
            $message = self::$lang->phrase('exception', 'get-phrase-error', [$this->errorId]);
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
        if ($this->errorId && isset($this->checkParams[$this->errorId][$this->i])) {
            return $this->checkParams[$this->errorId][$this->i];
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

    /**
     * @return Lang
     * @throws LangException
     */
    private function getLang(): Lang
    {
        if (!self::$lang) {
            self::$lang = Lang::init(__DIR__ . '/../language.php', self::$locale);
        }
        return self::$lang;
    }
}

<?php


namespace HeadOfDDD\Crowdfunding\Domain\ValueObject;


use HeadOfDDD\Crowdfunding\Domain\Exception\DomainException;

class Currency
{
    public const RUB = 'RUB';
    public const USD = 'USD';
    private const ALLOWED_CURRENCY = [
        self::RUB,
        self::USD
    ];

    protected $value;

    public function __construct(string $value)
    {
        if (!self::isValid($value)) {
            throw new DomainException('Currency name not allowed.');
        }

        $this->value = $value;
    }

    public static function isValid(string $value): bool
    {
       return in_array($value, self::ALLOWED_CURRENCY, true);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
<?php


namespace HeadOfDDD\Crowdfunding\Domain\ValueObject;


use HeadOfDDD\Crowdfunding\Domain\Exception\DomainException;

class Price
{
    protected $amount;
    protected $currency;

    public function __construct(int $amount, Currency $currency)
    {
        if (!self::isValid($amount)) {
            throw new DomainException('Amount value is not valid.');
        }

        $this->amount = $amount;
        $this->currency = $currency;
    }

    public static function isValid(int $amount): bool
    {
       return $amount >= 0;
    }

    public function __toString(): string
    {
        return (string) $this->amount;
    }
}
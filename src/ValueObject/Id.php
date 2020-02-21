<?php


namespace HeadOfDDD\Crowdfunding\Domain\ValueObject;


use HeadOfDDD\Crowdfunding\Domain\Exception\DomainException;
use Ramsey\Uuid\Uuid;

class Id
{
    /** @var string */
    protected $value;

    public function __construct(string $value)
    {
        if (!self::isValid($value)) {
            throw new DomainException('Id value is not valid guid.');
        }

        $this->value = $value;
    }

    public static function next(): string
    {
        return Uuid::uuid4()->toString();
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public static function isValid(string $value): bool
    {
        return Uuid::isValid($value);
    }


}
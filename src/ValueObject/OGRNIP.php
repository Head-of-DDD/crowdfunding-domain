<?php


namespace HeadOfDDD\Crowdfunding\Domain\ValueObject;


use HeadOfDDD\Crowdfunding\Domain\Exception\DomainException;

class OGRNIP
{
    protected $value;


    public function __construct(string $value)
    {
        self::validate($value);
        $this->value = $value;
    }

    private static function validate(string $value): void
    {
        if (empty($value)) {
            throw new DomainException('OGRNIP is empty.');
        }
        if (preg_match('/[^0-9]/', $value)) {
            throw new DomainException('OGRNIP can be contain only numbers.');
        }
        if (strlen($value) !== 15) {
            throw new DomainException('OGRNIP length not equal 15.');
        }

        $n15 = (int) substr(bcsub(substr($value, 0, -1), bcmul(bcdiv(substr($value, 0, -1), '13', 0), '13')), -1);
        if ($n15 !== (int) $value{14}) {
            throw new DomainException('OGRNIP invalid hash sum.');
        }
    }

    public static function isValid(string $value): bool
    {
        try {
            self::validate($value);
            return true;
        } catch (\Exception $ex) {
            return false;
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
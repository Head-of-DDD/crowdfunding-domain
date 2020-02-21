<?php


namespace HeadOfDDD\Crowdfunding\Domain\ValueObject;


use HeadOfDDD\Crowdfunding\Domain\Exception\DomainException;

class OGRN
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
            throw new DomainException('OGRN is empty.');
        }
        if (preg_match('/[^0-9]/', $value)) {
            throw new DomainException('OGRN can be contain only numbers.');
        }
        if (strlen($value) !== 13) {
            throw new DomainException('OGRN length not equal 13.');
        }

        $n13 = (int) substr(bcsub(substr($value, 0, -1), bcmul(bcdiv(substr($value, 0, -1), '11', 0), '11')), -1);
        if ($n13 !== (int) $value{12}) {
            throw new DomainException('OGRN invalid hash sum.');
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
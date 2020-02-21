<?php


namespace HeadOfDDD\Crowdfunding\Domain\ValueObject;


use HeadOfDDD\Crowdfunding\Domain\Exception\DomainException;

class INN
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
            throw new DomainException('INN is empty.');
        }
        if (preg_match('/[^0-9]/', $value)) {
            throw new DomainException('INN can contain only number.');
        }
        if (!in_array($inn_length = strlen($value), [10, 12])) {
            throw new DomainException('INN length not equal 10 or 12.');
        }

        $result = false;
        $check_digit = function($inn, $coefficients) {
            $n = 0;
            foreach ($coefficients as $i => $k) {
                $n += $k * (int) $inn{$i};
            }
            return $n % 11 % 10;
        };
        switch ($inn_length) {
            case 10:
                $n10 = $check_digit($value, [2, 4, 10, 3, 5, 9, 4, 6, 8]);
                if ($n10 === (int) $value{9}) {
                    $result = true;
                }
                break;
            case 12:
                $n11 = $check_digit($value, [7, 2, 4, 10, 3, 5, 9, 4, 6, 8]);
                $n12 = $check_digit($value, [3, 7, 2, 4, 10, 3, 5, 9, 4, 6, 8]);
                if (($n11 === (int) $value{10}) && ($n12 === (int) $value{11})) {
                    $result = true;
                }
                break;
        }
        if (!$result) {
            throw new DomainException('INN invalid hash sum.');
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
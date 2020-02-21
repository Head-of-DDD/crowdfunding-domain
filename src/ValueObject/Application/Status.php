<?php


namespace HeadOfDDD\Crowdfunding\Domain\ValueObject\Application;


use HeadOfDDD\Crowdfunding\Domain\Exception\DomainException;

class Status
{
    protected $value;

    public const DRAFT = 'draft';
    public const DECLINED_BY_AUTHOR = 'declined_by_author';
    public const NEED_MODERATION = 'need_moderation';
    public const IN_MODERATION = 'in_moderation';
    public const DECLINED_AFTER_MODERATION = 'declined_after_moderation';
    public const ACCEPTED_AFTER_MODERATION = 'accepted_after_moderation';
    public const IN_PROCESS = 'in_progress';
    public const DECLINED_AFTER_PROCESS = 'declined_after_process';
    public const FINISHED = 'finished';

    private const ALLOWED_STATUSES = [
        self::DRAFT,
        self::DECLINED_BY_AUTHOR,
        self::NEED_MODERATION,
        self::IN_MODERATION,
        self::DECLINED_AFTER_MODERATION,
        self::ACCEPTED_AFTER_MODERATION,
        self::IN_PROCESS,
        self::DECLINED_AFTER_PROCESS,
        self::FINISHED,
    ];

    public function __construct(string $value)
    {
        if (!self::isValid($value)) {
            throw new DomainException('Status name not allowed.');
        }

        $this->value = $value;
    }

    public static function isValid(string $value): bool
    {
        return in_array($value, self::ALLOWED_STATUSES, true);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public static function canMoveStatus(Status $oldStatus, Status $newStatus): bool
    {
        if ($oldStatus === $newStatus) return true;

        $transitions = [
            self::DRAFT                     => [self::NEED_MODERATION, self::DECLINED_BY_AUTHOR],
            self::DECLINED_BY_AUTHOR        => [self::DRAFT],
            self::NEED_MODERATION           => [self::IN_MODERATION],
            self::IN_MODERATION             => [self::DECLINED_AFTER_MODERATION, self::ACCEPTED_AFTER_MODERATION],
            self::DECLINED_AFTER_MODERATION => [self::NEED_MODERATION, self::DECLINED_BY_AUTHOR],
            self::ACCEPTED_AFTER_MODERATION => [self::IN_PROCESS],
            self::IN_PROCESS                => [self::DECLINED_AFTER_PROCESS],
            self::DECLINED_AFTER_PROCESS    => [],
            self::FINISHED                  => [],
        ];

        $transitionsForStatus = $transitions[(string)$oldStatus];

        return count($transitionsForStatus) > 0 && in_array((string)$newStatus, $transitionsForStatus, true);
    }
}
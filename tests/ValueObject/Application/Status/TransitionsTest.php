<?php

declare(strict_types=1);

namespace HeadOfDDD\Crowdfunding\Domain\Tests\ValueObject\Application\Status;

use HeadOfDDD\Crowdfunding\Domain\ValueObject\Application\Status;
use PHPUnit\Framework\TestCase;

final class TransitionsTest extends TestCase
{
    public function testDraftMoveSuccess(): void
    {
        $draftStatus = new Status(Status::DRAFT);
        $needModerationStatus = new Status(Status::NEED_MODERATION);

        $this->assertTrue(Status::canMoveStatus($draftStatus, $needModerationStatus));
    }

    public function testDraftMoveToFinish(): void
    {
        $draftStatus = new Status(Status::DRAFT);
        $needModerationStatus = new Status(Status::FINISHED);

        $this->assertFalse(Status::canMoveStatus($draftStatus, $needModerationStatus));
    }
}
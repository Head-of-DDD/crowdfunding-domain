<?php

declare(strict_types=1);

namespace HeadOfDDD\Crowdfunding\Domain\Tests\ValueObject\Application\Status;

use HeadOfDDD\Crowdfunding\Domain\ValueObject\Application\Status;
use PHPUnit\Framework\TestCase;

final class CreateTest extends TestCase
{
    public function testSuccess(): void
    {
        $status = new Status(Status::DRAFT);

        $this->assertEquals((string)$status, Status::DRAFT);
    }
}
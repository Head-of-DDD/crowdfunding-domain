<?php


namespace HeadOfDDD\Crowdfunding\Domain\Aggregate;


use HeadOfDDD\Crowdfunding\Domain\Entity\Company;
use HeadOfDDD\Crowdfunding\Domain\ValueObject\Application\Status;
use HeadOfDDD\Crowdfunding\Domain\ValueObject\Id;
use HeadOfDDD\Crowdfunding\Domain\ValueObject\Price;

class Application
{
    /** @var Id */
    protected $id;
    /** @var Id */
    protected $borrowerId;
    /** @var Company */
    protected $company;
    /** @var Price */
    protected $needSum;
    /** @var string */
    protected $description;
    /** @var Status */
    protected $status;
}
<?php


namespace HeadOfDDD\Crowdfunding\Domain\Entity;

use HeadOfDDD\Crowdfunding\Domain\ValueObject\Id;
use HeadOfDDD\Crowdfunding\Domain\ValueObject\INN;
use HeadOfDDD\Crowdfunding\Domain\ValueObject\OGRN;
use HeadOfDDD\Crowdfunding\Domain\ValueObject\OGRNIP;
use HeadOfDDD\Crowdfunding\Domain\Exception\DomainException;

class Company
{
    /** @var Id */
    private $id;
    /** @var string */
    private $shortName;
    /** @var string */
    private $fullName;
    /** @var INN */
    private $inn;
    /** @var OGRN|null */
    private $ogrn;
    /** @var OGRNIP|null */
    private $ogrnip;

    public function __construct(Id $id, string $shortName, string $fullName, INN $inn, ?OGRN $ogrn = null, ?OGRNIP $ogrnip = null)
    {
        if($ogrn === null && $ogrnip === null) {
            throw new DomainException('Company need OGRN or OGRNIP.');
        }

        $this->id = $id;
        $this->shortName = $shortName;
        $this->fullName = $fullName;
        $this->inn = $inn;
        $this->ogrn = $ogrn;
        $this->ogrnip = $ogrnip;
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getShortName(): string
    {
        return $this->shortName;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @return INN
     */
    public function getInn(): INN
    {
        return $this->inn;
    }

    /**
     * @return OGRN|null
     */
    public function getOgrn(): ?OGRN
    {
        return $this->ogrn;
    }

    /**
     * @return OGRNIP|null
     */
    public function getOgrnip(): ?OGRNIP
    {
        return $this->ogrnip;
    }
}
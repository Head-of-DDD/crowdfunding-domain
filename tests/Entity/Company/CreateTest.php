<?php

declare(strict_types=1);

namespace HeadOfDDD\Crowdfunding\Domain\Tests\Entity\Company;

use HeadOfDDD\Crowdfunding\Domain\Entity\Company;
use HeadOfDDD\Crowdfunding\Domain\ValueObject\Id;
use HeadOfDDD\Crowdfunding\Domain\ValueObject\INN;
use HeadOfDDD\Crowdfunding\Domain\ValueObject\OGRN;
use HeadOfDDD\Crowdfunding\Domain\ValueObject\OGRNIP;
use PHPUnit\Framework\TestCase;

final class CreateTest extends TestCase
{
    public function testSuccess(): void
    {
        $companyId = Id::next();
        $shortName = 'ООО "Рога и Копыта"';
        $fullName = 'Общество с ограниченной ответсвенностью "Рога и Копыта"';
        $inn = '0708120665';
        $ogrn = '1061790175688';
        $ogrnIP = null;

        $company = new Company(
            new Id($companyId),
            $shortName,
            $fullName,
            new INN($inn),
            new OGRN($ogrn),
            $ogrnIP
        );

        $this->assertEquals($company->getId(), $companyId);
        $this->assertEquals($company->getShortName(), $shortName);
        $this->assertEquals($company->getFullName(), $fullName);
        $this->assertEquals($company->getInn(), $inn);
        $this->assertEquals($company->getOgrn(), $ogrn);
        $this->assertEquals($company->getOgrnip(), $ogrnIP);
    }

    public function testCreateIpCompanySuccess(): void
    {
        $companyId = Id::next();
        $shortName = 'ООО "Рога и Копыта"';
        $fullName = 'Общество с ограниченной ответсвенностью "Рога и Копыта"';
        $inn = '0708120665';
        $ogrn = null;
        $ogrnIP = '317271051349288';

        $company = new Company(
            new Id($companyId),
            $shortName,
            $fullName,
            new INN($inn),
            $ogrn,
            new OGRNIP($ogrnIP)
        );

        $this->assertEquals($company->getId(), $companyId);
        $this->assertEquals($company->getShortName(), $shortName);
        $this->assertEquals($company->getFullName(), $fullName);
        $this->assertEquals($company->getInn(), $inn);
        $this->assertEquals($company->getOgrn(), $ogrn);
        $this->assertEquals($company->getOgrnip(), $ogrnIP);
    }
}
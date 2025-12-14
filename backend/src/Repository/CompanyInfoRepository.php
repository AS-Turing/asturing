<?php

namespace App\Repository;

use App\Entity\CompanyInfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompanyInfo>
 */
class CompanyInfoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanyInfo::class);
    }

    public function findCompanyInfo(): ?CompanyInfo
    {
        return $this->findOneBy([]);
    }
}

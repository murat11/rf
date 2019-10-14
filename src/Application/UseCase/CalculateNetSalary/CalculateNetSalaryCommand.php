<?php

namespace App\Application\UseCase\CalculateNetSalary;

use App\Domain\Salary\SalaryCalculationRequest;

/**
 * Class CalculateGrossSalaryCommand
 */
class CalculateNetSalaryCommand extends SalaryCalculationRequest
{
    /**
     * @param string $name
     * @param float $netGrossSalary
     * @param int $age
     * @param int $numberOfKids
     * @param bool $usesCompanyCar
     */
    public function __construct(string $name, float $netGrossSalary, int $age, int $numberOfKids, bool $usesCompanyCar)
    {
        parent::__construct($name, $netGrossSalary, $age, $numberOfKids, $usesCompanyCar);
    }
}

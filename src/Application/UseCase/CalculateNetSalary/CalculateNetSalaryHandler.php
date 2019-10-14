<?php

namespace App\Application\UseCase\CalculateNetSalary;

use App\Domain\Salary\SalaryCalculator;

class CalculateNetSalaryHandler
{
    /**
     * @var SalaryCalculator
     */
    private $salaryCalculator;

    /**
     * @param SalaryCalculator $salaryCalculator
     */
    public function __construct(SalaryCalculator $salaryCalculator)
    {
        $this->salaryCalculator = $salaryCalculator;
    }

    /**
     * @param CalculateNetSalaryCommand $command
     *
     * @return float
     */
    public function handle(CalculateNetSalaryCommand $command): float
    {
        return $this->salaryCalculator->calculateNetSalary($command);
    }
}

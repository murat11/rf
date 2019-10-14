<?php declare(strict_types=1);
namespace App\Domain\Salary\SalaryCalculationRules;

use App\Domain\Salary\SalaryCalculationRequest;

interface SalaryCalculationRuleInterface
{
    /**
     * @param float    $amount
     * @param SalaryCalculationRequest $calculationRequest
     *
     * @return float
     */
    public function applyRuleToSalary(float $amount, SalaryCalculationRequest $calculationRequest): float;
}

<?php declare(strict_types=1);

namespace App\Domain\Salary\TaxCalculationRules;

use App\Domain\Salary\SalaryCalculationRequest;

/**
 * Class EmployeeTaxResolverInterface
 */
interface TaxCalculationRuleInterface
{
    /**
     * @param float $taxValue
     * @param SalaryCalculationRequest $salaryCalculationRequest
     *
     * @return float
     */
    public function applyOnTax(float $taxValue, SalaryCalculationRequest $salaryCalculationRequest): float;
}

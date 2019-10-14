<?php

namespace App\Domain\Salary\SalaryCalculationRules;

use App\Domain\Salary\SalaryCalculationRequest;
use App\Domain\Salary\TaxCalculationRules\TaxCalculationRuleInterface;

/**
 * Class TaxingCalculatorRule
 */
class TaxedSalaryCalculationRule implements SalaryCalculationRuleInterface
{

    /**
     * @var float
     */
    private $defaultTax;

    /**
     * @var TaxCalculationRuleInterface[]
     */
    private $taxCalculationRules;

    /**
     * @param float $defaultTax
     * @param TaxCalculationRuleInterface[] $taxCalculationRules
     */
    public function __construct(float $defaultTax, array $taxCalculationRules)
    {
        $this->defaultTax = $defaultTax;
        $this->taxCalculationRules = $taxCalculationRules;
    }

    /**
     * @inheritDoc
     */
    public function applyRuleToSalary(float $amount, SalaryCalculationRequest $calculationRequest): float
    {
        $amount *= (1 - $this->getTaxValue($calculationRequest) / 100);

        return $amount;
    }

    /**
     * @inheritDoc
     */
    private function getTaxValue(SalaryCalculationRequest $salaryCalculationRequest): float
    {
        $tax = $this->defaultTax;
        foreach ($this->taxCalculationRules as $taxResolver) {
            $tax = $taxResolver->applyOnTax($tax, $salaryCalculationRequest);
        }

        return $tax;
    }
}

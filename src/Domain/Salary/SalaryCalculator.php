<?php

namespace App\Domain\Salary;

use App\Domain\Salary\SalaryCalculationRules\SalaryCalculationRuleInterface;

/**
 * Class TaxAwareSalaryCalculator
 */
class SalaryCalculator
{
    /**
     * @var SalaryCalculationRuleInterface
     */
    private $amountRule;

    /**
     * @var SalaryCalculationRuleInterface
     */
    private $taxRule;

    public function __construct(SalaryCalculationRuleInterface $amountRule, SalaryCalculationRuleInterface $taxRule)
    {
        $this->amountRule = $amountRule;
        $this->taxRule = $taxRule;
    }

    /**
     * @inheritDoc
     */
    public function calculateGrossSalary(SalaryCalculationRequest $calculationRequest): float
    {
        $salary = $calculationRequest->getNetSalary();
        $salary = $this->amountRule->applyRuleToSalary($salary, $calculationRequest);
        $salary = $this->taxRule->applyRuleToSalary($salary, $calculationRequest);

        return $salary;
    }
}

<?php declare(strict_types=1);

namespace App\Domain\Salary\SalaryCalculationRules;

use App\Domain\Salary\SalaryCalculationRequest;

/**
 * Class ChainedSalaryCalculator
 *
 */
class ChainedSalaryCalculationRule implements SalaryCalculationRuleInterface
{
    /**
     * @var SalaryCalculationRuleInterface[]
     */
    private $calculators;

    /**
     * ChainedSalaryCalculator constructor.
     *
     * @param SalaryCalculationRuleInterface[] $calculators
     */
    public function __construct(array $calculators)
    {
        foreach ($calculators as $calculator) {
            $this->addCalculator($calculator);
        }
    }

    public function addCalculator(SalaryCalculationRuleInterface $salaryCalculator)
    {
        $this->calculators[] = $salaryCalculator;
    }

    /**
     * @inheritDoc
     */
    public function applyRuleToSalary(float $amount, SalaryCalculationRequest $calculationRequest): float
    {
        foreach ($this->calculators as $calculator) {
            $amount = $calculator->applyRuleToSalary($amount, $calculationRequest);
        }

        return $amount;
    }
}

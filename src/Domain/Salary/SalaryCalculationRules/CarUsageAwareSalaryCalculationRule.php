<?php

namespace App\Domain\Salary\SalaryCalculationRules;

use App\Domain\Salary\SalaryCalculationRequest;

/**
 * Class CarUsageAwareSalaryCalculator
 */
class CarUsageAwareSalaryCalculationRule implements SalaryCalculationRuleInterface
{
    /**
     * @var float
     */
    private $fee;

    /**
     * @param float $feeForCar
     */
    public function __construct(float $feeForCar)
    {
        $this->fee = $feeForCar;
    }

    /**
     * @inheritDoc
     */
    public function applyRuleToSalary(float $amount, SalaryCalculationRequest $calculationRequest): float
    {
        if ($calculationRequest->isUsesCompanyCar()) {
            $amount -= $this->fee;
        }

        return $amount;
    }
}

<?php declare(strict_types=1);

namespace App\Domain\Salary\SalaryCalculationRules;

use App\Domain\Salary\SalaryCalculationRequest;

/**
 * Class AgeRespectingCalculator
 */
class AgeRespectingSalaryCalculationRule implements SalaryCalculationRuleInterface
{
    /**
     * @var int
     */
    private $ageToRespect;

    /**
     * @var float
     */
    private $percentToAdd;

    /**
     * @param int $ageToRespect
     * @param float $percentToAdd
     */
    public function __construct(int $ageToRespect, float $percentToAdd)
    {
        $this->ageToRespect = $ageToRespect;
        $this->percentToAdd = $percentToAdd;
    }

    /**
     * @inheritDoc
     */
    public function applyRuleToSalary(float $amount, SalaryCalculationRequest $calculationRequest): float
    {
        if ($calculationRequest->getAge() >= $this->ageToRespect) {
            $amount *= (1 + $this->percentToAdd / 100);
        }

        return $amount;
    }
}

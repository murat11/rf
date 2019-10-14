<?php declare(strict_types=1);

namespace App\Domain\Salary\TaxCalculationRules;

use App\Domain\Salary\SalaryCalculationRequest;

/**
 * Class KidsRespectingRule
 * @package App\Domain\Salary\Taxes
 */
class KidsRespectingRule implements TaxCalculationRuleInterface
{
    /**
     * @var int
     */
    private $minNumberOfKids;

    /**
     * @var float
     */
    private $taxReducer;

    /**
     * KidsRespectingRule constructor.
     * @param int $minNumberOfKids
     * @param float $taxReducer a number to reduce tax multiplier by (0.02 for example)
     */
    public function __construct(int $minNumberOfKids, float $taxReducer)
    {
        $this->minNumberOfKids = $minNumberOfKids;
        $this->taxReducer = $taxReducer;
    }

    /**
     * @inheritDoc
     */
    public function applyOnTax(float $taxValue, SalaryCalculationRequest $salaryCalculationRequest): float
    {
        if ($salaryCalculationRequest->getNumberOfKids() >= $this->minNumberOfKids) {
            $taxValue -= $this->taxReducer;
        }

        return $taxValue;
    }
}
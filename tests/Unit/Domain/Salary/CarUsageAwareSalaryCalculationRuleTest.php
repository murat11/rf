<?php declare(strict_types=1);

namespace App\Test\Unit\Domain\Salary;

use App\Domain\Salary\SalaryCalculationRequest;
use App\Domain\Salary\SalaryCalculationRules\CarUsageAwareSalaryCalculationRule;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CarUsageAwareSalaryCalculationRuleTest extends TestCase
{
    public function testItAppliedFee()
    {
        /** @var SalaryCalculationRequest | MockObject $calculationRequest */
        $calculationRequest = $this->createMock(SalaryCalculationRequest::class);
        $calculationRequest->method('isUsesCompanyCar')->willReturn(true);

        $rule = new CarUsageAwareSalaryCalculationRule(500);
        $this->assertEquals(4500, $rule->applyRuleToSalary(5000, $calculationRequest));
    }

    public function testFeesNotApplicable()
    {
        /** @var SalaryCalculationRequest | MockObject $calculationRequest */
        $calculationRequest = $this->createMock(SalaryCalculationRequest::class);
        $calculationRequest->method('isUsesCompanyCar')->willReturn(false);

        $rule = new CarUsageAwareSalaryCalculationRule(500);
        $this->assertEquals(5000, $rule->applyRuleToSalary(5000, $calculationRequest));
    }
}

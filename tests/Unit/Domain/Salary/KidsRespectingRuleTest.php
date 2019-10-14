<?php

namespace App\Test\Unit\Domain\Salary;

use App\Domain\Salary\SalaryCalculationRequest;
use App\Domain\Salary\TaxCalculationRules\KidsRespectingRule;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class KidsRespectingRuleTest extends TestCase
{
    public function testItAppliedOk()
    {
        $rule = new KidsRespectingRule(3, 5);

        /** @var SalaryCalculationRequest | MockObject $calculationRequest */
        $calculationRequest = $this->createMock(SalaryCalculationRequest::class);
        $calculationRequest->method('getNumberOfKids')->willReturn(3);

        $this->assertEquals(18, $rule->applyOnTax(23, $calculationRequest));
    }

    public function testItsNotApplied()
    {
        $rule = new KidsRespectingRule(3, 5);

        /** @var SalaryCalculationRequest | MockObject $calculationRequest */
        $calculationRequest = $this->createMock(SalaryCalculationRequest::class);
        $calculationRequest->method('getNumberOfKids')->willReturn(2);

        $this->assertEquals(23, $rule->applyOnTax(23, $calculationRequest));
    }
}

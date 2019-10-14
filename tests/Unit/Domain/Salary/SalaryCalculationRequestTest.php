<?php declare(strict_types=1);

namespace App\Test\Unit\Domain\Salary;

use App\Domain\Salary\SalaryCalculationRequest;
use PHPUnit\Framework\TestCase;

class SalaryCalculationRequestTest extends TestCase
{
    public function testItIsInitializedProperly()
    {
        $request = new SalaryCalculationRequest('John Doe', 1000, 30, 5, true);
        $this->assertEquals('John Doe', $request->getName());
        $this->assertEquals(1000, $request->getGrossSalary());
        $this->assertEquals(30, $request->getAge());
        $this->assertEquals(5, $request->getNumberOfKids());
        $this->assertTrue($request->isUsesCompanyCar());
    }
}

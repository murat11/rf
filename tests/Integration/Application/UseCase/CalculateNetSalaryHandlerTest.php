<?php declare(strict_types=1);

namespace App\Test\Integration\Application\UseCase;

use App\Application\UseCase\CalculateNetSalary\CalculateNetSalaryCommand;
use App\Application\UseCase\CalculateNetSalary\CalculateNetSalaryHandler;
use App\Domain\Salary\SalaryCalculatorFactory;
use PHPUnit\Framework\TestCase;

class CalculateNetSalaryHandlerTest extends TestCase
{
    /**
     * @var CalculateNetSalaryHandler
     */
    private $handler;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->handler = new CalculateNetSalaryHandler(
            (new SalaryCalculatorFactory())
                ->createSalaryCalculator(20,50, 7, 3, 2,500)
        );
    }

    /**
     * @dataProvider dataProvider
     */
    public function testOk($name, $salaryGross, $age, $numberOfKids, $usesCar, $result)
    {
        $this->assertEquals($result, $this->handler->handle(new CalculateNetSalaryCommand($name, $salaryGross, $age, $numberOfKids, $usesCar)));
    }

    public function dataProvider()
    {
        return [
            ['Alice', 6000, 26, 2, false, 4800],
            ['Bob', 4000, 52, 0, true, 3024],
            ['Charlie', 5000, 36, 3, true, 3690],
        ];
    }
}

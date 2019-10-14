<?php declare(strict_types=1);
namespace App\Domain\Salary;

/**
 * Class SalaryCalculationRequest
 */
class SalaryCalculationRequest
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var \DateTimeInterface
     */
    private $age;

    /**
     * @var int
     */
    private $numberOfKids;

    /**
     * @var bool
     */
    private $usesCompanyCar;

    /**
     * @var float
     */
    private $grossSalary;

    /**
     * Employee constructor.
     *
     * @param string $name
     * @param float $grossSalary
     * @param int $age
     * @param int $numberOfKids
     * @param bool $usesCompanyCar
     */
    public function __construct(string $name, float $grossSalary, int $age, int $numberOfKids = 0, bool $usesCompanyCar = false)
    {
        $this->name = $name;
        $this->age = $age;
        $this->numberOfKids = $numberOfKids;
        $this->usesCompanyCar = $usesCompanyCar;
        $this->grossSalary = $grossSalary;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @return int
     */
    public function getNumberOfKids(): int
    {
        return $this->numberOfKids;
    }

    /**
     * @return bool
     */
    public function isUsesCompanyCar(): bool
    {
        return $this->usesCompanyCar;
    }

    /**
     * @return float
     */
    public function getGrossSalary(): float
    {
        return $this->grossSalary;
    }
}

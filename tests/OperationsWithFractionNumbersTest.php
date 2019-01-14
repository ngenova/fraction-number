<?php

require_once dirname(__FILE__) .  '/../src/FractionNumber.php';
require_once dirname(__FILE__) .  '/../src/OperationsWithFractionNumbers.php';

use PHPUnit\Framework\TestCase;

class OperationsWithFractionNumbersTest extends TestCase
{
    /**
     * Tests method addition in OperationsWithFractionNumbers.
     *
     * @dataProvider dataAddition
     *
     * @param FractionNumber $first
     * @param FractionNumber $second
     * @param FractionNumber $result
     */
	public function testAddition(FractionNumber $first, FractionNumber $second, FractionNumber $result)
	{
		$this->assertEquals(OperationsWithFractionNumbers::addition($first, $second), $result);
	}

    /**
     * Data for addition in OperationsWithFractionNumbers.
     *
     * @return array
     */
    public function dataAddition()
	{
		return [
			[new FractionNumber(1, 2), new FractionNumber(1, 4), new FractionNumber(3, 4)],
			[new FractionNumber(0, 8), new FractionNumber(1, 4), new FractionNumber(1, 4)],
			[new FractionNumber(8, 8), new FractionNumber(1, 4), new FractionNumber(5, 4)],
			[new FractionNumber(7, 3), new FractionNumber(4, 6), new FractionNumber(3, 1)],
			[new FractionNumber(0, 8), new FractionNumber(1, -4), new FractionNumber(-1, 4)],
			[new FractionNumber(0, -8), new FractionNumber(-1, -4), new FractionNumber(1, 4)],
			[new FractionNumber(-2, 8), new FractionNumber(1, -4), new FractionNumber(-1, 2)],
			[new FractionNumber(2, -8), new FractionNumber(1, 4), new FractionNumber(0, 1)],
			[new FractionNumber(-3, 8), new FractionNumber(-1, -4), new FractionNumber(-1, 8)],
		];
	}

    /**
     * Tests method subtraction in OperationsWithFractionNumbers.
     *
     * @dataProvider dataSubtraction
     *
     * @param FractionNumber $first
     * @param FractionNumber $second
     * @param FractionNumber $result
     */
	public function testSubtraction(FractionNumber $first, FractionNumber $second, FractionNumber $result)
	{
		$this->assertEquals(OperationsWithFractionNumbers::subtraction($first, $second), $result);
	}

    /**
     * Data for subtraction in OperationsWithFractionNumbers.
     *
     * @return array
     */
    public function dataSubtraction()
	{
		return [
			[new FractionNumber(1, 2), new FractionNumber(1, 4), new FractionNumber(1, 4)],
			[new FractionNumber(0, 8), new FractionNumber(1, 4), new FractionNumber(1, -4)],
			[new FractionNumber(-8, 8), new FractionNumber(1, 4), new FractionNumber(-5, 4)],
			[new FractionNumber(7, 5), new FractionNumber(4, 10), new FractionNumber(1, 1)],
			[new FractionNumber(0, 8), new FractionNumber(1, -4), new FractionNumber(1, 4)],
			[new FractionNumber(2, -8), new FractionNumber(-1, 4), new FractionNumber(0, 1)],
			[new FractionNumber(-2, 8), new FractionNumber(-1, -4), new FractionNumber(-1, 2)],
		];
	}

    /**
     * Tests method multiplication in OperationsWithFractionNumbers.
     *
     * @dataProvider dataMultiplication
     *
     * @param FractionNumber $first
     * @param FractionNumber $second
     * @param FractionNumber $result
     */
	public function testMultiplication(FractionNumber $first, FractionNumber $second, FractionNumber $result)
	{
		$this->assertEquals(OperationsWithFractionNumbers::multiplication($first, $second), $result);
	}

    /**
     * Data for multiplication in OperationsWithFractionNumbers.
     *
     * @return array
     */
    public function dataMultiplication()
	{
		return [
			[new FractionNumber(1, 2), new FractionNumber(1, 4), new FractionNumber(1, 8)],
			[new FractionNumber(0, 8), new FractionNumber(1, 4), new FractionNumber(0, 1)],
			[new FractionNumber(8, -8), new FractionNumber(1, 4), new FractionNumber(-1, 4)],
			[new FractionNumber(1, 3), new FractionNumber(-1, 4), new FractionNumber(1, -12)],
			[new FractionNumber(-2, 6), new FractionNumber(1, -4), new FractionNumber(1, 12)],
			[new FractionNumber(2, -6), new FractionNumber(-1, -4), new FractionNumber(-1, 12)],
		];
	}

    /**
     * Tests method partition in OperationsWithFractionNumbers.
     *
     * @dataProvider dataPartition
     *
     * @param FractionNumber $first
     * @param FractionNumber $second
     * @param FractionNumber $result
     */
	public function testPartition(FractionNumber $first, FractionNumber $second, FractionNumber $result)
	{
		$this->assertEquals(OperationsWithFractionNumbers::partition($first, $second), $result);
	}

    /**
     * Data for partition in OperationsWithFractionNumbers.
     *
     * @return array
     */
    public function dataPartition()
	{
		return [
			[new FractionNumber(1, 2), new FractionNumber(1, 4), new FractionNumber(2, 1)],
			[new FractionNumber(0, 8), new FractionNumber(1, 4), new FractionNumber(0, 1)],
			[new FractionNumber(8, -8), new FractionNumber(1, 4), new FractionNumber(-4, 1)],
			[new FractionNumber(7, 5), new FractionNumber(4, 10), new FractionNumber(7, 2)],
			[new FractionNumber(1, 8), new FractionNumber(1, -4), new FractionNumber(-1, 2)],
			[new FractionNumber(-2, 8), new FractionNumber(1, -4), new FractionNumber(1, 1)],
			[new FractionNumber(2, -8), new FractionNumber(-1, -4), new FractionNumber(-1, 1)],
		];
	}

    /**
     * Tests exception from method partition in OperationsWithFractionNumbers.
     *
     * @dataProvider incorrectDataPartition
     * @expectedException DivisionByZeroError
     * @expectedExceptionMessage The divisor is not correct!
     *
     * @param FractionNumber $first
     * @param FractionNumber $second
     */
	public function testSignConstructException(FractionNumber $first, FractionNumber $second)
	{
		OperationsWithFractionNumbers::partition($first, $second);
	}

    /**
     * Incorrect data for partition in OperationsWithFractionNumbers.
     *
     * @return array
     */
    public function incorrectDataPartition()
	{
		return [
				[new FractionNumber(1, 2), new FractionNumber(0, 4)],
				[new FractionNumber(-1, 2), new FractionNumber(0, 1)],
				[new FractionNumber(1, -2), new FractionNumber(-0, 5)],
		];
	}
}
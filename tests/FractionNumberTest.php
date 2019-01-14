<?php

require_once dirname(__FILE__) . '/../src/FractionNumber.php';

use PHPUnit\Framework\TestCase;

class FractionNumberTest extends TestCase
{
    /**
     * Tests constructor in FractionNumber.
     *
     * @dataProvider correctDataConstruct
     *
     * @param FractionNumber $number
     * @param FractionNumber $result
     */
	public function testConstruct(FractionNumber $number, FractionNumber $result)
	{
		$this->assertEquals($number, $result);
	}

    /**
     * Data for constructor in FractionNumber.
     *
     * @return array
     */
    public function correctDataConstruct()
    {
        return [
            [new FractionNumber(2, 4), new FractionNumber(1, 2)],
        	[new FractionNumber(0, 4), new FractionNumber(0, 1)],
        	[new FractionNumber(4, 4), new FractionNumber(2, 2)],
        	[new FractionNumber(8, 4), new FractionNumber(2, 1)],
        	[new FractionNumber(1, -2), new FractionNumber(-1, 2)],
            [new FractionNumber(-2, -4), new FractionNumber(1, 2)],
        ];
    }

    /**
     * Tests InvalidArgumentException in constructor in FractionNumber.
     *
     * @dataProvider incorrectDataConstruct
     * @expectedException InvalidArgumentException
     *
     * @param $x
     * @param $y
     */
    public function testConstructException($x, $y)
    {
    	new FractionNumber($x, $y);
    }

    /**
     * Data for InvalidArgumentException in constructor in FractionNumber.
     *
     * @return array
     */
    public function incorrectDataConstruct()
    {
        return [
            ['aaa', 17],
        	[1, 'aaa'],
        	['aaa', 'aaa'],
        	[1.2, 17],
        	[17, 1.2],
        	[1.2, 1.7],
        	[[1], 17],
        	[1, [17]],
        	[[2], [17]],
        ];
    }

    /**
     * Tests DivisionByZeroError in constructor in FractionNumber.
     *
     * @dataProvider incorrectDataConstructForDivisionByZeroError
     * @expectedException DivisionByZeroError
     *
     * @param $x
     * @param $y
     */
    public function testConstructDivisionByZeroError($x, $y)
    {
        new FractionNumber($x, $y);
    }

    /**
     * Data for DivisionByZeroError in constructor in FractionNumber.
     *
     * @return array
     */
    public function incorrectDataConstructForDivisionByZeroError()
    {
        return [
            [1, 0],
            [1, -0],
        ];
    }

    /**
     * Tests toString in FractionNumber.
     *
     * @dataProvider dataToString
     *
     * @param FractionNumber $number
     * @param string $result
     */
    public function testToString(FractionNumber $number, $result)
    {
    	$this->expectOutputString($result);
    	echo $number;
    }

    /**
     * Data for toString in FractionNumber.
     *
     * @return array
     */
    public function dataToString()
    {
    	return [
    		[new FractionNumber(2, 4), '1/2'],
    		[new FractionNumber(0, 4), '0/1'],
    		[new FractionNumber(4, 4), '1/1'],
    		[new FractionNumber(8, -4), '-2/1'],
    		[new FractionNumber(-5, 7), '-5/7'],
            [new FractionNumber(-2, -4), '1/2'],
    	];
    }

    /**
     * Tests getNumerator in FractionNumber
     *
     * @dataProvider dataGetNumerator
     *
     * @param FractionNumber $number
     * @param integer $result
     */
    public function testGetNumerator(FractionNumber $number, $result)
    {
    	$this->assertEquals($number->getNumerator(), $result);
    }

    /**
     * Data for getNumerator in FractionNumber.
     *
     * @return array
     */
    public function dataGetNumerator()
    {
    	 return [
    	 	 [new FractionNumber(2, 4), 1],
    	 	 [new FractionNumber(0, 4), 0],
    	 	 [new FractionNumber(4, 4), 1],
    	 	 [new FractionNumber(8, 4), 2],
    	 	 [new FractionNumber(5, 7), 5],
             [new FractionNumber(8, -4), -2],
             [new FractionNumber(-5, -7), 5],
             [new FractionNumber(0, -4), 0],
             [new FractionNumber(-0, 4), 0],
             [new FractionNumber(-2, 4), -1],
    	 ];
    }

    /**
     * Tests getDenominator in FractionNumber.
     *
     * @dataProvider dataGetDenominator
     *
     * @param FractionNumber $number
     * @param integer $result
     */
    public function testGetDenominator(FractionNumber $number, $result)
    {
    	$this->assertEquals($number->getDenominator(), $result);
    }

    /**
     * Data for getDenominator in FractionNumber.
     *
     * @return array
     */
    public function dataGetDenominator()
    {
    	return [
    		[new FractionNumber(2, 4), 2],
    		[new FractionNumber(0, 4), 1],
    		[new FractionNumber(4, 4), 1],
    		[new FractionNumber(8, 4), 1],
    		[new FractionNumber(5, 7), 7],
            [new FractionNumber(8, -4), 1],
            [new FractionNumber(-5, -7), 7],
            [new FractionNumber(0, -4), 1],
            [new FractionNumber(-2, 4), 2],
    	];
    }

    /**
     * Tests getReciprocalNumber in FractionNumber
     *
     * @dataProvider dataGetReciprocalNumber
     *
     * @param FractionNumber $number
     * @param FractionNumber $result
     */
    public function testGetReciprocalNumber(FractionNumber $number, FractionNumber $result)
    {
    	$this->assertEquals($number->getReciprocalNumber(), $result);
    }

    /**
     * Data for getReciprocalNumber in FractionNumber.
     *
     * @return array
     */
    public function dataGetReciprocalNumber()
    {
    	return [
            [new FractionNumber(2, 4), new FractionNumber(2, 1)],
            [new FractionNumber(4, 4), new FractionNumber(1, 1)],
            [new FractionNumber(8, 4), new FractionNumber(1, 2)],
            [new FractionNumber(2, 4), new FractionNumber(2, 1)],
            [new FractionNumber(-4, -4), new FractionNumber(1, 1)],
            [new FractionNumber(8, -4), new FractionNumber(1, -2)],
            [new FractionNumber(-2, 4), new FractionNumber(-2, 1)],
    	];
    }

    /**
     * Tests ArithmeticError in getReciprocalNumber in FractionNumber.
     *
     * @dataProvider dataIncorrectGetReciprocalNumber
     * @expectedException ArithmeticError
     * @expectedExceptionMessage There is no reciprocal number!
     *
     * @param FractionNumber $number
     */
    public function testIncorrectGetReciprocalNumber(FractionNumber $number)
    {
    	$number->getReciprocalNumber();
    }

    /**
     * Data for ArithmeticError in getReciprocalNumber in FractionNumber.
     *
     * @return array
     */
    public function dataIncorrectGetReciprocalNumber()
    {
    	return [
    		[new FractionNumber(0, 8)],
            [new FractionNumber(-0, 2)]
    	];
    }
}
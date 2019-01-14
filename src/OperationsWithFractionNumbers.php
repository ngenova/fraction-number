<?php

class OperationsWithFractionNumbers
{
    /**
     * Addition for FractionNumber.
     *
     * @param FractionNumber $first
     * @param FractionNumber $second
     *
     * @return FractionNumber
     */
    public static function addition(FractionNumber $first, FractionNumber $second)
    {
        $multi = self::multiplyWith($first->getDenominator(), $second->getDenominator());
        $firstNumerator = $first->getNumerator() * $multi['first'];
        $secondNumerator = $second->getNumerator() * $multi['second'];
        $denominator = $multi['denominator'];

        return new FractionNumber(($firstNumerator + $secondNumerator), $denominator);
    }

    /**
     * Subtraction for FractionNumber.
     *
     * @param FractionNumber $first
     * @param FractionNumber $second
     *
     * @return FractionNumber
     */
    public static function subtraction(FractionNumber $first, FractionNumber $second)
    {
        $multi = self::multiplyWith($first->getDenominator(), $second->getDenominator());
        $firstNumerator = $first->getNumerator() * $multi['first'];
        $secondNumerator = $second->getNumerator() * $multi['second'];
        $denominator = $multi['denominator'];

        return new FractionNumber(($firstNumerator - $secondNumerator), $denominator);
    }

    /**
     * Multiplication for FractionNumber.
     *
     * @param FractionNumber $first
     * @param FractionNumber $second
     *
     * @return FractionNumber
     */
    public static function multiplication(FractionNumber $first, FractionNumber $second)
    {
        return new FractionNumber(($first->getNumerator() * $second->getNumerator()),
            ($first->getDenominator() * $second->getDenominator()));
    }

    /**
     * Partition for FractionNumber.
     *
     * @param FractionNumber $first
     * @param FractionNumber $second
     *
     * @return FractionNumber
     * @throws DivisionByZeroError
     */
    public static function partition(FractionNumber $first, FractionNumber $second)
	{
        try {
            $reciprocal = $second->getReciprocalNumber();
        } catch (ArithmeticError $e) {
            throw new DivisionByZeroError('The divisor is not correct!');
        }

        return new FractionNumber(($first->getNumerator() * $reciprocal->getNumerator()),
            ($first->getDenominator() * $reciprocal->getDenominator()));
	}

    /**
     * Returns common denominator.
     *
     * @param integer $x
     * @param integer $y
     *
     * @return integer
     */
    protected static function commonDenominator($x, $y)
    {
        $min = min($x, $y);
        $max = max($x, $y);

        if ($x == $y) {
            return $x;
        }

        if ($max % $min == 0) {
            return $max;
        }

        return ($x * $y);
    }

    /**
     * Multiply each denominator with.
     *
     * @param integer $first
     * @param integer $second
     *
     * @return array
     */
    protected static function multiplyWith($first, $second)
    {
        $denominator = self::commonDenominator($first, $second);

        return [
            'first' => ($denominator / $first),
            'second' => ($denominator / $second),
            'denominator' => $denominator
        ];
    }
}
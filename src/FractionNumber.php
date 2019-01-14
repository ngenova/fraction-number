<?php

class FractionNumber
{
	/**
	 * Numerator for FractionNumber.
	 * 
	 * @var integer
	 * @access protected
	 */
	protected $numerator;
	
	/**
	 * Denominator for FractionNumber.
	 * 
	 * @var integer
	 * @access protected
	 */
    protected $denominator;

    /**
     * FractionNumber constructor.
     *
     * @param integer $numerator
     * @param integer $denominator
     *
     * @throws InvalidArgumentException
     * @throws DivisionByZeroError
     */
    public function __construct($numerator, $denominator)
    {
        if (!is_int($numerator) || !is_int($denominator)) {
        	throw new InvalidArgumentException('The numerator and the denominator must be integers!');
        }
    	
    	if ($denominator == 0) {
            throw new DivisionByZeroError('The denominator must be different from zero!');
        }
        
        $result = self::shortening($numerator, $denominator);

        $this->numerator = $result['numerator'];
        $this->denominator = $result['denominator'];
    }
    
    /**
     * Magic method toString for FractionNumber.
     * 
     * @access public
     * 
     * @return string
     */
    public function __toString()
    {
    	return $this->numerator . '/' . $this->denominator;
    }
    
    /**
     * Returns the numerator.
     * 
     * @access public
     * 
     * @return integer
     */
    public function getNumerator()
    {
    	return $this->numerator;
    }
    
    /**
     * Returns the denominator.
     * 
     * @access public
     * 
     * @return integer
     */
    public function getDenominator()
    {
    	 return $this->denominator;
    }

    /**
     * Returns the reciprocal number.
     *
     * @access public
     * @throws ArithmeticError
     *
     * @return FractionNumber
     */
    public function getReciprocalNumber()
    {
    	if ($this->numerator == 0) {
    		throw new ArithmeticError('There is no reciprocal number!');
    	}
    	
    	return new FractionNumber($this->denominator, $this->numerator);
    }
    
    /**
     * Reduce the number.
     * 
     * @param integer $x
     * @param integer $y
     * 
     * @access protected
     *
     * @return array
     */
    protected static function shortening($x, $y)
    {
        if ($x < 0 && $y < 0) {
            $x = abs($x);
        } elseif ($x < 0 || $y < 0) {
            $x = - abs($x);
        }

        $numerator = abs($x);
        $denominator = abs($y);

        if ($numerator == 0 || $denominator == 1) {
            $result = [
    			'numerator' => $x,
    			'denominator' => 1
    		];
    	} elseif ($numerator == 1) {
            $result = [
    				'numerator' => $x,
    				'denominator' => $denominator
    		];
    	} elseif ($numerator == $denominator) {
            $result = [
    				'numerator' => $x / $denominator,
    				'denominator' => 1
    		];
    	} else {
            $divider = self::gcd($numerator, $denominator);

            $result = [
                'numerator' => $x / $divider,
                'denominator' => $denominator / $divider
            ];
        }
    	
    	return $result;
    }
    
    /**
     * Greatest common divisor.
     * 
     * @param integer $x
     * @param integer $y
     * 
     * @access protected
     * 
     * @return integer
     */
    protected static function gcd($x, $y)
    {
    	$min = min($x, $y);
    	$max = max($x, $y);
    	
    	for ($i = $min; $i > 1; $i--) {
    		if ($max % $i == 0 && $min % $i == 0) {
    		    $result = $i;
                break;
    		}
    	}

    	$result = isset($result) ? $result : 1;
    	
    	return $result;
    }
}
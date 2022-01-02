<?php

namespace Fitpass\Generator;

class PasswordGenerator implements PasswordGeneratorInterface
{
// Strength one generates password with at least one lowercase and at least two uppercase letters
    const STRENGTH_ONE = 1;
// Strength two generates password with at least one lowercase and at least two uppercase letters and at least one number between 2 and 5 (2 and 5 included)
    const STRENGTH_TWO = 2;
// Strength three generates password with at least one lowercase and at least two uppercase letters and at least one number between 2 and 5 (2 and 5 included) and with at least one special character from SPECIAL_CHARS constant.
    const STRENGTH_THREE = 3;
    const MIN_LENGTH = 6;
    private const NUMBERS = '2345';
    private const LOWERCASE_LETTERS = 'abcdefghijklmnopqrstuvwxyz';
    private const UPPERCASE_LETTERS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    private const SPECIAL_CHARS = '!#$%&(){}[]=';
    private $length;
    private $strength;

    /**
     * Set length parameter of class
     * @param $value
     * @return mixed|void
     */
    public function setLength($value)
    {
        $this->length = $value;
    }

    /**
     * Get length parameter of class
     * @return mixed
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set strength parameter of class
     * @param $value
     * @return mixed|void
     */
    public function setStrength($value)
    {
        $this->strength = $value;
    }

    /**
     * Get strength parameter of class
     * @return mixed
     */
    public function getStrength()
    {
        return $this->strength;
    }

    public function generatePassword()
    {

    }
}

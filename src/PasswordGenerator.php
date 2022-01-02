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
     * @param $passwordLength
     * @param $passwordStrength
     */
    public function __construct($passwordLength = self::MIN_LENGTH, $passwordStrength = self::STRENGTH_ONE)
    {
        if (!is_int($passwordLength)) {
            throw new \InvalidArgumentException('Expected Integer');
        }

        if (!is_int($passwordStrength)) {
            throw new \InvalidArgumentException('Expected Integer');
        }

        if (!$this->checkStrengthOption($passwordStrength)) {
            throw new \InvalidArgumentException('Expected password option');
        }

        if ($passwordLength < self::MIN_LENGTH) {
            throw new \InvalidArgumentException('Minimum password length is 6');
        }

        $this->setLength($passwordLength);
        $this->setStrength($passwordStrength);
    }

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

    /**
     * Function to check if password strength is set from strength options
     * @param $value
     * @return bool
     */
    private function checkStrengthOption($value)
    {
        if ($value !== self::STRENGTH_ONE && $value !== self::STRENGTH_TWO && $value !== self::STRENGTH_THREE) {
            return false;
        }
        return true;
    }
}

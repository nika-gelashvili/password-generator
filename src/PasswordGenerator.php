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

    /**
     * @return string
     */
    public function generatePassword()
    {
        $randomString = '';

        $fillingCharsArr = $this->setFillingCharsArr();

        $conditionCharArr = $this->setConditionCharsArray();

        $conditions = $this->setConditions();

        foreach ($conditions as $k => $v) {
            if ($v['required']) {
                for ($i = 0; $i < $v['count']; $i++) {
                    $randomKey = random_int(0, strlen($conditionCharArr[$k]) - 1);
                    $randomString .= substr($conditionCharArr[$k], $randomKey, 1);
                }
            }
        }
        if (strlen($randomString) < $this->length) {
            $fillingLength = $this->length - strlen($randomString);
            $fillingCharsArrCount = count($fillingCharsArr);
            for ($i = 0; $i < $fillingLength; $i++) {
                // Get random key of array
                $randomKey = random_int(1, $fillingCharsArrCount);
                // Get random element key from string in random array element
                $randomChar = random_int(0, strlen($fillingCharsArr[$i % $randomKey]) - 1);
                // Retrieve random char from random array element
                $randomString .= substr($fillingCharsArr[$i % $randomKey], $randomChar, 1);
            }
        }

        // Shuffle random string to make it more random as conditions might compromise string.
        return str_shuffle($randomString);
    }

    /**
     * @return string[]
     */
    private function setFillingCharsArr()
    {
        switch ($this->strength) {
            case self::STRENGTH_ONE:
                $chars = [self::LOWERCASE_LETTERS, self::UPPERCASE_LETTERS];
                break;
            case self::STRENGTH_TWO:
                $chars = [self::LOWERCASE_LETTERS, self::UPPERCASE_LETTERS, self::NUMBERS];
                break;
            case self::STRENGTH_THREE:
                $chars = [self::LOWERCASE_LETTERS, self::UPPERCASE_LETTERS, self::NUMBERS, self::SPECIAL_CHARS];
                break;
            default:
                $chars = [self::LOWERCASE_LETTERS, self::UPPERCASE_LETTERS];
        }
        return $chars;
    }

    /**
     * @return array[]
     */
    private function setConditions()
    {
        return [
            'lowercase' => [
                'required' => ($this->strength === self::STRENGTH_ONE || $this->strength === self::STRENGTH_TWO || $this->strength === self::STRENGTH_THREE),
                'min_value' => 'a',
                'max_value' => 'z',
                'count' => 1
            ],
            'uppercase' => [
                'required' => ($this->strength === self::STRENGTH_ONE || $this->strength === self::STRENGTH_TWO || $this->strength === self::STRENGTH_THREE),
                'min_value' => 'A',
                'max_value' => 'Z',
                'count' => 2
            ],
            'numbers' => [
                'required' => ($this->strength === self::STRENGTH_TWO || $this->strength === self::STRENGTH_THREE),
                'min_value' => 2,
                'max_value' => 5,
                'count' => 1
            ],
            'special' => [
                'required' => $this->strength === self::STRENGTH_THREE,
                'min_value' => null,
                'max_value' => null,
                'count' => 1
            ]
        ];
    }

    /**
     * @return string[]
     */
    private function setConditionCharsArray()
    {
        return ['lowercase' => self::LOWERCASE_LETTERS, 'uppercase' => self::UPPERCASE_LETTERS, 'numbers' => self::NUMBERS, 'special' => self::SPECIAL_CHARS];
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

<?php
namespace Fitpass\Generator\Tests;
use Fitpass\Generator\PasswordGenerator;
use PHPUnit\Framework\TestCase;

class PasswordGeneratorTest extends TestCase
{
    private $_object;

    public function setup(): void
    {
        $this->_object = new PasswordGenerator();
    }

    /**
     * @return void
     */
    public function testPasswordGeneration()
    {
        $length = $this->lengthProvider();
        $strengthProvider = $this->strengthProvider();
        $passwordsByStrength = [];
        foreach ($strengthProvider as $value) {
            $this->_object->setLength($length);
            $this->_object->setStrength($value);
            $passwordsByStrength[$value] = $this->_object->generatePassword();
        }

        foreach ($passwordsByStrength as $key => $value) {
            $valueAsArr = str_split($value);
            $this->assertCount($length, $valueAsArr);
            if ($key === PasswordGenerator::STRENGTH_ONE) {
                $this->assertMatchesRegularExpression('/(?=.*[a-z]+)(?=.*[A-Z]{2,})/', $value);
            }
            if ($key === PasswordGenerator::STRENGTH_TWO) {
                $this->assertMatchesRegularExpression('/(?=.*[a-z]+)(?=.*[A-Z]{2,})(?=.*[2-5]+)/', $value);
            }
            if ($key === PasswordGenerator::STRENGTH_THREE) {
                $this->assertMatchesRegularExpression('/(?=.*[a-z]+)(?=.*[A-Z]{2,})(?=.*[2-5]+)(?=.*[!#$%&(){}\[\]=])/', $value);
            }
        }
    }

    /**
     * lengthProvider function returns random integer between 6 and 1000;
     * @return int
     * @throws Exception
     */
    public function lengthProvider()
    {
        return random_int(6, 1000);
    }

    /**
     * strengthProvider function returns all PasswordGenerator strength values available.
     * @return array
     */
    public function strengthProvider()
    {
        return [PasswordGenerator::STRENGTH_ONE, PasswordGenerator::STRENGTH_TWO, PasswordGenerator::STRENGTH_THREE];
    }
}

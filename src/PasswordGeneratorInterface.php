<?php

namespace Fitpass\Generator;

interface PasswordGeneratorInterface
{
    /**
     * Set password generation option length
     * @param $value
     * @return mixed
     */
    public function setLength($value);

    /**
     * Set password generation option strength
     * @param $value
     * @return mixed
     */
    public function setStrength($value);

    /**
     * Get password generation option length
     * @return mixed
     */
    public function getLength();

    /**
     * Get password generation option strength
     * @return mixed
     */
    public function getStrength();

    /**
     * Generate password based on length and strength
     */
    public function generatePassword();
}

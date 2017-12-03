<?php

namespace Jane\JsonSchema\Guesser\JsonSchema;

use Jane\JsonSchema\Guesser\Guess\DateTimeType;
use Jane\JsonSchema\Guesser\GuesserInterface;
use Jane\JsonSchema\Guesser\TypeGuesserInterface;
use Jane\JsonSchema\Model\JsonSchema;
use Jane\JsonSchema\Registry;

class DateTimeGuesser implements GuesserInterface, TypeGuesserInterface
{
    /** @var string Format of date to use */
    private $dateFormat;

    public function __construct($dateFormat = \DateTime::RFC3339)
    {
        $this->dateFormat = $dateFormat;
    }

    /**
     * {@inheritDoc}
     */
    public function supportObject($object)
    {
        return (($object instanceof JsonSchema) && $object->getType() === 'string' && $object->getFormat() === 'date-time');
    }

    /**
     * {@inheritDoc}
     */
    public function guessType($object, $name, $reference, Registry $registry)
    {
        return new DateTimeType($object, $this->dateFormat);
    }
}

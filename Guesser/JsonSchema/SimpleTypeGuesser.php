<?php

namespace Jane\JsonSchema\Guesser\JsonSchema;

use Jane\JsonSchema\Guesser\Guess\Type;
use Jane\JsonSchema\Guesser\GuesserInterface;
use Jane\JsonSchema\Guesser\TypeGuesserInterface;
use Jane\JsonSchema\Model\JsonSchema;
use Jane\JsonSchema\Registry;

class SimpleTypeGuesser implements GuesserInterface, TypeGuesserInterface
{
    protected $typesSupported = [
        'boolean',
        'integer',
        'number',
        'string',
        'null',
    ];

    protected $phpTypesMapping = [
        'boolean' => 'bool',
        'integer' => 'int',
        'number' => 'float',
        'string' => 'string',
        'null' => 'null',
    ];

    protected $excludeFormat = [
        'string' => [
            'date-time',
        ],
    ];

    /**
     * {@inheritdoc}
     */
    public function supportObject($object): bool
    {
        $class = $this->getSchemaClass();

        return ($object instanceof $class)
            &&
            \in_array($object->getType(), $this->typesSupported)
            &&
            (
                !\in_array($object->getType(), $this->excludeFormat)
                ||
                !\in_array($object->getFormat(), $this->excludeFormat[$object->getType()])
            )
        ;
    }

    protected function getSchemaClass(): string
    {
        return JsonSchema::class;
    }

    /**
     * {@inheritdoc}
     */
    public function guessType($object, string $name, string $reference, Registry $registry): Type
    {
        return new Type($object, $this->phpTypesMapping[$object->getType()]);
    }
}

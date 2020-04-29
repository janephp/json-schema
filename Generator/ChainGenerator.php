<?php

namespace Jane\JsonSchema\Generator;

use Jane\JsonSchema\Generator\Context\Context;
use Jane\JsonSchema\Registry\Registry;

abstract class ChainGenerator
{
    /** @var GeneratorInterface[] */
    private $generators = [];

    public function addGenerator(GeneratorInterface $generator): void
    {
        $this->generators[] = $generator;
    }

    abstract protected function createContext(Registry $registry): Context;

    public function generate(Registry $registry): void
    {
        $context = $this->createContext($registry);

        foreach ($registry->getSchemas() as $schema) {
            $context->setCurrentSchema($schema);

            foreach ($this->generators as $generator) {
                $generator->generate($schema, $schema->getRootName(), $context);
            }
        }
    }
}

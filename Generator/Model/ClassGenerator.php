<?php

namespace Jane\JsonSchema\Generator\Model;

use Jane\JsonSchema\Generator\Naming;
use PhpParser\Comment\Doc;
use PhpParser\Node;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt;

trait ClassGenerator
{
    /**
     * The naming service.
     *
     * @return Naming
     */
    abstract protected function getNaming();

    /**
     * Return a model class.
     *
     * @param string $name
     * @param Node[] $properties
     * @param Node[] $methods
     * @param bool   $hasExtensions
     *
     * @return Stmt\Class_
     */
    protected function createModel(string $name, $properties, $methods, bool $hasExtensions = false, bool $deprecated = false): Stmt\Class_
    {
        $attributes = [];

        if ($deprecated) {
            $attributes['comments'] = [new Doc(<<<EOD
/**
 *
 * @deprecated
 */
EOD
            )];
        }

        return new Stmt\Class_(
            new Name($this->getNaming()->getClassName($name)),
            [
                'stmts' => array_merge($properties, $methods),
                'extends' => $hasExtensions ? new Name('\ArrayObject') : null,
            ],
            $attributes
        );
    }
}

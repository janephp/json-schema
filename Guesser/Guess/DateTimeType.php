<?php

namespace Jane\JsonSchema\Guesser\Guess;

use Jane\JsonSchema\Generator\Context\Context;
use PhpParser\Node\Arg;
use PhpParser\Node\Name;
use PhpParser\Node\Expr;

/**
 * Represent a DateTime type.
 */
class DateTimeType extends ObjectType
{
    /**
     * Format of the date to use.
     *
     * @var string
     */
    private $format;

    /**
     * Indicator whether to use DateTime or DateTimeInterface as type hint
     *
     * @var bool
     */
    private $preferInterface;

    public function __construct(object $object, string $format = \DateTime::RFC3339, ?bool $preferInterface = null)
    {
        parent::__construct($object, '\DateTime', '', []);

        $this->format = $format;
        $this->preferInterface = $preferInterface ?? false;
    }

    /**
     * (@inheritDoc}.
     */
    protected function createDenormalizationValueStatement(Context $context, Expr $input, bool $normalizerFromObject = true): Expr
    {
        // \DateTime::createFromFormat($format, $data)
        return new Expr\StaticCall(new Name('\DateTime'), 'createFromFormat', [
            new Arg(new Expr\ConstFetch(new Name('"' . $this->format . '"'))),
            new Arg($input),
        ]);
    }

    /**
     * (@inheritDoc}.
     */
    protected function createNormalizationValueStatement(Context $context, Expr $input, bool $normalizerFromObject = true): Expr
    {
        // $object->format($format);
        return new Expr\MethodCall($input, 'format', [
            new Arg(new Expr\ConstFetch(new Name('"' . $this->format . '"'))),
        ]);
    }

    /**
     * (@inheritDoc}.
     */
    public function createConditionStatement(Expr $input): Expr
    {
        return new Expr\BinaryOp\LogicalAnd(new Expr\FuncCall(
            new Name('is_string'), [
                new Arg($input),
            ]),
            new Expr\BinaryOp\NotIdentical(
                new Expr\ConstFetch(new Name('false')),
                new Expr\StaticCall(new Name('\DateTime'), 'createFromFormat', [
                    new Arg(new Expr\ConstFetch(new Name('"' . $this->format . '"'))),
                    new Arg($input),
                ])
            )
        );
    }

    public function getTypeHint(string $namespace)
    {
        return $this->preferInterface ? '\DateTimeInterface' : '\DateTime';
    }

    public function __toString(): string
    {
        return '\DateTime';
    }
}

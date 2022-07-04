<?php

namespace Jane\JsonSchema\Tests\Expected\Validator;

class ModelValidator implements \Jane\JsonSchema\Tests\Expected\Validator\ValidatorInterface
{
    public function validate($data) : void
    {
        $constraints = array(new \Symfony\Component\Validator\Constraints\Collection(array('fields' => array('enumString' => new \Symfony\Component\Validator\Constraints\Optional(array(new \Symfony\Component\Validator\Constraints\Type(array('0' => 'string')), new \Symfony\Component\Validator\Constraints\Choice(array('choices' => array('foo', 'bar', 'baz'), 'message' => '"{{ value }}" is not part of the set of possible choices for this field: "{{ choices }}".')))), 'enumArrayString' => new \Symfony\Component\Validator\Constraints\Optional(array(new \Symfony\Component\Validator\Constraints\Choice(array('choices' => array('foo', 'bar', 'baz'), 'message' => '"{{ value }}" is not part of the set of possible choices for this field: "{{ choices }}".')))), 'enumNoType' => new \Symfony\Component\Validator\Constraints\Optional(array(new \Symfony\Component\Validator\Constraints\Choice(array('choices' => array('foo', 'bar', 'baz'), 'message' => '"{{ value }}" is not part of the set of possible choices for this field: "{{ choices }}".')))), 'constString' => new \Symfony\Component\Validator\Constraints\Required(array(new \Symfony\Component\Validator\Constraints\Type(array('0' => 'string')), new \Symfony\Component\Validator\Constraints\EqualTo(array('value' => 'Michel', 'message' => 'This value should be equal to "{{ compared_value }}".')))), 'minLengthString' => new \Symfony\Component\Validator\Constraints\Optional(array(new \Symfony\Component\Validator\Constraints\Length(array('min' => 10, 'minMessage' => 'This value is too short. It should have {{ limit }} characters or more.')), new \Symfony\Component\Validator\Constraints\Type(array('0' => 'string')))), 'maxLengthString' => new \Symfony\Component\Validator\Constraints\Optional(array(new \Symfony\Component\Validator\Constraints\Length(array('max' => 36, 'maxMessage' => 'This value is too long. It should have {{ limit }} characters or less.')), new \Symfony\Component\Validator\Constraints\Type(array('0' => 'string')))), 'minMaxLengthString' => new \Symfony\Component\Validator\Constraints\Optional(array(new \Symfony\Component\Validator\Constraints\Length(array('min' => 10, 'minMessage' => 'This value is too short. It should have {{ limit }} characters or more.')), new \Symfony\Component\Validator\Constraints\Length(array('max' => 36, 'maxMessage' => 'This value is too long. It should have {{ limit }} characters or less.')), new \Symfony\Component\Validator\Constraints\Type(array('0' => 'string')))), 'patternString' => new \Symfony\Component\Validator\Constraints\Required(array(new \Symfony\Component\Validator\Constraints\Regex(array('pattern' => '#[a-z0-9\\-]{36}#', 'message' => 'This value is not valid.')), new \Symfony\Component\Validator\Constraints\Type(array('0' => 'string')))), 'arrayMinItems' => new \Symfony\Component\Validator\Constraints\Optional(array(new \Symfony\Component\Validator\Constraints\Count(array('min' => 1, 'minMessage' => 'This array has not enough values. It should have {{ limit }} values or more.')), new \Symfony\Component\Validator\Constraints\Type(array('0' => 'array')))), 'arrayMaxItems' => new \Symfony\Component\Validator\Constraints\Optional(array(new \Symfony\Component\Validator\Constraints\Count(array('max' => 5, 'maxMessage' => 'This array has too much values. It should have {{ limit }} values or less.')), new \Symfony\Component\Validator\Constraints\Type(array('0' => 'array')))), 'arrayMinMaxItems' => new \Symfony\Component\Validator\Constraints\Optional(array(new \Symfony\Component\Validator\Constraints\Count(array('max' => 5, 'maxMessage' => 'This array has too much values. It should have {{ limit }} values or less.')), new \Symfony\Component\Validator\Constraints\Count(array('min' => 1, 'minMessage' => 'This array has not enough values. It should have {{ limit }} values or more.')), new \Symfony\Component\Validator\Constraints\Type(array('0' => 'array')))), 'arrayUnique' => new \Symfony\Component\Validator\Constraints\Optional(array(new \Symfony\Component\Validator\Constraints\Unique(array()), new \Symfony\Component\Validator\Constraints\Type(array('0' => 'array')))), 'numericMultipleOf' => new \Symfony\Component\Validator\Constraints\Optional(array(new \Symfony\Component\Validator\Constraints\DivisibleBy(array('value' => 2.0)), new \Symfony\Component\Validator\Constraints\Type(array('0' => 'integer')))), 'numericMaximum' => new \Symfony\Component\Validator\Constraints\Optional(array(new \Symfony\Component\Validator\Constraints\LessThanOrEqual(array('value' => 10.0)), new \Symfony\Component\Validator\Constraints\Type(array('0' => 'integer')))), 'numericExclusiveMaximum' => new \Symfony\Component\Validator\Constraints\Optional(array(new \Symfony\Component\Validator\Constraints\LessThan(array('value' => 10.0)), new \Symfony\Component\Validator\Constraints\Type(array('0' => 'integer')))), 'numericMinimum' => new \Symfony\Component\Validator\Constraints\Optional(array(new \Symfony\Component\Validator\Constraints\GreaterThanOrEqual(array('value' => 10.0)), new \Symfony\Component\Validator\Constraints\Type(array('0' => 'integer')))), 'numericExclusiveMinimum' => new \Symfony\Component\Validator\Constraints\Optional(array(new \Symfony\Component\Validator\Constraints\GreaterThan(array('value' => 10.0)), new \Symfony\Component\Validator\Constraints\Type(array('0' => 'integer')))), 'emailFormat' => new \Symfony\Component\Validator\Constraints\Optional(array(new \Symfony\Component\Validator\Constraints\Email(array()), new \Symfony\Component\Validator\Constraints\Type(array('0' => 'string')))), 'ipv4Format' => new \Symfony\Component\Validator\Constraints\Optional(array(new \Symfony\Component\Validator\Constraints\Ip(array('version' => '4')), new \Symfony\Component\Validator\Constraints\Type(array('0' => 'string')))), 'ipv6Format' => new \Symfony\Component\Validator\Constraints\Optional(array(new \Symfony\Component\Validator\Constraints\Ip(array('version' => '6')), new \Symfony\Component\Validator\Constraints\Type(array('0' => 'string')))), 'uriFormat' => new \Symfony\Component\Validator\Constraints\Optional(array(new \Symfony\Component\Validator\Constraints\Type(array('0' => 'string')))), 'iriFormat' => new \Symfony\Component\Validator\Constraints\Optional(array(new \Symfony\Component\Validator\Constraints\Type(array('0' => 'string')))), 'uuidFormat' => new \Symfony\Component\Validator\Constraints\Optional(array(new \Symfony\Component\Validator\Constraints\Uuid(array()), new \Symfony\Component\Validator\Constraints\Type(array('0' => 'string')))), 'foo' => new \Symfony\Component\Validator\Constraints\Optional(array())), 'allowExtraFields' => true)));
        $validator = \Symfony\Component\Validator\Validation::createValidator();
        $violations = $validator->validate($data, $constraints);
        if ($violations->count() > 0) {
            throw new \Jane\JsonSchema\Tests\Expected\Validator\ValidationException($violations);
        }
    }
}
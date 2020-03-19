<?php

namespace Jane\JsonSchema\Tests\Expected\Normalizer;

use Jane\JsonSchemaRuntime\Reference;
use Jane\JsonSchemaRuntime\Normalizer\CheckArray;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class OtherchildtypeNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Jane\\JsonSchema\\Tests\\Expected\\Model\\Otherchildtype';
    }
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof \Jane\JsonSchema\Tests\Expected\Model\Otherchildtype;
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        $object = new \Jane\JsonSchema\Tests\Expected\Model\Otherchildtype();
        if (\array_key_exists('inheritedProperty', $data)) {
            $object->setInheritedProperty($data['inheritedProperty']);
        }
        if (\array_key_exists('childProperty', $data)) {
            $object->setChildProperty($data['childProperty']);
        }
        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = array();
        if (null !== $object->getInheritedProperty()) {
            $data['inheritedProperty'] = $object->getInheritedProperty();
        }
        if (null !== $object->getChildProperty()) {
            $data['childProperty'] = $object->getChildProperty();
        }
        return $data;
    }
}
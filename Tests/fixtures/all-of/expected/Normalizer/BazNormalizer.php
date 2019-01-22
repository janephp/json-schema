<?php

namespace Jane\JsonSchema\Tests\Expected\Normalizer;

use Jane\JsonSchemaRuntime\Reference;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class BazNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Jane\\JsonSchema\\Tests\\Expected\\Model\\Baz';
    }
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof \Jane\JsonSchema\Tests\Expected\Model\Baz;
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (!is_object($data)) {
            throw new InvalidArgumentException();
        }
        $object = new \Jane\JsonSchema\Tests\Expected\Model\Baz();
        if (property_exists($data, 'foo')) {
            $object->setFoo($data->{'foo'});
        }
        if (property_exists($data, 'Bar')) {
            $object->setBar($this->denormalizer->denormalize($data->{'Bar'}, 'Jane\\JsonSchema\\Tests\\Expected\\Model\\Bar', 'json', $context));
        }
        if (property_exists($data, 'Baz')) {
            $object->setBaz($this->denormalizer->denormalize($data->{'Baz'}, 'Jane\\JsonSchema\\Tests\\Expected\\Model\\BazBaz', 'json', $context));
        }
        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = new \stdClass();
        if (null !== $object->getFoo()) {
            $data->{'foo'} = $object->getFoo();
        }
        if (null !== $object->getBar()) {
            $data->{'Bar'} = $this->normalizer->normalize($object->getBar(), 'json', $context);
        }
        if (null !== $object->getBaz()) {
            $data->{'Baz'} = $this->normalizer->normalize($object->getBaz(), 'json', $context);
        }
        return $data;
    }
}
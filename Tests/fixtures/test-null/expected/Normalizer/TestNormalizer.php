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
class TestNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Jane\\JsonSchema\\Tests\\Expected\\Model\\Test';
    }
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof \Jane\JsonSchema\Tests\Expected\Model\Test;
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \Jane\JsonSchema\Tests\Expected\Model\Test();
        if (null === $data) {
            return $object;
        }
        if (\array_key_exists('onlyNull', $data) && $data['onlyNull'] !== null) {
            $object->setOnlyNull($data['onlyNull']);
        }
        elseif (\array_key_exists('onlyNull', $data) && $data['onlyNull'] === null) {
            $object->setOnlyNull(null);
        }
        if (\array_key_exists('nullOrString', $data) && $data['nullOrString'] !== null) {
            $value = $data['nullOrString'];
            if (is_string($data['nullOrString'])) {
                $value = $data['nullOrString'];
            } elseif (is_null($data['nullOrString'])) {
                $value = $data['nullOrString'];
            }
            $object->setNullOrString($value);
        }
        elseif (\array_key_exists('nullOrString', $data) && $data['nullOrString'] === null) {
            $object->setNullOrString(null);
        }
        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = array();
        if (null !== $object->getOnlyNull()) {
            $data['onlyNull'] = $object->getOnlyNull();
        }
        if (null !== $object->getNullOrString()) {
            $value = $object->getNullOrString();
            if (is_string($object->getNullOrString())) {
                $value = $object->getNullOrString();
            } elseif (is_null($object->getNullOrString())) {
                $value = $object->getNullOrString();
            }
            $data['nullOrString'] = $value;
        }
        return $data;
    }
}
<?php

namespace Jane\Component\JsonSchema\Tests\Expected\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Jane\Component\JsonSchema\Tests\Expected\Runtime\Normalizer\CheckArray;
use Jane\Component\JsonSchema\Tests\Expected\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\HttpKernel\Kernel;
if (!class_exists(Kernel::class) or (Kernel::MAJOR_VERSION >= 7 or Kernel::MAJOR_VERSION === 6 and Kernel::MINOR_VERSION === 4)) {
    class TestNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []) : bool
        {
            return $type === 'Jane\\Component\\JsonSchema\\Tests\\Expected\\Model\\Test';
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []) : bool
        {
            return $data instanceof \Jane\Component\JsonSchema\Tests\Expected\Model\Test;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []) : mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \Jane\Component\JsonSchema\Tests\Expected\Model\Test();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('foo', $data)) {
                $values = [];
                foreach ($data['foo'] as $value) {
                    $values[] = $this->denormalizer->denormalize($value, 'Jane\\Component\\JsonSchema\\Tests\\Expected\\Model\\TestFooItem', 'json', $context);
                }
                $object->setFoo($values);
            }
            return $object;
        }
        public function normalize(mixed $object, string $format = null, array $context = []) : array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            if ($object->isInitialized('foo') && null !== $object->getFoo()) {
                $values = [];
                foreach ($object->getFoo() as $value) {
                    $values[] = $this->normalizer->normalize($value, 'json', $context);
                }
                $data['foo'] = $values;
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null) : array
        {
            return ['Jane\\Component\\JsonSchema\\Tests\\Expected\\Model\\Test' => false];
        }
    }
} else {
    class TestNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []) : bool
        {
            return $type === 'Jane\\Component\\JsonSchema\\Tests\\Expected\\Model\\Test';
        }
        public function supportsNormalization($data, $format = null, array $context = []) : bool
        {
            return $data instanceof \Jane\Component\JsonSchema\Tests\Expected\Model\Test;
        }
        /**
         * @return mixed
         */
        public function denormalize($data, $type, $format = null, array $context = [])
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \Jane\Component\JsonSchema\Tests\Expected\Model\Test();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('foo', $data)) {
                $values = [];
                foreach ($data['foo'] as $value) {
                    $values[] = $this->denormalizer->denormalize($value, 'Jane\\Component\\JsonSchema\\Tests\\Expected\\Model\\TestFooItem', 'json', $context);
                }
                $object->setFoo($values);
            }
            return $object;
        }
        /**
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            if ($object->isInitialized('foo') && null !== $object->getFoo()) {
                $values = [];
                foreach ($object->getFoo() as $value) {
                    $values[] = $this->normalizer->normalize($value, 'json', $context);
                }
                $data['foo'] = $values;
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null) : array
        {
            return ['Jane\\Component\\JsonSchema\\Tests\\Expected\\Model\\Test' => false];
        }
    }
}
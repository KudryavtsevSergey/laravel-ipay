<?php

declare(strict_types=1);

namespace Sun\IPay\Mapper;

use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class BooleanDenormalizer implements DenormalizerInterface
{
    private const YES = 'Y';

    public function denormalize($data, string $type, string $format = null, array $context = []): bool
    {
        return $data === self::YES;
    }

    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return $type === 'bool';
    }
}

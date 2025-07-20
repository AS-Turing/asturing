<?php

namespace App\Service;

use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class SerializerContextBuilder
{
    public function buildSerializerContext(array $additionalContext = []): array {
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, ?string $format, array $context) {
                return method_exists($object, 'getId') ? $object->getId() : null;
            },
        ];
        return array_merge($additionalContext, $defaultContext);
    }
}


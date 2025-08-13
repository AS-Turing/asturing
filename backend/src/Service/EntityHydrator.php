<?php

namespace App\Service;

use App\Entity\Price;
use function PHPUnit\Framework\isArray;

class EntityHydrator
{
    public function hydrate(array $data, object $entity): object
    {
        foreach ($data as $property => $value) {
            // Transforme `property` en `setProperty`
            $setter = 'set' . ucfirst($property);

            // Vérifie si le setter existe dans la classe
            if (method_exists($entity, $setter) && $value !== null) {

                if (is_array($value) && ($setter !== 'setIncludes' && $setter !== 'setMicroServices')) {
                    foreach ($value as $item) {
                        $entity->$setter($item);
                    }
                } else {
                    $entity->$setter($value);
                }

            }
        }

        return $entity;
    }
}

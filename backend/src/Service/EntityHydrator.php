<?php

namespace App\Service;

class EntityHydrator
{
    public function hydrate(array $data, object $entity): object
    {
        foreach ($data as $property => $value) {
            // Transforme `property` en `setProperty`
            $setter = 'set' . ucfirst($property);

            // Vérifie si le setter existe dans la classe
            if (method_exists($entity, $setter)) {
                $entity->$setter($value);
            }
        }

        return $entity;
    }
}

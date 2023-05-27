<?php

namespace Models;

abstract class Model
{
    /**
     * Convertit le modèle en un tableau clé-valeur.
     *
     * @return array
     */
    public function toArray(): array
    {
        $properties = get_object_vars($this);
        $data = [];

        foreach ($properties as $property => $value) {
            $data[$property] = $value;
        }

        return $data;
    }
}
<?php

namespace DDD\App\Helpers;

class ArrayHelpers
{
    public function flatten($input, $key)
    {
        // $level = 0;
        $output = [];

        // For each object in the array
        foreach ($input as $object) {
            // separate its children
            $children = isset($object->$key) ? $object->$key : [];
            $object->$key = [];

            // and add it to the output array
            $output[] = $object;

            // Recursively flatten the array of children
            $children = $this->flatten($children, $key);

            //  and add the result to the output array
            foreach ($children as $child) {
                $output[] = $child;
            }
        }

        return $output;
    }
}

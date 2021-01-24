<?php

class Square
{
    public $height;
    public $width;
}

class Circle
{
    public $radius;
}

class Triangle
{
    public $base;
    public $height;
}

class AreaCalculator
{
    public function calculate($shapes)
    {
        $area = [];

        foreach ($shapes as $shape) {
            if (is_a($shape, "Square")) {
                $area[] = $shape->width * $shape->height;
            } else if (is_a($shape, 'Circle')) {
                $area[] = pi() * ($shape->radius * $shape->radius);
            } else if (is_a($shape, "Triangle")) {
                $area[] = ($shape->height * $shape->base) / 2;
            }
        }

        return array_sum($area);
    }
}

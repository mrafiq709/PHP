<?php

/**
 * 1. Child funtion arguments must match with
 *    funtion argumets of parent
 * 2. Child funtion return type must match
 *    parent funtion return type
 */
class ParentClass
{
    public $id;

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}

class ChildClass
{
    public $id;

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}

<?php

/**
 * 1. What are higher level modules: 
 *    Anything that accepts the Abstruction and does something with it
 *    donePooping(ToiletInterface $toilet) { $toilet->flush(); }
 * 2. What are lower level modules:
 *    Any class implementing the abstraction.
 *    if a class implements the abstraction,
 *    Then it can do whatever that behavior is ~ in its own way.
 */

interface ToiletInterface
{
    public function flush();
}

// Lower level modules
class PortaPartyToilet implements ToiletInterface
{
    public function flush()
    {
        //
    }
}

// Lower level modules
class GoldenToilet implements ToiletInterface
{
    public function flush()
    {
        //
    }
}

// Higher level modules
class Human
{
    public function donePooping(ToiletInterface $toilet)
    {
        // We don't care how
        // We do care that it can
        $toilet->flush();
    }
}

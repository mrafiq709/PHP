<?php

interface Developer
{
    public function codePHP();
    public function codeRuby();
    public function codeIOS();
}

class PHPDeveloper implements Developer
{
    public function codePHP()
    {
        // php
    }

    public function codeRuby()
    {
        throw new Exception('No PHP code');
    }

    public function codeIOS()
    {
        throw new Exception('No PHP code');
    }
}

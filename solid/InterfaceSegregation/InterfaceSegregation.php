<?php

interface PHPDeveloper
{
    public function codePHP();
}

interface RubyDeveloper
{
    public function codeRuby();
}

interface IOSDeveloper
{
    public function codeIOS();
}

class ScuitDeveloper implements PHPDeveloper
{
    public function codePHP()
    {
        // php
    }
}

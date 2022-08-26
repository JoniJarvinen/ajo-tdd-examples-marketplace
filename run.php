<?php

class A {
    public function test() : self
    {
        return new static();
    }
}

class B extends A
{
    public function test() : self
    {
        return parent::test();
    }
}

$b = new B();

var_dump($b->test());
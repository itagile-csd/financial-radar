<?php

use PHPUnit\Framework\TestCase;

class ExampleUnitTest extends TestCase
{
    public function testExample() {
        assertThat('a', equalToIgnoringCase('A'));
    }
}


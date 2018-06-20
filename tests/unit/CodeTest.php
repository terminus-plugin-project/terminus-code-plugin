<?php

namespace TerminusPluginProject\TerminusCode\Commands;

use PHPUnit\Framework\TestCase;

class CodeTest extends TestCase
{
    $this->TERMINUS_SITE = null;

    /**
     * Constructor method to set values.
     */
    private function __constructor()
    {
        $this->TERMINUS_SITE = getenv('TERMINUS_SITE');
    }

    /**
     * Data provider for testCode.
     *
     * Return an array of arrays, each of which contains the parameter
     * values to be used in one invocation of the testCodeCommand function.
     */
    public function codeTestValues()
    {
        return [
            [$this->TERMINUS_SITE, "$(terminus site:info $this->TERMINUS_SITE --field=name)"],
            ['dev', "$(terminus env:info $this->TERMINUS_SITE.dev --field=id)"],
        ];
    }

    /**
     * Test our CodeCommand class. Each time this function is called, it will
     * be passed data from the data provider function identified by the
     * dataProvider annotation.
     *
     * @dataProvider codeTestValues
     */
    public function testCodeCommand($expected, $command)
    {
        $code = new CodeCommand($this->TERMINUS_SITE);
        $this->assertEquals($expected, $code->execute($command));
    }
}

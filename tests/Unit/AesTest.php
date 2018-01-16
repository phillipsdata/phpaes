<?php
namespace PhpAes\Aes\Tests\Unit;

use PhpAes\Aes;
use PHPUnit_Framework_TestCase;

/**
 * @coversDefaultClass \PhpAes\Aes
 */
class AesTest extends PHPUnit_Framework_TestCase
{

    /**
     * @expectedException LengthException
     * @expectedExceptionMessage The initialization vector must be 128 bits (or 16 characters) long.
     * @covers ::__construct
     */
    public function testConstructIvLengthException()
    {
        new Aes('abcdef0123456789', 'CBC');
    }

    /**
     * @expectedException LengthException
     * @expectedExceptionMessage Key is 120 bits long. *not* 128, 192, or 256.
     * @covers ::__construct
     */
    public function testConstructZlengthException()
    {
        new Aes('abcdef012345678');
    }
}

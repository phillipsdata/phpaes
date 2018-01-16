<?php
namespace PhpAes\Aes\Tests\Integration;

use PhpAes\Aes;
use PHPUnit_Framework_TestCase;

/**
 * @coversDefaultClass \PhpAes\Aes
 */
class AesTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test the cipher
     *
     * @param string $key
     * @param string $mode
     * @param string $iv
     * @param string $input
     * @dataProvider cipherProvider
     * @covers ::encrypt
     * @covers ::decrypt
     * @covers ::invMixColumns
     * @covers ::invShiftRows
     * @covers ::invSubBytes
     * @covers ::keyExpansion
     * @covers ::make32BitWord
     * @covers ::mixColumns
     * @covers ::mult
     * @covers ::rotWord
     * @covers ::shiftRows
     * @covers ::subBytes
     * @covers ::subWord
     */
    public function testCipher($key, $mode, $iv, $input)
    {
        $aes = new Aes($key, $mode, $iv);

        $cipherText = $aes->encrypt($input);

        $result = $aes->decrypt($cipherText);
        $this->assertEquals($result, $input);
    }

    /**
     * Data provider
     *
     * @return array
     */
    public function cipherProvider()
    {
        $iv = '1234567890abcdef';

        $keys = array(
            'abcdefgh01234567',
            'abcdefghijkl012345678901',
            'abcdefghijuklmno0123456789012345'
        );
        $modes = array('ECB', 'CBC', 'CFB', 'OFB');

        $input = array(
            file_get_contents(
                dirname(__FILE__) . DIRECTORY_SEPARATOR
                . "Fixtures" . DIRECTORY_SEPARATOR . 'example.txt'
            ),
            'hello world!',
            ''
        );

        $params = array();
        foreach ($modes as $mode) {
            foreach ($keys as $key) {
                foreach ($input as $data) {
                    $params[] = array($key, $mode, $iv, $data);
                }
            }
        }
        return $params;
    }
}

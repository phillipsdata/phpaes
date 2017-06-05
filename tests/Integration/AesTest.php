<?php
namespace PhpAes\Aes\Tests\Integration;

use PhpAes\Aes;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \PhpAes\Aes
 */
class AesTest extends TestCase
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
     */
    public function testCipher($key, $mode, $iv, $input)
    {
        $aes = new Aes($key, $mode, $iv);

        $cipherText = $aes->encrypt($input);
        $this->assertNotEquals($cipherText, $input);

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

        $input = array(file_get_contents('./fixtures/example.txt'), 'hello world!', '');

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

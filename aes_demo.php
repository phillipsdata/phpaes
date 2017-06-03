<?php
error_reporting(-1);
require "./AES.class.php";


$iv = "1234567890abcdef"; // Initialization Vector (used in all modes except ECB

$keys = array(
    "abcdefgh01234567",
    "abcdefghijkl012345678901",
    "abcdefghijuklmno0123456789012345"
);
$modes = array("ECB", "CBC", "CFB", "OFB");
$input = array(file_get_contents("./example.txt"), "hello world!", "");

foreach ($modes as $mode) {
    foreach ($keys as $key) {
        foreach ($input as $data) {
            echo "TEST [$mode]: z=$key\n";
            $aes = new AES($key, $mode, $iv);

            $start = microtime(true);
            $cipherText = $aes->encrypt($data);
            $result = $aes->decrypt($cipherText);
            echo "\n\nPlain-Text:\n" . $result . "\n";
            echo "Cipher-Text (base64): "
                . chunk_split(base64_encode($cipherText)) . "\n";
            $end = microtime(true);

            echo "\n\nExecution time: " . ($end - $start) . "\n";

            if ($result !== $data) {
                fwrite(STDERR, "[ERROR] Unexpected output\n");
                exit(1);
            }
        }
    }
}

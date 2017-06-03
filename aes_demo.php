<?php

include("./AES.class.php");

$z = "abcdefgh01234567"; // 128-bit key
//$z = "abcdefghijkl012345678901"; // 192-bit key
//$z = "abcdefghijuklmno0123456789012345"; // 256-bit key

$iv = "1234567890abcdef"; // Initialization Vector (used in all modes except ECB

// Supported modes are Electronic Codebook (ECB), Cipher Block Chaining (CBC), Cipher Feeback (CFB), Output Feedback (OFB)
$aes = new AES($z, "OFB", $iv);

$data = file_get_contents("./example.txt");

$start = microtime(true);
//echo "\n\nCipher-Text:\n" . $aes->encrypt($data) . "\n";
$result = $aes->decrypt($aes->encrypt($data));
echo "\n\nPlain-Text:\n" . $result . "\n";
$end = microtime(true);

echo "\n\nExecution time: " . ($end - $start) . "\n";

if ($result === $data) {
    exit(0);
}

fwrite(STDERR, "[ERROR] Unexpected output\n");
exit(1);

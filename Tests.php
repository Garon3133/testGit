<?php




// Test Коммита, добавленный текст в локальном файле

//Тестовый текст
$key_pril = 'TestData';

//Конфиг генерации ключей
$config = array(
    "private_key_bits" => 2048,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
);

//Генерация связки ключей
$res = openssl_pkey_new($config);

//Получнгие приватного ключа из связки ключей
openssl_pkey_export($res, $privKey);

//Получение публичного ключа из связки ключей
$pubKey = openssl_pkey_get_details($res);
$pubKey = $pubKey["key"];
$savedPubKey = $pubKey;
$savedPubKey = str_replace("-----BEGIN PUBLIC KEY-----\n","",$savedPubKey);
$savedPubKey = str_replace("\n-----END PUBLIC KEY-----\n","",$savedPubKey);

print_r($savedPubKey);

//Вывод публичного и приватного ключей для копирования
//print_r($pubKey);
print_r($privKey);

//Вывод тестового текста перед шифровкой и дешифровкой
//print_r($key_pril);

//Шифрование текста(публичный ключ)
if(!openssl_public_encrypt($key_pril, $encrypted, $pubKey)) {
    echo "OshibkaEncoda" . "\n";
} else {
    //Дешифровка текста(приватный ключ)
    if(openssl_private_decrypt($encrypted, $decrypted, $privKey)) {
        print_r($decrypted);
    } else {
        echo "OshibkaDecoda" . "\n";
    }
}






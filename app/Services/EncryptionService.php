<?php
namespace App\Services;

use Illuminate\Support\Facades\Crypt;

class EncryptionService
{
    /**
     * Encrypt the given data with the user-specific API key.
     */
    public function encryptData($data, $apiKey)
    {
        $encryptionKey = $this->deriveKey($apiKey);
        return openssl_encrypt($data, 'AES-256-CBC', $encryptionKey, 0, substr($encryptionKey, 0, 16));
    }

    /**
     * Decrypt the given encrypted data with the user-specific API key.
     */
    public function decryptData($encryptedData, $apiKey)
    {
        $encryptionKey = $this->deriveKey($apiKey);
        return openssl_decrypt($encryptedData, 'AES-256-CBC', $encryptionKey, 0, substr($encryptionKey, 0, 16));
    }

    /**
     * Derive a key from the API key to use for encryption/decryption.
     */
    private function deriveKey($apiKey)
    {
        // You can use any derivation logic. For simplicity, using hash here.
        return hash('sha256', $apiKey, true);
    }
}

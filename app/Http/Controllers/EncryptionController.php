<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EncryptionService;
use Illuminate\Support\Facades\Auth;

class EncryptionController extends Controller
{
    protected $encryptionService;

    public function __construct(EncryptionService $encryptionService)
    {
        $this->encryptionService = $encryptionService;
    }

    /**
     * Encrypt the request data using the user's API key.
     */
    public function encrypt(Request $request)
    {
        $user = Auth::user();
        $data = $request->input('data');
        
        if (!$user || !$data) {
            return response()->json(['message' => 'Unauthorized or Invalid data'], 401);
        }

        $encryptedData = $this->encryptionService->encryptData($data, $user->api_key);
        
        return response()->json(['encrypted_data' => $encryptedData]);
    }

    /**
     * Decrypt the response data using the user's API key.
     */
    public function decrypt(Request $request)
    {
        $user = Auth::user();
        $encryptedData = $request->input('encrypted_data');

        if (!$user || !$encryptedData) {
            return response()->json(['message' => 'Unauthorized or Invalid data'], 401);
        }

        $decryptedData = $this->encryptionService->decryptData($encryptedData, $user->api_key);

        return response()->json(['decrypted_data' => $decryptedData]);
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Credentials extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login',
        'password',
        'clarification',
        'message_id'
    ];

    protected $table = 'credentials';

    /**
     * Create credentials
     * @param $input
     * @param $messageID
     * @return bool
     */
    public static function createCredentials($input, $messageID)
    {
        if (isset($input['credentials'])) {
            $credentials = new Credentials();
            foreach ($input['credentials'] as $credential) {
                $credentialArray = explode(',', $credential);
                Credentials::create([
                    'clarification' => $credentialArray[0],
                    'login' => Crypt::encryptString($credentialArray[1]),
                    'password' => Crypt::encryptString($credentialArray[2]),
                    'message_id' => $messageID
                ]);


            }

            unset($input['credentials']);
            $response = Http::accept('application/json')->post('https://reqres.in/api/users', $input);
            Log::info($response);

            return true;
        }

        return false;
    }
}

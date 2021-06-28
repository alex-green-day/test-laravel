<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketFormRequest;
use App\Jobs\SendCreateTicketEmail;
use App\Models\Credentials;
use App\Models\Messages;
use App\Models\Tickets;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    public function create(TicketFormRequest $request)
    {
        $token = $request->header('X-AUTH_TOKEN');
        if (isset($token)) {
            $user = User::getUserByToken($token);
            if (isset($user) && $request->validated()) {
                $input = $request->all();

                $ticketID = Tickets::createTicket($input);
                if ($ticketID) {
                    $messageID = Messages::createMessage($input, $ticketID);
                    if ($messageID) {
                        $credentials = Credentials::createCredentials($input, $messageID);

                        SendCreateTicketEmail::dispatch($input);

                        return response([
                            'status' => 'success',
                            'message' => 'Ticket has been successfully recorded'
                        ], 200);
                    }
                }
            }
        }

        return response([
            'status' => 'fail',
            'message' => 'Something goes wrong, check all request data and try one more'
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Helpers\SpellingHelper;
use App\Http\Requests\TicketFormRequest;
use App\Jobs\SendCreateTicketEmail;
use App\Models\Credentials;
use App\Models\Messages;
use App\Models\Tickets;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * @param TicketFormRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function saveTicket(TicketFormRequest $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, $request->rules(), $request->messages());

        if ($validator->fails()) {
            session()->flashInput($input);
            return view('home', [
                'type' => 'danger',
                'message' => 'Не удалось добавить тикет! Проверьте вводимые данные и повторите снова!',
                'errors' => $validator->errors()->getMessages()
            ]);
        } else {
            $ticketID = Tickets::createTicket($input);
            if ($ticketID) {
                $messageID = Messages::createMessage($input, $ticketID);
                if ($messageID) {
                    $credentials = Credentials::createCredentials($input, $messageID);

                    SendCreateTicketEmail::dispatch($input);

                    return view('home', [
                        'type' => 'success',
                        'message' => 'Тикет успешно добавлен!'
                    ]);
                }
            }
        }

        return view('home');
    }
}

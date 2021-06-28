<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid',
        'subject',
        'user_name',
        'user_email'
    ];

    protected $table = 'ticket';

    public static function createTicket(array $input)
    {
        $ticket = Tickets::create([
            'uid' => 'AW-0',
            'subject' => $input['subject'],
            'user_name' => $input['user_name'],
            'user_email' => $input['user_email']
        ]);

        if (isset($ticket->id)) {
            $ticket->uid = 'AW-'.$ticket->id;
            $ticket->save();
            return $ticket->id;
        }

        return false;
    }
}

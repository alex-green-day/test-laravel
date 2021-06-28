<?php

namespace App\Models;

use App\Helpers\SpellingHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;

    public const ClientAuthor = 'client';
    public const ManagerAuthor = 'manager';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author',
        'ticket_id',
        'content'
    ];

    protected $table = 'message';

    public static function createMessage($input, $ticketID)
    {
        $message = new Messages();
        $message->author = Messages::ManagerAuthor;
        $message->ticket_id = $ticketID;

        $speller = new SpellingHelper();
        $message->content = $speller->filterInvalidSymbols($input['content']);
        $message->content = $speller->filterOfRude($message->content);

        if ($message->save()) {
            return $message->id;
        }
    }
}

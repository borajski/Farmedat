<?php

namespace App\Models;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Message extends Model
{
  // use HasFactory;
  /**
     * @var string
     */
    protected $table = 'messages';

    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * @var Request

     */
    protected $request;

    /**
     * @var User
     */
    public $to;


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sender()
    {
        return $this->hasOne(User::class, 'id', 'from_user_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function recipient()
    {
        return $this->hasOne(User::class, 'id', 'to_user_id');
    }

    /**
     * @param Request $request
     *
     * @return $this
     */
    public function validateRequest(Request $request)
    {
        $request->validate([
            'recipient'       => 'required',
            'subject'         => 'required',
            'message_content' => 'required'
        ]);

        $this->setRequest($request);

        return $this;
    }


    /**
     * @return bool
     */
    public function storeData()
    {
        $stored = $this->insertGetId([
            'parent_id'      => $this->request->parent,
            'from_user_id'    => auth()->user()->id,
            'to_user_id'      => $this->request->recipient,
            'subject'         => $this->request->subject,
            'message_content' => $this->request->message_content,
            'created_at'      => Carbon::now(),
            'updated_at'      => Carbon::now()
        ]);

        if ($stored) {
            return $this->find($stored);
        }

        return false;
    }


    /**
     * @return bool
     */
     // ovu funkciju treba provjeriti
    public function storeVendorRequest()
    {
        $stored = $this->insertGetId([
            'from_user_id'    => auth()->user()->id,
            'to_user_id'      => 2,
            'subject'         => 'Želim postati prodavač..!',
            'message_content' => 'Poštovani, Želio bih postati prodavač na vašoj platformi...',
           'created_at'      => Carbon::now(),
            'updated_at'      => Carbon::now()
        ]);

        if ($stored) {
            return $this->find($stored);
        }

        return false;
    }


    /**
     * Set Model required data.
     */
    public function setData()
    {
        $this->to = User::find($this->request->recipient);
    }


    /**
     * Set Model request variable.
     *
     * @param $request
     */
    private function setRequest($request)
    {
        $this->request = $request;
        $this->setData();
    }

  // Static Methods
    //

    /**
     * @param $message
     *
     * @return mixed
     */
    public static function getRecipientUser($message)
    {
        $recipient_id = $message->from_user_id;

        if ($recipient_id == auth()->user()->id) {
            $recipient_id = $message->to_user_id;
        }

        return User::where('id', $recipient_id)->first();
    }

}

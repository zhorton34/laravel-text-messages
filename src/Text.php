<?php

namespace CleanCodeStudio\LaravelTextMessages;

use Illuminate\Database\Eloquent\Model;
use CleanCodeStudio\LaravelTextMessages\Mail\TextMessage;


class Text extends Model
{
    /**
     * @var string
     * Choose Gateway To Send Text Message Through
     * select sms or mms
     */
    protected $sendVia = 'sms';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function textable()
    {
        return $this->morphTo();
    }


    public function message($message)
    {
        if(is_string($message)) {
            return \Mail::to($this->textable_number)->send(new TextMessage($message));
        }
        else {
            return \Mail::to($this->textable_number);
        }
    }

    public function getNumberAttribute($number)
    {
        foreach(['(',')',' ','-','+','_'] as $remove)
        {
            $number = str_replace($remove, '', $number);
        }

        $number = (strlen($number) >= 11) ? substr($number, 1, 10) : $number;

        return $number;
    }


    protected function checkGateway()
    {
        $acceptableGateways = ['sms', 'mms'];

        if(!in_array($this->sendVia, $acceptableGateways))
            abort(500, "$this->sendVia is not an acceptable messaging gateway, must be either sms or mms gateway");

    }

    /**
     * @param $type
     * @return string
     */
    public function getTextableNumberAttribute()
    {
        $this->checkGateway();

        $gateway = config("gateway.$this->sendVia.$this->gateway");

        return $this->number . $gateway;
    }

}

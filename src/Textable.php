<?php

namespace CleanCodeStudio\LaravelTextMessages;

trait Textable
{
    /**
     * @return mixed
     */
    protected $canBeTextedThrough = [
        'gateway' => false, 'number' => false
    ];

    /**
     * @return mixed
     */
    public function texts()
    {
        return $this->morphMany(Text::class, 'textable');
    }

    /**
     * @param $gateway
     * @return $this
     */
    public function isTextableVia($gateway)
    {
        $this->canBeTextedThrough['gateway'] = $gateway;

        return $this;
    }

    /**
     * @param $number
     */
    public function at($number)
    {
        $this->canBeTextedThrough['number'] = $number;
        $textable = new Text;

        $textable->number = $this->canBeTextedThrough['number'];
        $textable->gateway = $this->canBeTextedThrough['gateway'];

        $this->texts()->save($textable);
    }


    /**
     * @return mixed
     */
    public function text()
    {
        return $this->texts()->first();
    }
}
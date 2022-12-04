<?php

namespace App\Listeners;
use App\Events\VideoViewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;


class IncreaseCounter
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(VideoViewer $event)
    {
        if(session() ->has('vedioVisited'))
        $this->updateViewr($event ->video);
    }

    function updateViewr($vedio){
        $vedio ->viewers =  $vedio ->viewers +1 ;
        $vedio ->save();
        session()->put('vedioVisited' , $vedio->id);
    }
}

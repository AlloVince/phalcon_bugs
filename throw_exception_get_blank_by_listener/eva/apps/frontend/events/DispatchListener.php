<?php

namespace Eva\Frontend\Events;

class DispatchListener
{
    public function beforeException($event, $dispatcher, $exception)
    {
            var_dump($exception);
    
    }
    public function beforeExecuteRoute($event)
    {
        $dispatcher = $event->getSource();
        throw new \Exception('foo');
    }
}

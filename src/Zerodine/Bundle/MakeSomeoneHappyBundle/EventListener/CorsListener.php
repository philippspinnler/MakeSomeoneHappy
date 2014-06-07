<?php

namespace Zerodine\Bundle\MakeSomeoneHappyBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class CorsListener
{
    public function onKernelResponse(FilterResponseEvent $event)
    {
        // $request = $event->getRequest();

        $event->getResponse()->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept, Authorization');
        $event->getResponse()->headers->set('Access-Control-Allow-Origin', '*');
        $event->getResponse()->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, OPTIONS');
        // $event->getResponse()->headers->set('Allow', 'POST, GET, PUT, DELETE, OPTIONS');
    }
}
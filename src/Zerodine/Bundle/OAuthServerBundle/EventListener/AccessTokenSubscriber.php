<?php

namespace Zerodine\Bundle\OAuthServerBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Zerodine\Bundle\OAuthServerBundle\Entity\AccessToken;

class AccessTokenSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return array(
            'postPersist',
        );
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $accessToken = $args->getObject();

        if ($accessToken instanceof AccessToken) {

            $postBody = array(
                'token' => $accessToken->getToken(),
                'expiresAt' => $accessToken->getExpiresAt(),
                'client' => $accessToken->getClient()->getRedirectUris(),
                'user' => $accessToken->getUser()->getUsername(),
                'scope' => $accessToken->getScope()
            );

            $postBody = json_encode($postBody);

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL,            "http://localhost:9999/api/accesstoken" );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt($ch, CURLOPT_POST,           1 );
            curl_setopt($ch, CURLOPT_POSTFIELDS,     $postBody );
            curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: application/json'));

            $response = curl_exec($ch);

            $data = json_decode($response);
        }
    }

}
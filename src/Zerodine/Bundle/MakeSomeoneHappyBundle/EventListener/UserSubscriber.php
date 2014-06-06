<?php

namespace Zerodine\Bundle\MakeSomeoneHappyBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Zerodine\Bundle\MakeSomeoneHappyBundle\Entity\User;

class UserSubscriber implements EventSubscriber
{
    protected $encoder;

    public function setEncoderFactory($encoder) {
        $this->encoder = $encoder;
    }

    public function getSubscribedEvents()
    {
        return array(
            'prePersist',
        );
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $user = $args->getObject();

        if ($user instanceof User) {

            // Create the keypair
            $res=openssl_pkey_new();

            // Get private key
            openssl_pkey_export($res, $privkey, $user->getPlainPassword());

            // Get public key
            $pubkey=openssl_pkey_get_details($res);
            $pubkey=$pubkey["key"];

            $user->setKeyPrivate($privkey);
            $user->setKeyPublic($pubkey);

            $encoder = $this->encoder->getEncoder($user);
            $user->setPassword($encoder->encodePassword($user->getPlainPassword(), $user->getSalt()));
            $user->eraseCredentials();
        }
    }

}
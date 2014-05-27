<?php

namespace Zerodine\Bundle\MakeSomeoneHappyBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Zerodine\Bundle\MakeSomeoneHappyBundle\Entity\Person;

class PersonSubscriber implements EventSubscriber
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
        $person = $args->getObject();

        if ($person instanceof Person) {

            // Create the keypair
            $res=openssl_pkey_new();

            // Get private key
            openssl_pkey_export($res, $privkey, $person->getPlainPassword());

            // Get public key
            $pubkey=openssl_pkey_get_details($res);
            $pubkey=$pubkey["key"];

            $person->setKeyPrivate($privkey);
            $person->setKeyPublic($pubkey);

            $encoder = $this->encoder->getEncoder($person);
            $person->setPassword($encoder->encodePassword($person->getPlainPassword(), $person->getSalt()));
            $person->eraseCredentials();
        }
    }

}
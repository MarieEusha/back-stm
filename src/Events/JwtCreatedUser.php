<?php

namespace App\Events;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JwtCreatedUser
{
    public function updateJwtData(JWTCreatedEvent $event)
    {
        //récupération du user
        $user = $event->getUser();
        //enrichir les data (payload) pour qu'elles contiennent ces données
        $data = $event->getData();
        //dd($user->getClub()->getId());
        $data['firstName'] = $user->getFirstName();
        $data['lastName'] = $user->getLastName();
        $data['id'] = $user->getId();
        if (!empty($user->getClub())){
            $data['club'] = $user->getClub()->getId();
        }else{
            $data['club'] = null;
        }

        $event->setData($data);
    }
}

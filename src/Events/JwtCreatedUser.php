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
        $data['firstName'] = $user->getFirstName();
        $data['lastName'] = $user->getLastName();
        $data['id'] = $user->getId();
        if($data['roles'][0] === 'ROLE_PLAYER') {
            $data['player'] = $user->getPlayers()[0]->getId();
            $teams = $user->getPlayers()[0]->getTeam();
            if($teams != null){
                $data['team'] = $teams->getId();
            }
            else {
                $data['team'] = null;
            }
        }
        else if($data['roles'][0] === 'ROLE_COACH') {
            $coach = $user->getCoaches()[0];
            $data['coach'] = $coach->getId();
            foreach($coach->getTeams() as $team){
                $data['teams'][] = $team->getId();
            }

        }
        if (!empty($user->getClub())){
            $data['club'] = $user->getClub()->getId();
        }else{
            $data['club'] = null;
        }

        $event->setData($data);
    }
}

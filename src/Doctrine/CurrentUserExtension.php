<?php

namespace App\Doctrine;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use Doctrine\ORM\QueryBuilder;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Symfony\Component\Security\Core\Security;
use App\Entity\Player;
use App\Entity\Stats;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class CurrentUserExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{

    private $security;
    private $auth;

    public function __construct(Security $security, AuthorizationCheckerInterface $checker)
    {
        $this->security = $security;
        $this->auth = $checker;
    }

    private function addWhere(QueryBuilder $queryBuilder, string $resourceClass)
    {

        //Obtenir le user connecté
        $user = $this->security->getUser();
        //Si on demande des stats ou des players/coaches alors agir sur la requête pour qu'elle tienne compte de l'utilisateur connecté
        if (($resourceClass === Player::class || $resourceClass === Stats::class) && (!$this->auth->isGranted('ROLE_COACH') && !$this->auth->isGranted('ROLE_ADMIN'))) {
            $rootAlias = $queryBuilder->getRootAliases()[0];

            if ($resourceClass === Player::class) {
                $queryBuilder->andWhere("$rootAlias.user = :user");
            } elseif ($resourceClass === Stats::class) {
                $queryBuilder->join("$rootAlias.player", "p")
                    ->andWhere("p.user = :user");
            }

            $queryBuilder->setParameter("user", $user);
        }
    }
    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, ?string $operationName = null)
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }


    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, ?string $operationName = null, array $context = [])
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }
}

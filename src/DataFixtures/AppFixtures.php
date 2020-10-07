<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Club;
use App\Entity\Coach;
use App\Entity\Coaching;
use App\Entity\Encounter;
use App\Entity\Player;
use App\Entity\Stats;
use App\Entity\Tactic;
use App\Entity\Team;
use App\Entity\Training;
use App\Entity\TrainingMissed;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker\Factory;


class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * AppFixtures constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder ){
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {
        $this->purgeImg('public/storage/images');
        $faker = Factory::create('fr_FR');
        // $product = new Product();
        // $manager->persist($product);


        for ($c = 1; $c <= 3; $c++) {
            // je crée 1 club
            $club = new Club();
            $club->setLabel($faker->city);
            $manager->persist($club);

            /**
             * je crée 50 users (1 admin, 4 coachs, 45 players) et 3 teams
             */
            //création de l'admin
            $user = new User();
            //je crée un password haché (que j'utiliserai pour tous le monde)
            $hash = $this->encoder->encodePassword($user, 'password');

            $user->setClub($club);
            $user->setEmail($faker->email);
            $user->setRoles(["ROLE_ADMIN"]);
            $user->setPassword($hash);
            $user->setLastName($faker->lastName);
            $user->setFirstName($faker->firstName);
            $user->setBirthday($faker->dateTimeBetween('-55 years', '-45 years'));
            $user->setPhone('0633221516');

            $manager->persist($user);

            $admin = new Admin();
            $admin->setUser($user);
            $manager->persist($admin);


            //création des 4 coachs
            $coachs = array();  //je stock dans un tableau chaque coach qui sera créé
            for ($i = 1; $i <= 5; $i++) {
                $user = new User();
                $user->setClub($club);
                $user->setEmail($faker->email);
                $user->setRoles(["ROLE_COACH"]);
                $user->setPassword($hash);
                $user->setLastName($faker->lastName);
                $user->setFirstName($faker->firstName);
                $user->setBirthday($faker->dateTimeBetween('-45 years', '-30 years'));
                $user->setPhone('0633221516');
                $coach = new Coach();
                $coach->setUser($user);
                $manager->persist($coach);
                $coachs[] = $coach;
            }

            //je crée les 5 teams et assignation des coachs
            $team1 = new Team();
            $team1->setLabel('Equipe A');
            $team1->setCategory('Senior');
            $team1->setCoach($coachs[0]);
            $team1->setClub($club);
            $manager->persist($team1);

            $team2 = new Team();
            $team2->setLabel('Equipe A');
            $team2->setCategory('Junior');
            $team2->setCoach($coachs[1]);
            $team2->setClub($club);
            $manager->persist($team2);

            $team3 = new Team();
            $team3->setLabel('Equipe B');
            $team3->setCategory('Junior');
            $team3->setCoach($coachs[2]);
            $team3->setClub($club);
            $manager->persist($team3);

            $team4 = new Team();
            $team4->setLabel('Equipe A');
            $team4->setCategory('Cadet');
            $team4->setCoach($coachs[3]);
            $team4->setClub($club);
            $manager->persist($team4);

            $team5 = new Team();
            $team5->setLabel('Equipe B');
            $team5->setCategory('Cadet');
            $team5->setCoach($coachs[4]);
            $team5->setClub($club);
            $manager->persist($team5);


            /**
             * création des 80 players
             */
            // création des 16 premier players Senior assigné en team1
            $playerTeam1 = array();
            for ($i = 1; $i <= 16; $i++) {
                $user = new User();
                $user->setClub($club);
                $user->setEmail($faker->email);
                $user->setRoles(["ROLE_PLAYER"]);
                $user->setPassword($hash);
                $user->setLastName($faker->lastName);
                $user->setFirstName($faker->firstName);
                $user->setBirthday($faker->dateTimeBetween('-34 years', '-20 years'));
                $user->setPhone('0633221516');
                $manager->persist($user);
                $player = new Player();
                $player->setUser($user);
                $player->setTeam($team1);
                $player->setPicture($faker->image('public/storage/images', 380, 380, null, false));
                $player->setHeight($faker->numberBetween(155, 200));
                $player->setWeight($faker->numberBetween(60, 100));
                $player->setInjured(false);
                $manager->persist($player);

                $playerTeam1[] = $player;
            }
            // création des 15 players junior  assigné en team2
            $playerTeam2 = array();
            for ($i = 1; $i <= 15; $i++) {
                $user = new User();
                $user->setClub($club);
                $user->setEmail($faker->email);
                $user->setRoles(["ROLE_PLAYER"]);
                $user->setPassword($hash);
                $user->setLastName($faker->lastName);
                $user->setFirstName($faker->firstName);
                $user->setBirthday($faker->dateTimeBetween('-19 years', '-17 years'));
                $user->setPhone('0633221516');
                $manager->persist($user);
                $player = new Player();
                $player->setUser($user);
                $player->setTeam($team2);
                $player->setPicture($faker->image('public/storage/images', 380, 380, null, false));
                $player->setHeight($faker->numberBetween(155, 200));
                $player->setWeight($faker->numberBetween(60, 100));
                $player->setInjured(false);
                $manager->persist($player);

                $playerTeam2[] = $player;
            }
            // création des 15 players junior  assigné en team3
            $playerTeam3 = array();
            for ($i = 1; $i <= 15; $i++) {
                $user = new User();
                $user->setClub($club);
                $user->setEmail($faker->email);
                $user->setRoles(["ROLE_PLAYER"]);
                $user->setPassword($hash);
                $user->setLastName($faker->lastName);
                $user->setFirstName($faker->firstName);
                $user->setBirthday($faker->dateTimeBetween('-19 years', '-17 years'));
                $user->setPhone('0633221516');
                $manager->persist($user);
                $player = new Player();
                $player->setUser($user);
                $player->setTeam($team3);
                $player->setPicture($faker->image('public/storage/images', 380, 380, null, false));
                $player->setHeight($faker->numberBetween(155, 200));
                $player->setWeight($faker->numberBetween(60, 100));
                $player->setInjured(false);
                $manager->persist($player);

                $playerTeam3[] = $player;
            }
            // création des 17 players cadet  assigné en team4
            $playerTeam4 = array();
            for ($i = 1; $i <= 17; $i++) {
                $user = new User();
                $user->setClub($club);
                $user->setEmail($faker->email);
                $user->setRoles(["ROLE_PLAYER"]);
                $user->setPassword($hash);
                $user->setLastName($faker->lastName);
                $user->setFirstName($faker->firstName);
                $user->setBirthday($faker->dateTimeBetween('-16 years', '-15 years'));
                $user->setPhone('0633221516');
                $manager->persist($user);
                $player = new Player();
                $player->setUser($user);
                $player->setTeam($team4);
                $player->setPicture($faker->image('public/storage/images', 380, 380, null, false));
                $player->setHeight($faker->numberBetween(155, 200));
                $player->setWeight($faker->numberBetween(60, 100));
                $player->setInjured(false);
                $manager->persist($player);

                $playerTeam4[] = $player;
            }
            // création des 15 players cadet  assigné en team5
            $playerTeam5 = array();
            for ($i = 1; $i <= 17; $i++) {
                $user = new User();
                $user->setClub($club);
                $user->setEmail($faker->email);
                $user->setRoles(["ROLE_PLAYER"]);
                $user->setPassword($hash);
                $user->setLastName($faker->lastName);
                $user->setFirstName($faker->firstName);
                $user->setBirthday($faker->dateTimeBetween('-16 years', '-15 years'));
                $user->setPhone('0633221516');
                $manager->persist($user);
                $player = new Player();
                $player->setUser($user);
                $player->setTeam($team5);
                $player->setPicture($faker->image('public/storage/images', 380, 380, null, false));
                $player->setHeight($faker->numberBetween(155, 200));
                $player->setWeight($faker->numberBetween(60, 100));
                $player->setInjured(false);
                $manager->persist($player);

                $playerTeam5[] = $player;
            }

            /**
             * //donc ici j'ai un club qui comporte 1 admin, 5 coachs, 80 players répartis dans 5 teams
             */

            //création de 10 training associé a chaque equipe
            $trainings = array();
            for ($k = 1; $k <= 5; $k++) {
                if ($k == 1){
                    $team = $team1;
                    $playerTeam = $playerTeam1;
                }else if ($k == 2){
                    $team = $team2;
                    $playerTeam = $playerTeam2;
                }else if ($k == 3){
                    $team = $team3;
                    $playerTeam = $playerTeam3;
                }else if ($k == 4){
                    $team = $team4;
                    $playerTeam = $playerTeam4;
                }else if ($k == 5){
                    $team = $team5;
                    $playerTeam = $playerTeam5;
                }

                for ($i = 1; $i <= 10; $i++) {

                    $training = new Training();
                    $training->setTeam($team);
                    $training->setLabel('Entrainement ' . $i);
                    $training->setDescription($faker->paragraph(5, true));
                    $training->setDate($faker->dateTimeBetween('+1 week', '+6 month'));
                    $trainings[] = $training;
                    $manager->persist($training);

                    $arrPlayersTeam = $playerTeam;
                    //pour chaque training je crée un liste de 3 absents
                    for ($j = 1; $j <= 4; $j++) {
                        $trainingMissed = new TrainingMissed();
                        $trainingMissed->setTraining($training);

                        $randomPlayer = $faker->randomElement($arrPlayersTeam);
                        $keyRandomPlayer = array_search($randomPlayer, $arrPlayersTeam);
                        array_splice($arrPlayersTeam, $keyRandomPlayer, 1);

                        $trainingMissed->setPlayer($randomPlayer);
                        $manager->persist($trainingMissed);
                    }

                }
            }


            //création de tactics
            $type1 = '4-4-2';
            $type2 = '5-3-2';
            $type3 = '3-5-2';

            for ($k = 1; $k <= 5; $k++) {
                if ($k == 1) {
                    $team = $team1;
                    $playerTeam = $playerTeam1;
                } else if ($k == 2) {
                    $team = $team2;
                    $playerTeam = $playerTeam2;
                } else if ($k == 3) {
                    $team = $team3;
                    $playerTeam = $playerTeam3;
                } else if ($k == 4) {
                    $team = $team4;
                    $playerTeam = $playerTeam4;
                } else if ($k == 5) {
                    $team = $team5;
                    $playerTeam = $playerTeam5;
                }

                $selectedPlayer = array();
                $tactics = array();
                for ($t = 1; $t <= 3; $t++) {
                    if ($t == 1){
                        $type = $type1;
                    }elseif ($t == 2){
                        $type = $type2;
                    }elseif ($t == 3){
                        $type = $type3;
                    }

                    $arrPlayersTeam = $playerTeam;

                    $tactic = new Tactic();
                    $tactic->setTeam($team);
                    $tactic->setType($type);

                    //purge de list joueur selectionnés
                    $selectedPlayer = array();

                    $randomPlayer = $faker->randomElement($arrPlayersTeam);
                    $keyRandomPlayer = array_search($randomPlayer, $arrPlayersTeam);
                    array_splice($arrPlayersTeam, $keyRandomPlayer, 1);

                    //ajout stats
                    $tactic->setPos1($randomPlayer);
                    $selectedPlayer[] = $randomPlayer;

                    $randomPlayer = $faker->randomElement($arrPlayersTeam);
                    $keyRandomPlayer = array_search($randomPlayer, $arrPlayersTeam);
                    array_splice($arrPlayersTeam, $keyRandomPlayer, 1);
                    //ajout stats
                    $tactic->setPos2($randomPlayer);
                    $selectedPlayer[] = $randomPlayer;

                    $randomPlayer = $faker->randomElement($arrPlayersTeam);
                    $keyRandomPlayer = array_search($randomPlayer, $arrPlayersTeam);
                    array_splice($arrPlayersTeam, $keyRandomPlayer, 1);
                    //ajout stats
                    $tactic->setPos3($randomPlayer);
                    $selectedPlayer[] = $randomPlayer;

                    $randomPlayer = $faker->randomElement($arrPlayersTeam);
                    $keyRandomPlayer = array_search($randomPlayer, $arrPlayersTeam);
                    array_splice($arrPlayersTeam, $keyRandomPlayer, 1);
                    //ajout stats
                    $tactic->setPos4($randomPlayer);
                    $selectedPlayer[] = $randomPlayer;

                    $randomPlayer = $faker->randomElement($arrPlayersTeam);
                    $keyRandomPlayer = array_search($randomPlayer, $arrPlayersTeam);
                    array_splice($arrPlayersTeam, $keyRandomPlayer, 1);
                    //ajout stats
                    $tactic->setPos5($randomPlayer);
                    $selectedPlayer[] = $randomPlayer;

                    $randomPlayer = $faker->randomElement($arrPlayersTeam);
                    $keyRandomPlayer = array_search($randomPlayer, $arrPlayersTeam);
                    array_splice($arrPlayersTeam, $keyRandomPlayer, 1);
                    //ajout stats
                    $tactic->setPos6($randomPlayer);
                    $selectedPlayer[] = $randomPlayer;

                    $randomPlayer = $faker->randomElement($arrPlayersTeam);
                    $keyRandomPlayer = array_search($randomPlayer, $arrPlayersTeam);
                    array_splice($arrPlayersTeam, $keyRandomPlayer, 1);
                    //ajout stats
                    $tactic->setPos7($randomPlayer);
                    $selectedPlayer[] = $randomPlayer;

                    $randomPlayer = $faker->randomElement($arrPlayersTeam);
                    $keyRandomPlayer = array_search($randomPlayer, $arrPlayersTeam);
                    array_splice($arrPlayersTeam, $keyRandomPlayer, 1);
                    //ajout stats
                    $tactic->setPos8($randomPlayer);
                    $selectedPlayer[] = $randomPlayer;

                    $randomPlayer = $faker->randomElement($arrPlayersTeam);
                    $keyRandomPlayer = array_search($randomPlayer, $arrPlayersTeam);
                    array_splice($arrPlayersTeam, $keyRandomPlayer, 1);
                    //ajout stats
                    $tactic->setPos9($randomPlayer);
                    $selectedPlayer[] = $randomPlayer;

                    $randomPlayer = $faker->randomElement($arrPlayersTeam);
                    $keyRandomPlayer = array_search($randomPlayer, $arrPlayersTeam);
                    array_splice($arrPlayersTeam, $keyRandomPlayer, 1);
                    //ajout stats
                    $tactic->setPos10($randomPlayer);
                    $selectedPlayer[] = $randomPlayer;

                    $randomPlayer = $faker->randomElement($arrPlayersTeam);
                    $keyRandomPlayer = array_search($randomPlayer, $arrPlayersTeam);
                    array_splice($arrPlayersTeam, $keyRandomPlayer, 1);
                    //ajout stats
                    $tactic->setPos11($randomPlayer);
                    $selectedPlayer[] = $randomPlayer;

                    $manager->persist($tactic);
                    $tactics[] = $tactic;
                }

                $labelOpposingTeam = array('A', 'B');
                $matchs =array();
                for ($m = 1; $m <= 3; $m++){
                    $match = new Encounter();
                    $match->setTeam($team);
                    $match->setLabelOpposingTeam('Equipe ' . $faker->randomElement($labelOpposingTeam));
                    if ($k == 1){
                        $match->setCategoryOpposingteam('Senior');
                    }elseif ($k == 2 || $k == 3){
                        $match->setCategoryOpposingteam('Junior');
                    }elseif ($k == 4 || $k == 5){
                        $match->setCategoryOpposingteam('Cadet');
                    }
                    $match->setDate($faker->dateTimeBetween('+1 week', '+6 month'));
                    $match->setTactic($faker->randomElement($tactics));

                    $manager->persist($match);

                    $tabStats = array();
                    foreach($selectedPlayer as $player){

                        $tabStat[] = $this->stating($player, $match);
                       /* $stats->setEncounter($match);
                        $manager->persist($stats);*/
                    }

                    foreach($tabStat as $stats){
                        $manager->persist($stats);
                    }

                    $matchs[] = $match;
                }

            }



        }

        $manager->flush();
    }

    public function purgeImg($dir){

        $filesystem = new Filesystem();
        $filesystem->remove($dir);
        $filesystem->mkdir($dir,0777);
    }

    public function stating($player, $match)
    {
        $stats = new Stats();
        $stats = $this->isIt($stats, "redCard", 1);
        $stats = $this->isIt($stats, "yellowCard", 2);
        $stats = $this->isIt($stats, "passAssist", 5);
        $stats = $this->isIt($stats, "goal", 5);
        $stats->setEncounter($match);
        $stats->setPlayer($player);
        return $stats;
    }

    public function isIt($stats, $statLabel, $limit){
        $isIt = rand(0,1);
        $method = "set".ucfirst(($statLabel));
        if($isIt == 1){
            $stats->$method(rand(0,$limit));
        }
        else {
            $stats->$method(0);
        }
        return $stats;
    }
}

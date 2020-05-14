<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Team;
use App\Entity\Competitor;
use App\Entity\Time;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);


        for ($v=0; $v < 3; $v++) { 
            $team = new Team();
            $team->setTeamName("Team ".$v)
            ->setCity("city ".$v);
            // ->addCompetitor($competitor);

            $manager->persist($team);

            for ($i=0; $i < 4; $i++) { 
                $number = $i*($v+1);
                $competitor = new Competitor();
                $competitor->setFirstName("Prénom ".$number)
                ->setLastName("Nom ".$number)
                ->setBirthYear(1986)
                ->setSexe("F")
                ->setStatus("Police Municipale")
                ->AddTeam($team);
    
                $manager->persist($competitor);

                for ($f=0; $f < 3; $f++) { 
                    $number = $f*($i+1);
                    $time = new Time();
                    $time->setAttemp1(15500)
                    ->setAttemp2(12500)
                    ->setJerseyNumber($number);

                    $manager->persist($time);
                }
            }
        }

        $manager->flush();
    }
}

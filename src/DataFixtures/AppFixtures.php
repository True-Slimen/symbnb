<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use Faker\Factory;
use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr-FR');

        for ($i = 1; $i <= 30; $i++) {
            $ad = new Ad();

            $title = $faker->sentence();
            $introduction = $faker->paragraph(2);
            $content = '<p>'. join('<p></p>', $faker->paragraphs(5)). '<p>';


            $ad->setTitle($title)
                ->setCoverImage('http://placehold.it/1000x350')
                ->setIntroduction($introduction)
                ->setContent($content)
                ->setPrice(mt_rand(40, 200))
                ->setRooms(mt_rand(1, 6));

            for ($j = 1; $j <= mt_rand(2, 5); $j++) {
                $image = new Image();

                $image->setUrl("http://placehold.it/1000x350")
                      ->setCaption($faker->sentence())
                      ->setAd($ad);

                $manager->persist($image);
            }   

                $manager->persist($ad);
        }
        $manager->flush();
    }
}

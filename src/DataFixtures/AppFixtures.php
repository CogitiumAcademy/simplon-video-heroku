<?php

namespace App\DataFixtures;

use App\Entity\Video;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($i = 0; $i < 20; $i++) {
            $video = new Video();
            $video->setName('Vidéo ' . $i);
            $video->setSlug('slug-video-' . $i);
            $video->setImage('https://www.2le.net/wp-inside/uploads/2019/12/symfony-5-nouveautes.jpg');
            $video->setUrl('https://www.youtube.com/watch?v=DM0kqsDH4qA');
            $manager->persist($video);
        }

        $manager->flush();
    }
}

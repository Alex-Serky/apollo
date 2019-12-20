<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Author;
use App\Entity\Pdf;
use App\Entity\Video;

class InheritanceEntitiesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 2; $i++) {
            $author = new Author;
            $author->setName('Nom de l\'auteur' . $i);
            $manager->persist($author);

            for ($j = 1; $j <= 3; $j++) {
                $pdf = new Pdf;
                $pdf->setFilename('pdf nom de l\'utilisateur' . $i);
                $pdf->setDescription('pdf description de l\'utilisateur');
                $pdf->setSize(5454);
                $pdf->setOrientation('portrait');
                $pdf->setPagesNumber(123);
                $pdf->setAuthor($author);
                $manager->persist($pdf);
            }
            for ($k = 1; $k <= 2; $k++) {
                $video = new Video;
                $video->setFilename('video nom de l\'utilisateur' . $i);
                $video->setDescription('video description de l\'utilisateir');
                $video->setSize(321);
                $video->setFormat('mpeg-2');
                $video->setDuration(123);
                $video->setAuthor($author);
                $manager->persist($pdf);
            }
        }

        $manager->flush();
    }
}
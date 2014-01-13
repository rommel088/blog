<?php

namespace Blog\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Blog\BlogBundle\Entity\Articles;

class LoadArticlesData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        for($i=0; $i<20; $i++){
            $article = new Articles();
            $article->setTitle("Article Title " . $i);
            $article->setImage($i % 10 . ".jpg");
            $article->setBody("A hundred years ago people believed that plants and animals had always been as they are now. They thought that all the different sorts of living things, including men and women, were put in this world by some mysterious power a few thousand years ago.
                                It was Charles Darwin, born at Shrewsbury on the 12th of February, 1809, who showed that this was just a legend. As a boy Darwin loved to walk in the countryside, collecting insects, flowers and minerals. He liked to watch his elder brother making chemical experiments. These hobbies interested him imuch more than Greek and Latin, which were his main subjects at school.
                                His father, a doctor, sent Charles to Edinburgh University to study medicine. But Charles did not like this. He spent a lot of time with a zoologist friend, watching birds and other animals, and collecting insects in the countryside.
                                Then his father sent him to Cambridge to be trained as a parson. But Darwin didn't want to be a doctor or a parson. He wanted to be a biologist.
                                In 1831 he set sail in the Beagle for South America to make maps of the coastline there. Darwin went in the ship to see the animals and plants of other lands. On his voyage round the world he looked carefully at thousands of living things in the sea and on land and came to very important conclusions.
                                This is what he came to believe. Once there were only simple jelly-like creatures living in the sea. Very slowly, taking hundreds millions of years, these have developed to produce all the different kinds of animals and plants we know today. But Darwin waited over twenty years before he let the world know his great ideas. During that time he was carefully collecting more information. It showed how right he was that all living things had developed from simpler creatures.
                                He wrote a famous book 'The Origin of Species'.
                                People who knew nothing about living things tried to make fun of Darwin's ideas.
                                The development of science has shown that Darwin's idea of evolution was correct.");
            $article->setViewed(rand(5, 20));
            $article->addTag($this->getReference('tag'.rand(0, 4)));
//            if (rand(0, 1)) $article->addTag($this->getReference('tag'.rand(0, 4)));
            $manager->persist($article);
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 6;
    }
}
<?php
namespace SlashStudio\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SlashStudio\AppBundle\Entity\Product;

class LoadProductsData implements FixtureInterface
{
    private $names = [
        'Кепка' => 'Такая кепка спасет от солнца',
        'Бита' => 'Поможет разобраться с негодяями или получить зачет.',
        'Шарик' => 'Лучший в мире шарик aka мячик развлечет на длинных школьных переменках.',
        'Каска' => 'Тут все ясно. Никакой хулиган вам больше не страшен!',
        'Перчатки' => 'Помогут выполнить грязную работу и завести телочек.',
        'Стакан' => 'дерьмо.',
    ];

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->names as $name => $description) {
            $position = (new Product())
                ->setName($name)
                ->setDescription($description)
                ->setPrice(rand(50, 500));
            $manager->persist($position);
        }
        $manager->flush();
    }
}

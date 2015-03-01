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

    private $enNames = [
        'Кепка' => 'Cap',
        'Бита' => 'Bit',
        'Шарик' => 'Ball',
        'Каска' => 'Helmet',
        'Перчатки' => 'Gloves',
        'Стакан' => 'Glass',
    ];

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->names as $name => $description) {
            $product = new Product();
            $product->setPrice(rand(50, 500))
                ->setShowOnTheMain(rand(0, count($this->names) - 1) % 2 == 0)
            ;
            $product->translate('ru')->setName($name);
            $product->translate('ru')->setDescription($description);
            $product->translate('ru')->setRawDescription($description);
            $product->translate('ru')->setDescriptionFormatter('richhtml');

            $product->translate('en')->setName($this->enNames[$name]);
            $product->translate('en')->setDescription('Lorem ipsum dolor sit amet');
            $product->translate('en')->setRawDescription('Lorem ipsum dolor sit amet');
            $product->translate('en')->setDescriptionFormatter('richhtml');

            $product->mergeNewTranslations();

            $manager->persist($product);
        }
        $manager->flush();
    }
}

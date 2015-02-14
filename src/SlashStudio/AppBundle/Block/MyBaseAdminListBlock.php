<?php
namespace SlashStudio\AppBundle\Block;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

use Sonata\AdminBundle\Admin\Pool;
use Sonata\AdminBundle\Block\AdminListBlockService;

class MyBaseAdminListBlock extends AdminListBlockService
{
    protected $manager;
    protected $admins;
    protected $codes;

    public function __construct($name, EngineInterface $templating, Pool $pool, EntityManager $manager)
    {
        parent::__construct($name, $templating, $pool);
        $this->manager = $manager;
    }

    protected function getAdmins($groupName, $admins, $codes)
    {
        $dashboardGroups = $this->pool->getDashboardGroups();

        $result = [];
        foreach ($admins as $a) {
            $result[$a] = null;
        }

        if (!empty($dashboardGroups[$groupName])) {
            foreach ($dashboardGroups[$groupName]['items'] as $item) {
                foreach ($codes as $c => $admin) {
                    if ($item->getCode() == $c) {
                        $result[$admin] = $item;
                    }
                }
            }
        }

        return $result;
    }
}

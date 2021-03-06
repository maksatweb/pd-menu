<?php

/**
 * This file is part of the pdAdmin pd-menu package.
 *
 * @package     pd-menu
 *
 * @author      Ramazan APAYDIN <iletisim@ramazanapaydin.com>
 * @copyright   Copyright (c) 2018 Ramazan APAYDIN
 * @license     LICENSE
 *
 * @link        https://github.com/rmznpydn/pd-menu
 */

namespace Pd\MenuBundle\Builder;

use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class ItemProcess implements ItemProcessInterface
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $security;

    /**
     * @var string
     */
    private $currentUri;

    /**
     * ItemProcess constructor.
     *
     * @param RouterInterface               $router
     * @param AuthorizationCheckerInterface $security
     */
    public function __construct(RouterInterface $router, AuthorizationCheckerInterface $security)
    {
        $this->router = $router;
        $this->security = $security;
    }

    /**
     * Menu Processor.
     *
     * @param ItemInterface $menu
     * @param array         $options
     *
     * @return ItemInterface
     */
    public function processMenu(ItemInterface $menu, array $options = []): ItemInterface
    {
        // Set Current URI
        $this->currentUri = $this->router->getContext()->getPathInfo();

        // Process Menu
        $this->recursiveProcess($menu, $options);

        return $menu;
    }

    private function recursiveProcess(ItemInterface $menu, $options)
    {
        // Get Child Menus
        $childs = $menu->getChild();

        // Sort Menus
        ksort($childs);

        // Sort Current Child
        foreach ($childs as $child) {
            // Generate Route Link
            if ($child->getRoute()) {
                $child->setLink($this->router->generate($child->getRoute()['name'], $child->getRoute()['params']));

                // Link Active Class
                if ($this->currentUri === $child->getLink()) {
                    $child->setListAttr(array_merge_recursive($child->getListAttr(), ['class' => $options['currentClass']]));
                }
            }

            // Item Security
            if ($child->getRoles()) {
                if (!$this->security->isGranted($child->getRoles())) {
                    unset($childs[$child->getId()]);
                }
            }

            // Set Child Process
            if ($child->getChild()) {
                // Set Menu Depth
                if (null !== $options['depth'] && ($child->getLevel() >= $options['depth'])) {
                    $child->setChild([]);
                    break;
                }

                // Set Child List Class
                $child->setChildAttr(array_merge_recursive($child->getChildAttr(), ['class' => 'menu_level_'.$child->getLevel()]));

                $this->recursiveProcess($child, $options);
            }
        }

        // Set Childs
        $menu->setChild($childs);
    }
}

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

interface ItemInterface
{
    /**
     * Get Item Array ID | Order ID.
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set Item Array ID | Order ID.
     *
     * @param int|null $id
     *
     * @return ItemInterface
     */
    public function setId($id = null);

    /**
     * Get Item Name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Set Item Name.
     *
     * @param string $name
     *
     * @return ItemInterface
     */
    public function setName(string $name);

    /**
     * Get Menu Name.
     *
     * @return string
     */
    public function getLabel(): string;

    /**
     * Change Name Menu Item.
     *
     * @param string $label
     *
     * @return ItemInterface
     */
    public function setLabel(string $label);

    /**
     * Get Menu Item URL.
     *
     * @return string
     */
    public function getLink(): string;

    /**
     * Change Menu URL.
     *
     * @param string $link
     *
     * @return ItemInterface
     */
    public function setLink(string $link);

    /**
     * Get Menu Route Name.
     *
     * @return array
     */
    public function getRoute(): array;

    /**
     * Change Menu Route.
     *
     * @param string $route
     * @param array  $params
     *
     * @return ItemInterface
     */
    public function setRoute(string $route, array $params = []);

    /**
     * Get Link Attributes "<a>".
     *
     * @return array
     */
    public function getLinkAttr(): array;

    /**
     * Set Link Attributes "<a>".
     *
     * @param array $linkAttr
     *
     * @return ItemInterface
     */
    public function setLinkAttr(array $linkAttr);

    /**
     * Get List Attributes "<li>".
     *
     * @return array
     */
    public function getListAttr(): array;

    /**
     * Set List Attributes "<li>".
     *
     * @param array $listAttr
     *
     * @return ItemInterface
     */
    public function setListAttr(array $listAttr);

    /**
     * Get Child List Attributes "<ul>".
     *
     * @return array
     */
    public function getChildAttr(): array;

    /**
     * Set Child List Attributes "<ul>".
     *
     * @param array $childAttr
     *
     * @return ItemInterface
     */
    public function setChildAttr(array $childAttr);

    /**
     * Get Label Attributes.
     *
     * @return array
     */
    public function getLabelAttr(): array;

    /**
     * Set Label Interface.
     *
     * @param array $labelAttr
     *
     * @return ItemInterface
     */
    public function setLabelAttr(array $labelAttr);

    /**
     * Get Extra Data Menu Item.
     *
     * @param string $name
     * @param null   $default
     *
     * @return mixed
     */
    public function getExtra(string $name, $default = null);

    /**
     * Set Extra Data Menu Item.
     *
     * @param string $name
     * @param $value
     *
     * @return ItemInterface
     */
    public function setExtra(string $name, $value);

    /**
     * Get Access Roles Menu Item.
     *
     * @return array
     */
    public function getRoles(): array;

    /**
     * Set Access Roles Menu Item.
     *
     * @param array $roles
     *
     * @return ItemInterface
     */
    public function setRoles(array $roles);

    /**
     * Get Child Items.
     *
     * @return ItemInterface[]
     */
    public function getChild(): array;

    /**
     * Set Child Items.
     *
     * @param array $child
     *
     * @return ItemInterface
     */
    public function setChild(array $child);

    /**
     * Add Child.
     *
     * @param $child
     * @param null $order
     *
     * @return ItemInterface
     */
    public function addChild($child, $order = null);

    /**
     * Add Child to Parent Item.
     *
     * @param $child
     * @param null $order
     *
     * @return ItemInterface
     */
    public function addChildParent($child, $order = null);

    /**
     * Get Parent Menu Item.
     *
     * @return ItemInterface|null
     */
    public function getParent();

    /**
     * Set Parent Menu Item.
     *
     * @param ItemInterface $item
     *
     * @return ItemInterface
     */
    public function setParent($item);

    /**
     * Check Menu is Root.
     *
     * @return bool
     */
    public function isRoot(): bool;

    /**
     * Get Menu Level.
     *
     * @return int
     */
    public function getLevel(): int;
}

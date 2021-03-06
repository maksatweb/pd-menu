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

class Item implements ItemInterface
{
    /**
     * @var int
     */
    private $id = null;

    /**
     * @var null
     */
    private $name = null;

    /**
     * @var string
     */
    private $label = '';

    /**
     * @var string
     */
    private $link = '';

    /**
     * @var array
     */
    private $route = [];

    /**
     * @var array
     */
    private $linkAttr = [];

    /**
     * @var array
     */
    private $listAttr = [];

    /**
     * @var array
     */
    private $childAttr = [];

    /**
     * @var array
     */
    private $labelAttr = [];

    /**
     * @var array
     */
    private $extra = [];

    /**
     * @var array
     */
    private $roles = [];

    /**
     * @var ItemInterface[]
     */
    private $child = [];

    /**
     * @var null | ItemInterface
     */
    private $parent = null;

    /**
     * Item constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label)
    {
        $this->label = $label;

        return $this;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link)
    {
        $this->link = $link;

        return $this;
    }

    public function getRoute(): array
    {
        return $this->route;
    }

    public function setRoute(string $route, array $params = [])
    {
        $this->route = [
            'name' => $route,
            'params' => $params,
        ];

        return $this;
    }

    public function getLinkAttr(): array
    {
        return $this->linkAttr;
    }

    public function setLinkAttr(array $linkAttr)
    {
        $this->linkAttr = array_merge($this->linkAttr, $linkAttr);

        return $this;
    }

    public function getListAttr(): array
    {
        return $this->listAttr;
    }

    public function setListAttr(array $listAttr)
    {
        $this->listAttr = array_merge($this->listAttr, $listAttr);

        return $this;
    }

    public function getChildAttr(): array
    {
        return $this->childAttr;
    }

    public function setChildAttr(array $childAttr)
    {
        $this->childAttr = array_merge($this->childAttr, $childAttr);

        return $this;
    }

    public function getLabelAttr(): array
    {
        return $this->labelAttr;
    }

    public function setLabelAttr(array $labelAttr)
    {
        $this->labelAttr = array_merge($this->labelAttr, $labelAttr);

        return $this;
    }

    public function getExtra(string $name, $default = false)
    {
        if (is_array($this->extra) && isset($this->extra[$name])) {
            return $this->extra[$name];
        }

        return $default;
    }

    public function setExtra(string $name, $value)
    {
        if (is_array($this->extra)) {
            $this->extra[$name] = $value;
        } else {
            $this->extra = [$name => $value];
        }

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles)
    {
        $this->roles = array_merge($this->roles, $roles);

        return $this;
    }

    public function getChild(): array
    {
        return $this->child;
    }

    public function setChild(array $child)
    {
        $this->child = $child;

        return $this;
    }

    public function addChild($child, $childId = null)
    {
        // Create New Item
        if (!$child instanceof ItemInterface) {
            $child = new self($child);
        }

        // Child Set Parent & ID
        $child
            ->setParent($this)
            ->setId($childId);

        // Add Child This
        if ($child->getId()) {
            $this->child[$child->getId()] = $child;
        } else {
            $this->child[] = $child;
            end($this->child);
            $child->setId(key($this->child));
        }

        return $child;
    }

    public function addChildParent($child, $childId = null)
    {
        return $this->parent->addChild($child, $childId);
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setParent($item)
    {
        if ($item === $this) {
            throw new \InvalidArgumentException('Item cannot be a child of itself');
        }

        $this->parent = $item;

        return $this;
    }

    public function isRoot(): bool
    {
        return null === $this->parent;
    }

    public function getLevel(): int
    {
        return $this->parent ? $this->parent->getLevel() + 1 : 0;
    }
}

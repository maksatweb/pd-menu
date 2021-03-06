# pdMenu Bundle
Simple fast object-oriented menu maker for Symfony 4

Installation
---

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require rmznpydn/pd-menu
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Step 2: Enable the Bundle

With Symfony 4, the package will be activated automatically. But if something goes wrong, you can install it manually.

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
<?php
// config/bundles.php

return [
    //...
    Pd\MenuBundle\PdMenuBundle::class => ['all' => true]
];
```

Create Your First menu
---

### Step 1: Without Service
You can create menus without service. You can load the necessary parameters using `$options`

```php
<?php
// Menu/FirstMenu.php

namespace App\Menu;

use Pd\MenuBundle\Builder\ItemInterface;
use Pd\MenuBundle\Builder\Menu;

class FirstMenu extends Menu
{
    /**
     * Override 
     */
    public function createMenu(array $options = []): ItemInterface
    {
        // Create Root Item
        $menu = $this->createRoot('settings_menu');

        // Create Menu Items
        $menu->addChild('nav_config_general', 1)
            ->setLabel('nav_config_general')
            ->setRoute('admin_settings_general')
            ->setLinkAttr(['class' => 'nav-item'])
            ->setRoles(['ADMIN_SETTINGS_GENERAL'])
                // Contact
                ->addChildParent('nav_config_contact', 5)
                ->setLabel('nav_config_contact')
                ->setRoute('admin_settings_contact')
                ->setLinkAttr(['class' => 'nav-item'])
                ->setRoles(['ADMIN_SETTINGS_CONTACT'])
                // Email
                ->addChildParent('nav_config_email', 10)
                ->setLabel('nav_config_email')
                ->setRoute('admin_settings_email')
                ->setLinkAttr(['class' => 'nav-item'])
                ->setRoles(['ADMIN_SETTINGS_EMAIL'])
                // Template
                ->addChildParent('nav_config_template')
                ->setLabel('nav_config_template')
                ->setRoute('admin_settings_template')
                ->setLinkAttr(['class' => 'nav-item'])
                ->setRoles(['ADMIN_SETTINGS_TEMPLATE'])
                // Account
                ->addChildParent('nav_config_user')
                ->setLabel('nav_config_user')
                ->setRoute('admin_settings_user')
                ->setLinkAttr(['class' => 'nav-item'])
                ->setRoles(['ADMIN_SETTINGS_USER']);

        return $menu;
    }
}
```

### Step 2: With Service
You can load the necessary parameters using `$options`

```php
<?php
// Menu/FirstMenu.php

namespace App\Menu;

use Pd\MenuBundle\Builder\ItemInterface;
use Pd\MenuBundle\Builder\Menu;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FirstMenu extends Menu
{
    /**
     * @var ContainerInterface 
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
        
    /**
     * Override 
     */
    public function createMenu(array $options = []): ItemInterface
    {
        // Create Root Item
        $menu = $this->createRoot('settings_menu');

        // Create Menu Items
        $menu->addChild('nav_config_general', 1)
            ->setLabel('nav_config_general')
            ->setRoute('admin_settings_general')
            ->setLinkAttr(['class' => 'nav-item'])
            ->setRoles(['ADMIN_SETTINGS_GENERAL'])
                // Contact
                ->addChildParent('nav_config_contact', 5)
                ->setLabel('nav_config_contact')
                ->setRoute('admin_settings_contact')
                ->setLinkAttr(['class' => 'nav-item'])
                ->setRoles(['ADMIN_SETTINGS_CONTACT'])
                // Email
                ->addChildParent('nav_config_email', 10)
                ->setLabel('nav_config_email')
                ->setRoute('admin_settings_email')
                ->setLinkAttr(['class' => 'nav-item'])
                ->setRoles(['ADMIN_SETTINGS_EMAIL'])
                // Template
                ->addChildParent('nav_config_template')
                ->setLabel('nav_config_template')
                ->setRoute('admin_settings_template')
                ->setLinkAttr(['class' => 'nav-item'])
                ->setRoles(['ADMIN_SETTINGS_TEMPLATE'])
                // Account
                ->addChildParent('nav_config_user')
                ->setLabel('nav_config_user')
                ->setRoute('admin_settings_user')
                ->setLinkAttr(['class' => 'nav-item'])
                ->setRoles(['ADMIN_SETTINGS_USER']);

        return $menu;
    }
}
```
Create Menu Service:

```yaml
# config/services.yaml

App\Menu\FirstMenu:
    public: true
```

Rendering Menu
---
The creation process is very simple. You can specify additional options.

```twig
{{ pd_menu_render('App\\Menu\\FirstMenu', {
    'custom': 'variable or options'
}) }}
```

You can change the default options.
```twig
{{ pd_menu_render('App\\Menu\\FirstMenu', {
    'template': '@PdMenu/Default/menu.html.twig'
    'depth': null
    'currentClass': 'active'
}) }}
```



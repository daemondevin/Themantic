# Themantic Examples

This directory contains practical examples demonstrating how to use Themantic components.

## Directory Structure

```
examples/
├── README.md (this file)
├── 01-basic/
│   ├── buttons.php
│   ├── icons.php
│   ├── labels.php
│   └── messages.php
├── 02-collections/
│   ├── forms.php
│   ├── grids.php
│   ├── menus.php
│   └── tables.php
├── 03-views/
│   ├── cards.php
│   ├── comments.php
│   ├── feeds.php
│   └── statistics.php
├── 04-modules/
│   ├── modals.php
│   ├── dropdowns.php
│   ├── accordions.php
│   └── tabs.php
├── 05-advanced/
│   ├── custom-components.php
│   ├── dynamic-forms.php
│   ├── ajax-integration.php
│   └── event-handling.php
├── 06-snippets/
│   ├── snippet-examples.php
│   └── chunk-integration.php
└── 07-real-world/
    ├── login-form.php
    ├── dashboard.php
    ├── product-catalog.php
    └── contact-page.php
```

## Quick Start

Each example file is self-contained and can be run independently. Simply include the Themantic bootstrap and run the example:

```php
<?php
require_once MODX_CORE_PATH . 'components/themantic/bootstrap.php';
$themantic = $modx->getPlaceholder('themantic');

// Include any example file
require_once __DIR__ . '/examples/01-basic/buttons.php';
```

## Running Examples

### As MODX Resources

Create a new Resource and set the content to:

```
[[!ThematicExample? &file=`01-basic/buttons.php`]]
```

### As Standalone Scripts

```php
<?php
// test.php
require_once 'config.core.php';
require_once MODX_CORE_PATH . 'model/modx/modx.class.php';
$modx = new modX();
$modx->initialize('web');

require_once MODX_CORE_PATH . 'components/themantic/bootstrap.php';
$themantic = $modx->getPlaceholder('themantic');

// Run example
require_once __DIR__ . '/examples/01-basic/buttons.php';
```

## Learning Path

1. **Start with Basic Examples** - Learn individual components
2. **Collections** - See how components work together
3. **Views** - Build content displays
4. **Modules** - Add interactivity
5. **Advanced** - Custom components and integrations
6. **Snippets** - MODX-specific usage
7. **Real-World** - Complete applications

## Contributing Examples

When adding new examples, follow these guidelines:

- Keep examples focused on one concept
- Include comments explaining the code
- Show both basic and advanced usage
- Include expected output as comments
- Test all examples before committing

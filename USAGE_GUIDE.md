# Themantic Usage Guide

## Table of Contents

1. [Installation](#installation)
2. [Basic Usage](#basic-usage)
3. [Component System](#component-system)
4. [Asset Management](#asset-management)
5. [Dependency Injection](#dependency-injection)
6. [Custom Components](#custom-components)
7. [Advanced Features](#advanced-features)
8. [API Reference](#api-reference)

---

## Installation

### 1. Place Files

```
core/components/themantic/
├── src/
│   ├── Themantic.php
│   ├── ComponentInterface.php
│   ├── AssetManager.php
│   ├── ComponentRegistry.php
│   ├── Components/
│   │   ├── BaseComponent.php
│   │   ├── Button.php
│   │   ├── Modal.php
│   │   └── ...
│   └── Traits/
│       ├── ClassBuilder.php
│       └── AttributeBuilder.php
└── vendor/
    └── autoload.php
```

### 2. Initialize in Bootstrap

```php
// core/components/themantic/bootstrap.php
require_once __DIR__ . '/vendor/autoload.php';

$themantic = new \Themantic\Themantic($modx, [
    'themantic.version' => '2.9.3',
    'auto_inject' => true,
]);

$modx->setPlaceholder('themantic', $themantic);
```

---

## Basic Usage

### Rendering Components

```php
// Get Themantic instance
$themantic = $modx->getPlaceholder('themantic');

// Render a button
echo $themantic->render('button', [
    'text' => 'Click Me',
    'color' => 'blue',
    'size' => 'large'
]);

// Render a modal
echo $themantic->render('modal', [
    'id' => 'my-modal',
    'header' => 'Welcome',
    'content' => 'Hello, world!',
    'actions' => [
        ['text' => 'Cancel', 'class' => 'deny'],
        ['text' => 'Okay', 'class' => 'approve blue']
    ]
]);
```

### In MODX Snippets

```php
// [[!Button? &text=`Click Me` &color=`blue`]]

$themantic = $modx->getPlaceholder('themantic');

return $themantic->render('button', $scriptProperties);
```

### In Chunks

```html
<!-- Template chunk -->
<div class="ui container">
    [[+button]]
    [[+modal]]
</div>
```

```php
// PHP code
$themantic = $modx->getPlaceholder('themantic');

$button = $themantic->render('button', ['text' => 'Open Modal']);
$modal = $themantic->render('modal', ['id' => 'demo']);

return $modx->parseChunk('myTemplate', [
    'button' => $button,
    'modal' => $modal
]);
```

---

## Component System

### Component Types

Themantic organizes components into categories:

- **Elements**: Basic building blocks (button, icon, label, etc.)
- **Collections**: Groups of elements (menu, form, table, etc.)
- **Views**: Content displays (card, item, statistic, etc.)
- **Modules**: Interactive components (modal, dropdown, accordion, etc.)

### Creating Components Programmatically

```php
// Get component instance
$button = $themantic->make('button');

// Customize and render
$html = $button->render([
    'text' => 'Submit',
    'color' => 'green',
    'icon' => 'check'
]);
```

### Component Properties

All components support common properties:

```php
[
    // Styling
    'class' => 'my-custom-class',
    'color' => 'blue|red|green|...',
    'size' => 'mini|tiny|small|large|big|huge|massive',
    
    // States
    'disabled' => true|false,
    'loading' => true|false,
    'active' => true|false,
    
    // Layout
    'fluid' => true|false,
    'compact' => true|false,
    'attached' => 'top|bottom|left|right',
    'floated' => 'left|right',
    
    // HTML attributes
    'id' => 'my-element',
    'data-value' => 'custom',
    'aria-label' => 'Description',
]
```

---

## Asset Management

### Manual Asset Injection

```php
$assetManager = $themantic->getAssetManager();

// Inject Fomantic-UI assets
$assetManager->inject();

// Add custom scripts
$assetManager->addScript('https://example.com/custom.js');
$assetManager->addStyle('https://example.com/custom.css');

// Add inline scripts
$assetManager->addInlineScript('
    $(document).ready(function() {
        $(".ui.modal").modal("show");
    });
');

// Add inline styles
$assetManager->addInlineStyle('
    .custom-button { background: #ff0000; }
');
```

### Disabling Auto-Injection

```php
// Initialize without auto-injection
$themantic = new \Themantic\Themantic($modx, [
    'auto_inject' => false
]);

// Manually inject when needed
$themantic->getAssetManager()->inject();
```

---

## Dependency Injection

### Registering Services

```php
// Simple class binding
$themantic->bind(MyService::class);

// With factory function
$themantic->bind(CacheService::class, function($themantic) {
    return new CacheService(
        $themantic->getModx(),
        $themantic->getOption('cache_enabled')
    );
});

// Singleton (only one instance created)
$themantic->singleton(DatabaseService::class, function($themantic) {
    return new DatabaseService($themantic->getModx());
});
```

### Using Services

```php
// Get service (creates if needed, caches instance)
$cache = $themantic->get(CacheService::class);

// Check if service exists
if ($themantic->has(CacheService::class)) {
    $cache = $themantic->get(CacheService::class);
}
```

---

## Custom Components

### Creating a Custom Component

```php
<?php

namespace App\Components;

use Themantic\Components\BaseComponent;

class Hero extends BaseComponent
{
    protected array $defaultProperties = [
        'background' => 'blue',
        'height' => 'medium',
    ];

    protected array $requiredProperties = ['title'];

    public function render(array $properties = []): string
    {
        $props = $this->mergeProperties($properties);
        
        if (!$this->validate($props)) {
            return '';
        }

        $classes = $this->buildClasses('ui segment hero', $props);
        
        return sprintf(
            '<div class="%s">
                <h1 class="ui header">%s</h1>
                <p class="subtitle">%s</p>
            </div>',
            $classes,
            $this->sanitize($props['title']),
            $this->sanitize($props['subtitle'] ?? '')
        );
    }

    public function getName(): string
    {
        return 'hero';
    }
}
```

### Registering Custom Components

```php
// Register single component
$themantic->registerComponent('hero', App\Components\Hero::class);

// Use it
echo $themantic->render('hero', [
    'title' => 'Welcome!',
    'subtitle' => 'This is a custom component'
]);

// Or via registry
$registry = $themantic->getComponentRegistry();
$registry->register('hero', App\Components\Hero::class, 'jumbotron');

// Can now use either name
echo $themantic->render('hero', [...]);
echo $themantic->render('jumbotron', [...]);
```

### Auto-Discovery

```php
// Discover all components in a directory
$registry = $themantic->getComponentRegistry();
$registry->discover(
    '/path/to/components',
    'App\\Components\\'
);

// All PHP files in that directory are now registered
```

---

## Advanced Features

### Component Validation

```php
class ContactForm extends BaseComponent
{
    protected array $requiredProperties = ['email', 'message'];

    public function validate(array $properties = []): bool
    {
        // Custom validation
        if (!parent::validate($properties)) {
            return false;
        }

        if (!filter_var($properties['email'], FILTER_VALIDATE_EMAIL)) {
            $this->logError('Invalid email address');
            return false;
        }

        return true;
    }
}
```

### Using Traits

```php
class MyComponent extends BaseComponent
{
    public function render(array $properties = []): string
    {
        // Use ClassBuilder trait
        $classes = $this->buildClasses('ui segment', $properties);
        
        // Use AttributeBuilder trait
        $dataAttrs = $this->extractDataAttributes($properties);
        $ariaAttrs = $this->extractAriaAttributes($properties);
        
        $attributes = $this->buildHtmlAttributes([
            'id' => $properties['id'] ?? null,
            ...$dataAttrs,
            ...$ariaAttrs,
        ]);
        
        return "<div class=\"{$classes}\" {$attributes}>Content</div>";
    }
}
```

### Template Rendering

```php
class Card extends BaseComponent
{
    public function render(array $properties = []): string
    {
        $template = '
            <div class="{{classes}}">
                <div class="content">
                    <div class="header">{{header}}</div>
                    <div class="description">{{description}}</div>
                </div>
            </div>
        ';

        return $this->renderTemplate($template, [
            'classes' => $this->buildClasses('ui card', $properties),
            'header' => $this->sanitize($properties['header'] ?? ''),
            'description' => $this->sanitize($properties['description'] ?? ''),
        ]);
    }
}
```

### Chunked Templates

```php
class ComplexComponent extends BaseComponent
{
    public function render(array $properties = []): string
    {
        // Use MODX chunk as template
        return $this->getChunk('complexComponentTpl', [
            'title' => $properties['title'],
            'content' => $this->parseContent($properties['content']),
        ]);
    }
}
```

---

## API Reference

### Themantic Main Class

```php
// Rendering
$themantic->render(string $name, array|string $properties): string
$themantic->make(string $name): ComponentInterface

// Component Management
$themantic->registerComponent(string $name, string $class): void
$themantic->getRegisteredComponents(): array

// Asset Management
$themantic->getAssetManager(): AssetManager

// Component Registry
$themantic->getComponentRegistry(): ComponentRegistry

// Configuration
$themantic->getOption(string $key, $options = null, $default = null)
$themantic->isModx3(): bool

// Service Container (PSR-11)
$themantic->bind(string $id, $concrete = null): void
$themantic->singleton(string $id, $concrete = null): void
$themantic->get(string $id)
$themantic->has(string $id): bool

// Utilities
$themantic->parseContent(string $content, array $properties = []): string
$themantic->decodeJsonProperty($value): array
$themantic->logError(string $method, string $message, string $type = 'method'): void

// Getters
$themantic->getModx(): modX
$themantic->getNamespace(): string
$themantic->getVersion(): string
```

### AssetManager

```php
$assetManager->inject(): void
$assetManager->addScript(string $script, bool $inline = false): void
$assetManager->addStyle(string $style, bool $inline = false): void
$assetManager->addInlineScript(string $script): void
$assetManager->addInlineStyle(string $style): void
$assetManager->isInjected(): bool
$assetManager->reset(): void
```

### ComponentRegistry

```php
$registry->register(string $name, string $class, ?string $alias = null): void
$registry->unregister(string $name): void
$registry->has(string $name): bool
$registry->get(string $name): ?string
$registry->all(): array
$registry->alias(string $alias, string $name): void
$registry->discover(string $directory, string $namespace = ''): void
$registry->getByCategory(string $category): array
$registry->clear(): void
```

### BaseComponent

```php
abstract render(array $properties = []): string
validate(array $properties = []): bool
getName(): string

// Protected helpers
mergeProperties(array $properties): array
prop(array $properties, string $key, $default = null)
hasProp(array $properties, string $key): bool
parseContent(string $content, array $properties = []): string
sanitize(string $html): string
buildDataAttributes(array $data): string
buildAriaAttributes(array $aria): string
renderTemplate(string $template, array $data = []): string
wrap(string $content, string $tag, string $classes, array $attrs = []): string
```

---

## Best Practices

### 1. Always Validate

```php
public function render(array $properties = []): string
{
    if (!$this->validate($properties)) {
        return '';
    }
    // ... render logic
}
```

### 2. Use Type Hints

```php
public function render(array $properties = []): string
{
    // Type hints help catch errors early
}
```

### 3. Sanitize User Input

```php
$title = $this->sanitize($properties['title']);
```

### 4. Leverage Traits

```php
class MyComponent extends BaseComponent
{
    // ClassBuilder and AttributeBuilder available automatically
    use MyCustomTrait;
}
```

### 5. Handle Errors Gracefully

```php
try {
    $html = $themantic->render('component', $props);
} catch (\Exception $e) {
    $themantic->logError(__METHOD__, $e->getMessage());
    $html = '<!-- Component error -->';
}
```

---

## Common Patterns

### Modal with Button Trigger

```php
$modalId = 'confirm-modal';

$button = $themantic->render('button', [
    'text' => 'Confirm Action',
    'data-target' => "#{$modalId}",
    'onClick' => "$('#{$modalId}').modal('show')",
]);

$modal = $themantic->render('modal', [
    'id' => $modalId,
    'header' => 'Confirm',
    'content' => 'Are you sure?',
    'actions' => [
        ['text' => 'Cancel', 'class' => 'deny'],
        ['text' => 'Confirm', 'class' => 'approve green'],
    ],
]);

echo $button . $modal;
```

### Form with Validation

```php
echo $themantic->render('form', [
    'id' => 'contact-form',
    'method' => 'post',
    'fields' => [
        [
            'type' => 'text',
            'name' => 'email',
            'label' => 'Email',
            'required' => true,
        ],
        [
            'type' => 'textarea',
            'name' => 'message',
            'label' => 'Message',
            'required' => true,
        ],
    ],
    'submit' => [
        'text' => 'Send',
        'color' => 'blue',
    ],
]);
```

### Dynamic Grid

```php
$items = [...]; // Data from database

$cards = array_map(function($item) use ($themantic) {
    return $themantic->render('card', [
        'header' => $item['title'],
        'description' => $item['description'],
        'image' => $item['image'],
    ]);
}, $items);

echo $themantic->render('grid', [
    'columns' => 4,
    'items' => $cards,
]);
```

---

This guide covers the essential usage patterns. For more examples, see the `examples/` directory in the repository.
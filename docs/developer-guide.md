# Themantic Developer Guide

## Architecture Overview

Themantic follows MODx Revolution's architecture with additional Semantic/Fomantic UI integration.

```
themantic/
├── _build/              # Build scripts and transport data
├── assets/              # Frontend assets
│   └── components/
│       └── themantic/
│           ├── css/     # Custom styles
│           ├── js/      # Custom scripts
│           ├── images/  # Images and icons
│           └── semantic-ui/ # Semantic UI source
├── core/                # Backend components
│   └── components/
│       └── themantic/
│           ├── docs/    # Documentation
│           ├── elements/ # MODx elements
│           │   ├── chunks/
│           │   ├── plugins/
│           │   ├── snippets/
│           │   └── templates/
│           ├── lexicon/ # Language files
│           └── model/   # Data models
└── docs/                # Extended documentation
```

## Creating Custom Templates

### Basic Template Structure

```html
<!DOCTYPE html>
<html lang="[[++cultureKey]]">
<head>
    <meta charset="[[++modx_charset]]">
    <title>[[*pagetitle]] - [[++site_name]]</title>
    [[$thematicHead]]
</head>
<body>
    [[$thematicNavigation]]
    
    <!-- Your custom content -->
    <div class="ui container">
        [[*content]]
    </div>
    
    [[$thematicFooter]]
</body>
</html>
```

### Template Variables

Define custom TVs for your template:

```php
// In template
[[*customTV:default=`Default Value`]]

// With output filter
[[*imageTV:notempty=`<img src="[[*imageTV]]" alt="[[*pagetitle]]">`]]
```

## Creating Custom Snippets

### Snippet Structure

```php
<?php
/**
 * CustomSnippet
 * 
 * @package themantic
 * @var modX $modx
 * @var array $scriptProperties
 */

// Get parameters
$param1 = $modx->getOption('param1', $scriptProperties, 'default');

// Your logic here
$output = '';

return $output;
```

### Best Practices

- Validate all input parameters
- Use MODx API methods
- Cache when appropriate
- Return output, don't echo
- Document parameters

## Creating Custom Chunks

### Chunk Example

```html
<!-- productCard.chunk.tpl -->
<div class="ui card">
    [[+image:notempty=`
    <div class="image">
        <img src="[[+image]]" alt="[[+title]]">
    </div>
    `]]
    <div class="content">
        <div class="header">[[+title]]</div>
        <div class="meta">
            <span class="price">$[[+price]]</span>
        </div>
        <div class="description">
            [[+description]]
        </div>
    </div>
    <div class="extra content">
        <a href="[[+link]]" class="ui button primary">
            View Details
        </a>
    </div>
</div>
```

## Working with Semantic/Fomantic UI

### Component Integration

```javascript
// Initialize Semantic UI components
$('.ui.dropdown').dropdown();
$('.ui.modal').modal('show');
$('.ui.accordion').accordion();
```

### Custom Semantic/Fomantic UI Theme

1. Navigate to `assets/components/themantic/semantic-ui/`
2. Edit `src/site/globals/site.variables`
3. Modify component-specific variables in `src/site/elements/`
4. Rebuild: `npm run build`

### Adding Components

```html
<!-- In template or chunk -->
<div class="ui segment">
    <div class="ui grid">
        <div class="eight wide column">
            <!-- Content -->
        </div>
        <div class="eight wide column">
            <!-- Content -->
        </div>
    </div>
</div>
```

## Plugin Development

### Plugin Hook Example

```php
<?php
/**
 * Custom Themantic Plugin
 */

$eventName = $modx->event->name;

switch ($eventName) {
    case 'OnLoadWebDocument':
        // Execute on page load
        break;
        
    case 'OnDocFormRender':
        // Execute in manager
        break;
}

return;
```

### Available Events

- `OnLoadWebDocument` - Page load
- `OnDocFormRender` - Document form render
- `OnBeforeSaveWebPageCache` - Before caching
- `OnWebPagePrerender` - Before rendering

## Database Integration

### Creating Custom Models

```php
<?php
namespace Themantic\Model;

class CustomModel extends \xPDOSimpleObject {
    // Model definition
}
```

### Schema Definition

```xml
<?xml version="1.0" encoding="UTF-8"?>
<model package="themantic" baseClass="xPDOObject" platform="mysql">
    <object class="CustomModel" table="themantic_custom" extends="xPDOSimpleObject">
        <field key="name" dbtype="varchar" precision="255" phptype="string" null="false" />
        <field key="description" dbtype="text" phptype="string" null="true" />
    </object>
</model>
```

## AJAX Integration

### Frontend AJAX

```javascript
$.ajax({
    url: '/assets/components/themantic/connector.php',
    method: 'POST',
    data: {
        action: 'customAction',
        param: 'value'
    },
    success: function(response) {
        console.log(response);
    }
});
```

### Connector File

```php
<?php
// connector.php
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
require_once MODX_CORE_PATH . 'model/modx/modx.class.php';

$modx = new modX();
$modx->initialize('web');

$action = $_POST['action'];

switch ($action) {
    case 'customAction':
        // Handle action
        break;
}

return json_encode($response);
```

## Testing

### Unit Testing

```php
<?php
use PHPUnit\Framework\TestCase;

class ThematicTest extends TestCase {
    protected $modx;
    
    public function setUp(): void {
        $this->modx = new modX();
        $this->modx->initialize('web');
    }
    
    public function testSnippet() {
        $result = $this->modx->runSnippet('ThematicMenu');
        $this->assertNotEmpty($result);
    }
}
```

### Integration Testing

1. Test on clean MODx install
2. Test all templates
3. Verify responsive design
4. Check cross-browser compatibility

## Building Packages

### Build Process

```bash
# From project root
php _build/build.transport.php
```

### Package Structure

The build script creates a transport package with:
- Core components
- Asset files
- Templates
- Chunks
- Snippets
- Plugins
- Resolvers

## Version Control

### Git Workflow

```bash
# Create feature branch
git checkout -b feature/new-feature

# Make changes
git add .
git commit -m "Add new feature"

# Push to remote
git push origin feature/new-feature

# Create pull request
```

### Release Process

1. Update version numbers
2. Update changelog
3. Build package
4. Test package installation
5. Tag release
6. Publish to MODx extras

## Performance Optimization

### Caching

```php
// Enable caching in snippet
$cacheOptions = [
    xPDO::OPT_CACHE_KEY => 'themantic',
];
$cacheKey = 'snippet_' . md5(serialize($scriptProperties));

$output = $modx->cacheManager->get($cacheKey, $cacheOptions);
if (empty($output)) {
    // Generate output
    $modx->cacheManager->set($cacheKey, $output, 3600, $cacheOptions);
}
```

### Asset Optimization

- Minify CSS/JS in production
- Combine files where possible
- Use CDN for libraries
- Optimize images
- Enable gzip compression

## Security Best Practices

- Validate all user input
- Escape output
- Use prepared statements
- Check permissions
- Sanitize file uploads
- Keep MODx updated

## Debugging

### Enable Debugging

```php
// In snippet
$modx->log(modX::LOG_LEVEL_ERROR, 'Debug message');

// View logs
// core/cache/logs/error.log
```

### Common Issues

1. **Assets not loading**: Check paths and permissions
2. **Snippet not working**: Verify syntax and parameters
3. **Template not rendering**: Clear cache
4. **Semantic UI conflicts**: Check jQuery version

## Resources

- [MODx Documentation](https://docs.modx.com)
- [Semantic UI Documentation](https://semantic-ui.com)
- [Fomantic UI Documentation](https://fomantic-ui.com)
- [xPDO Documentation](https://docs.modx.com/xpdo)
- [MODx Forums](https://community.modx.com)

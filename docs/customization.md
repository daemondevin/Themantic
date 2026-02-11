 # Themantic Customization Guide

## Overview

This guide covers how to customize Themantic to match your brand and requirements.

## Table of Contents

1. [Theme Customization](#theme-customization)
2. [Layout Modifications](#layout-modifications)
3. [Component Customization](#component-customization)
4. [Advanced Customization](#advanced-customization)

## Theme Customization

### Colors

Edit `assets/components/themantic/semantic-ui/src/site/globals/site.variables`:

```less
/*******************************
     User Global Variables
*******************************/

/* Primary Colors */
@primaryColor: #2185D0;
@secondaryColor: #1B1C1D;

/* Text Colors */
@textColor: rgba(0, 0, 0, 0.87);
@mutedTextColor: rgba(0, 0, 0, 0.6);

/* Background Colors */
@pageBackground: #FFFFFF;
@darkBackground: #1B1C1D;

/* Link Colors */
@linkColor: #4183C4;
@linkHoverColor: #1e70bf;
```

### Typography

```less
/* Fonts */
@pageFont: 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif;
@headerFont: 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif;

/* Font Sizes */
@fontSize: 14px;
@h1: 2rem;
@h2: 1.714rem;
@h3: 1.28rem;
```

### Spacing

```less
/* Relative sizes */
@relativeMini: 0.8rem;
@relativeTiny: 0.9rem;
@relativeSmall: 0.95rem;
@relativeMedium: 1rem;
@relativeLarge: 1.1rem;
@relativeBig: 1.2rem;
@relativeHuge: 1.4rem;
@relativeMassive: 1.6rem;
```

### Rebuild Theme

After making changes:

```bash
cd assets/components/themantic/semantic-ui
npm install
gulp build
```

## Layout Modifications

### Grid System

Semantic UI uses a 16-column grid:

```html
<div class="ui grid">
    <div class="four wide column">
        <!-- 1/4 width -->
    </div>
    <div class="twelve wide column">
        <!-- 3/4 width -->
    </div>
</div>
```

### Responsive Breakpoints

```html
<!-- Stack on mobile -->
<div class="ui stackable grid">
    <div class="eight wide column">Column 1</div>
    <div class="eight wide column">Column 2</div>
</div>

<!-- Different widths per device -->
<div class="ui grid">
    <div class="sixteen wide mobile eight wide tablet four wide computer column">
        Responsive column
    </div>
</div>
```

### Container Sizes

```html
<!-- Standard container -->
<div class="ui container">
    Content
</div>

<!-- Text container (narrower) -->
<div class="ui text container">
    Text content
</div>
```

## Component Customization

### Navigation Menu

Edit `thematicNavigation` chunk:

```html
<div class="ui fixed inverted menu">
    <div class="ui container">
        <!-- Logo -->
        <a href="[[~[[++site_start]]]]" class="header item">
            <img src="[[++assets_url]]images/logo.png">
            [[++site_name]]
        </a>
        
        <!-- Menu items -->
        <a href="[[~2]]" class="item">About</a>
        <a href="[[~3]]" class="item">Services</a>
        <a href="[[~4]]" class="item">Contact</a>
        
        <!-- Right menu -->
        <div class="right menu">
            <a class="ui primary button">Get Started</a>
        </div>
    </div>
</div>
```

### Footer

Edit `thematicFooter` chunk:

```html
<div class="ui inverted vertical footer segment">
    <div class="ui container">
        <div class="ui stackable inverted divided equal height grid">
            <!-- Column 1 -->
            <div class="four wide column">
                <h4 class="ui inverted header">Company</h4>
                <div class="ui inverted link list">
                    <a href="#" class="item">About Us</a>
                    <a href="#" class="item">Team</a>
                    <a href="#" class="item">Careers</a>
                </div>
            </div>
            
            <!-- Add more columns -->
        </div>
    </div>
</div>
```

### Hero Section

Customize `thematicHero` chunk:

```html
<div class="ui inverted vertical masthead center aligned segment">
    <div class="ui text container">
        <h1 class="ui inverted header">
            [[*heroHeading:default=`Your Headline`]]
        </h1>
        <h2>[[*heroSubheading]]</h2>
        
        <!-- Custom CTA -->
        <div class="ui huge primary button">
            [[*heroCTAText:default=`Get Started`]]
            <i class="right arrow icon"></i>
        </div>
    </div>
</div>

<style>
.masthead {
    min-height: 600px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    background-image: url('[[*heroBackgroundImage]]');
    background-size: cover;
}
</style>
```

## Advanced Customization

### Custom Semantic UI Components

Create custom component variations:

```less
// In custom.less
.ui.custom.button {
    background: linear-gradient(to right, #667eea, #764ba2);
    color: white;
    border-radius: 50px;
    padding: 15px 30px;
}
```

### Custom JavaScript Behaviors

Edit `assets/components/themantic/js/themantic.js`:

```javascript
// Add custom functionality
Themantic.customFeature = function() {
    // Your code here
};

// Initialize on page load
$(document).ready(function() {
    Themantic.customFeature();
});
```

### Template Inheritance

Create child templates that extend base:

```html
<!-- In new template -->
[[$thematicHead]]

<!-- Custom sections -->
<div class="custom-section">
    <!-- Your content -->
</div>

<!-- Include base template chunks -->
[[$thematicFooter]]
```

### Custom Template Variables

Create TVs for flexible content:

1. **Create TV in Manager**
   - Name: `customSetting`
   - Input Type: Text
   - Assign to Themantic templates

2. **Use in Template**
   ```html
   [[*customSetting:default=`Default Value`]]
   ```

3. **With Conditions**
   ```html
   [[*showSidebar:is=`1`:then=`
       <div class="sidebar">Sidebar content</div>
   `]]
   ```

### Custom Snippets Integration

```html
<!-- List blog posts -->
[[!getResources? 
    &parents=`5` 
    &limit=`10` 
    &tpl=`blogPost`
    &sortby=`publishedon`
    &sortdir=`DESC`
]]

<!-- With Themantic styling -->
<div class="ui four stackable cards">
    [[!getResources? 
        &parents=`5` 
        &limit=`8` 
        &tpl=`thematicCard`
    ]]
</div>
```

### Form Styling

Semantic/Fomantic UI form classes:

```html
<form class="ui form">
    <div class="field">
        <label>Name</label>
        <input type="text" name="name" placeholder="Your name">
    </div>
    
    <div class="field">
        <label>Email</label>
        <input type="email" name="email" placeholder="Email">
    </div>
    
    <div class="field">
        <div class="ui checkbox">
            <input type="checkbox" name="subscribe">
            <label>Subscribe to newsletter</label>
        </div>
    </div>
    
    <button class="ui primary button" type="submit">
        Submit
    </button>
</form>
```

### Animation Integration

Add animations with Semantic/Fomantic UI transitions:

```javascript
$('.element').transition('fade');
$('.element').transition('scale');
$('.element').transition('slide down');
```

### Icon Customization

Use Semantic/Fomantic UI icons or Font Awesome:

```html
<!-- Semantic/Fomantic UI Icons -->
<i class="home icon"></i>
<i class="user icon"></i>
<i class="settings icon"></i>

<!-- Sized icons -->
<i class="massive home icon"></i>
<i class="huge user icon"></i>
```

### Mobile Menu

Implement sidebar for mobile:

```html
<!-- Sidebar -->
<div class="ui sidebar inverted vertical menu">
    <a class="item">Home</a>
    <a class="item">About</a>
    <a class="item">Contact</a>
</div>

<!-- Toggle button -->
<div class="ui menu">
    <a class="toc item">
        <i class="sidebar icon"></i>
    </a>
</div>

<script>
$('.ui.sidebar').sidebar('attach events', '.toc.item');
</script>
```

### Custom Breakpoints

Override default breakpoints:

```less
@mobileBreakpoint: 320px;
@tabletBreakpoint: 768px;
@computerBreakpoint: 992px;
@largeMonitorBreakpoint: 1200px;
```

## Best Practices

1. **Keep Core Files Intact**: Make customizations in separate files
2. **Use Version Control**: Track all changes
3. **Test Responsively**: Check all breakpoints
4. **Document Changes**: Comment custom code
5. **Optimize Assets**: Minify in production
6. **Backup Before Updates**: Save custom changes

## Common Customizations

### Change Primary Color Site-Wide

```less
@primaryColor: #E74C3C; // Red
```
Rebuild Semantic/Fomantic UI

### Add Custom Font

```html
<!-- In thematicHead chunk -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
```

```less
@pageFont: 'Roboto', sans-serif;
```

### Sticky Footer

```css
html, body {
    height: 100%;
}

body {
    display: flex;
    flex-direction: column;
}

.ui.main.container {
    flex: 1;
}
```

### Full-Width Sections

```html
<div class="ui vertical segment" style="padding: 0;">
    <div class="ui fluid container">
        Full-width content
    </div>
</div>
```

## Troubleshooting

- **Styles not applying**: Clear MODx cache and browser cache
- **Build errors**: Check Node.js version compatibility
- **Missing fonts**: Verify CDN links or local paths
- **Responsive issues**: Test with browser dev tools

## Resources

- [Semantic UI Theming](https://semantic-ui.com/usage/theming.html)
- [Semantic UI Examples](https://semantic-ui.com/examples/homepage.html)
- [Fomantic UI Theming](https://fomantic-ui.com/usage/theming.html)
- [Fomantic UI Examples](https://fomantic-ui.com/examples/homepage.html)
- [MODx Template Variables](https://docs.modx.com/current/en/building-sites/elements/template-variables)

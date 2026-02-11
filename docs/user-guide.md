# Themantic User Guide

## Table of Contents

1. [Getting Started](#getting-started)
2. [Templates Overview](#templates-overview)
3. [Working with Chunks](#working-with-chunks)
4. [Using Snippets](#using-snippets)
5. [Customization](#customization)
6. [Best Practices](#best-practices)

## Getting Started

After installing Themantic, you'll have access to four main templates and various components.

### Your First Page

1. Create a new resource in MODx Manager
2. Select a Themantic template
3. Add your content
4. Save and preview

## Templates Overview

### ThematicBase

The foundation template with:
- Fixed navigation
- Content area
- Footer

**Use for**: Standard pages, about pages, contact forms

### ThematicLanding

Landing page optimized template with:
- Hero section with CTA
- Features section
- Call-to-action section

**Use for**: Product launches, service pages, marketing campaigns

### ThematicBlog

Blog-focused template with:
- Article content area
- Sidebar with recent posts
- Tag support
- Author information

**Use for**: Blog posts, news articles, documentation

### ThematicEcommerce

E-commerce template with:
- Product grid
- Filter sidebar
- Pagination
- Product cards

**Use for**: Online stores, product catalogs, marketplaces

## Working with Chunks

### Available Chunks

#### thematicHead
Contains CSS and meta tag includes.

**Customization**:
```html
<!-- Add custom CSS -->
<link rel="stylesheet" href="path/to/custom.css">

<!-- Add analytics -->
<script>/* Analytics code */</script>
```

#### thematicFooter
Footer HTML and JavaScript includes.

**Customization**:
Edit footer links and content directly in the chunk.

#### thematicNavigation
Main navigation menu.

**Parameters**:
- Automatically generates from page structure
- Edit chunk to modify layout

#### thematicHero
Hero section for landing pages.

**Template Variables Used**:
- `heroHeading` - Main headline
- `heroSubheading` - Subtitle
- `heroCTAText` - Button text
- `heroBackgroundImage` - Background image URL

#### thematicCard
Reusable card component.

**Properties**:
- `image` - Card image
- `title` - Card title
- `description` - Card description
- `link` - Card link
- `linkText` - Link text

## Using Snippets

### ThematicMenu

Generates Semantic/Fomantic UI formatted navigation.

**Example**:
```
[[ThematicMenu? 
    &startId=`0` 
    &level=`1` 
    &classNames=`item`
    &activeClass=`active`
    &excludeDocs=`10,20`
]]
```

**Parameters**:
- `startId` - Parent resource ID (default: current page)
- `level` - Menu depth (default: 1)
- `classNames` - CSS classes for items
- `activeClass` - Class for active item
- `showHidden` - Show hidden menu items (default: false)
- `excludeDocs` - Comma-separated IDs to exclude

### ThematicBreadcrumbs

Creates breadcrumb navigation.

**Example**:
```
[[ThematicBreadcrumbs? 
    &showHome=`1` 
    &homeText=`Home`
    &showCurrent=`1`
    &divider=`/`
]]
```

**Parameters**:
- `showHome` - Show home link (default: true)
- `homeText` - Home link text (default: "Home")
- `showCurrent` - Show current page (default: true)
- `containerClass` - CSS class for container
- `divider` - Separator character (default: "/")

### ThematicGallery

Creates image gallery.

**Example**:
```
[[ThematicGallery? 
    &images=`image1.jpg,image2.jpg,image3.jpg`
    &columns=`4`
]]
```

**Parameters**:
- `images` - Comma-separated image paths
- `columns` - Number of columns (default: 4)
- `containerClass` - CSS class for container

## Customization

### Colors and Fonts

1. Navigate to `assets/components/themantic/semantic-ui/src/site/globals/site.variables`
2. Modify variables:
```less
@primaryColor: #2185D0;
@secondaryColor: #1B1C1D;
@pageFont: 'Lato', sans-serif;
```
3. Rebuild: `npm run build`

### Adding Custom CSS

Add to `assets/components/themantic/css/themantic.css` or create a custom CSS file.

### Template Variables

Create TVs for dynamic content:
1. Go to Elements > Template Variables
2. Create new TV
3. Assign to Themantic template
4. Use in template: `[[*yourTVname]]`

## Best Practices

### Performance

- Optimize images before upload
- Use lazy loading for images
- Minimize custom CSS/JS
- Enable MODx caching

### SEO

- Use descriptive page titles
- Fill in meta descriptions
- Use proper heading hierarchy
- Add alt text to images

### Accessibility

- Use semantic HTML
- Provide alt text
- Ensure keyboard navigation
- Maintain color contrast

### Content Organization

- Plan site structure before building
- Use consistent naming
- Organize resources in folders
- Document custom modifications

## Common Tasks

### Creating a Blog

1. Create parent resource with ThematicBlog template
2. Create child resources for posts
3. Use getResources to list posts
4. Add categories and tags

### Building a Landing Page

1. Create resource with ThematicLanding template
2. Set template variables:
   - heroHeading
   - heroSubheading
   - heroCTAText
3. Add features content
4. Add CTA section

### Setting Up E-commerce

1. Install commerce addon (e.g., SimpleCart)
2. Create product resources
3. Use ThematicEcommerce template
4. Configure product TVs
5. Set up payment processing

## Getting Help

- Check [FAQ](faq.md)
- Review [Developer Guide](developer-guide.md)
- Visit [MODx Forums](https://community.modx.com)
- Submit issues on GitHub

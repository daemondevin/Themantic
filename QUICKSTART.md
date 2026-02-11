# Themantic Quick Start Guide

## Getting Started in 5 Minutes

### Step 1: Installation

**Option A: MODx Package Manager (Recommended)**
1. Log into MODx Manager
2. Go to Extras > Installer
3. Search for "Themantic"
4. Click Install

**Option B: Manual Installation**
```bash
# Upload files to your MODx installation
# Copy core/components/themantic/ to {MODX_CORE_PATH}/components/
# Copy assets/components/themantic/ to {MODX_ASSETS_PATH}/components/
```

### Step 2: Create Your First Page

1. In MODx Manager, right-click Resources
2. Select "Create > Document Here"
3. Choose template: **ThematicLanding**
4. Add title and content
5. Click Save

### Step 3: View Your Site

Visit your new page - you now have a beautiful Semantic UI-powered site!

## What's Included

### Templates
- **ThematicBase** - Standard pages
- **ThematicLanding** - Landing pages with hero
- **ThematicBlog** - Blog posts
- **ThematicEcommerce** - Product listings

### Components
- Pre-built navigation
- Responsive footer
- Hero sections
- Card layouts
- Image galleries

### Snippets
- ThematicMenu - Dynamic navigation
- ThematicBreadcrumbs - Breadcrumb navigation
- ThematicGallery - Image galleries

## Customize Your Site

### Change Colors
1. Navigate to `assets/components/themantic/semantic-ui/src/site/globals/site.variables`
2. Change `@primaryColor: #YOUR_COLOR;`
3. Run `npm run build`

### Modify Navigation
Edit the `thematicNavigation` chunk in Elements > Chunks

### Customize Footer
Edit the `thematicFooter` chunk in Elements > Chunks

## Next Steps

- Read the [User Guide](docs/user-guide.md)
- Check out [Customization Guide](docs/customization.md)
- Review [Developer Guide](docs/developer-guide.md)
- Explore Semantic UI components at [semantic-ui.com](https://semantic-ui.com)
- Explore Fomantic UI components at [fomantic-ui.com](https://fomantic-ui.com)

## Need Help?

- Check the documentation in the `docs/` folder
- Visit [MODx Community Forums](https://community.modx.com)
- Submit issues on GitHub

## Common Use Cases

### Landing Page
1. Use **ThematicLanding** template
2. Set Template Variables:
   - `heroHeading`: Your main headline
   - `heroSubheading`: Supporting text
   - `heroCTAText`: Button text

### Blog
1. Create parent page with **ThematicBlog** template
2. Create child pages for blog posts
3. Posts automatically appear in sidebar

### E-commerce
1. Use **ThematicEcommerce** template
2. Install commerce addon (SimpleCart, etc.)
3. Add products as child resources

## Features Overview

✓ Semantic/Fomantic UI 2.5+ integrated
✓ Fully responsive
✓ MODx Manager extras
✓ Multiple pre-built templates
✓ Custom snippets included
✓ Easy to customize
✓ Production-ready
✓ Well-documented

## System Requirements

- MODx Revolution 2.8+
- PHP 7.4+
- Apache/Nginx
- MySQL 5.7+ or MariaDB 10.2+

---

**Ready to build something amazing? Start customizing Themantic now!**

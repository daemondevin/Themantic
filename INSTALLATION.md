# Themantic Installation Guide

## Prerequisites

Before installing Themantic, ensure you have:

- MODx Revolution 2.8 or higher
- PHP 7.4 or higher
- Apache or Nginx web server
- MySQL 5.7+ or MariaDB 10.2+

## Installation Methods

### Method 1: Package Manager (Recommended)

1. Log in to your MODx Manager
2. Navigate to **Extras > Installer**
3. Click **Download Extras**
4. Search for "Themantic"
5. Click **Download** and then **Install**
6. Follow the on-screen instructions
7. Clear your site cache

### Method 2: Manual Installation

1. Download the latest release from the repository
2. Extract the package to a temporary directory
3. Copy the contents to your MODx installation:
   - Copy `core/components/themantic/` to `{MODX_CORE_PATH}/components/`
   - Copy `assets/components/themantic/` to `{MODX_ASSETS_PATH}/components/`
4. Log in to MODx Manager
5. Navigate to **System > System Settings**
6. Clear cache

### Method 3: Build from Source

1. Clone the repository:
   ```bash
   git clone https://github.com/daemondevin/themantic.git
   cd themantic
   ```

2. Install dependencies:
   ```bash
   npm install
   composer install
   ```

3. Build the Semantic UI assets:
   ```bash
   npm run install:semantic
   npm run build
   ```

4. Build the MODx package:
   ```bash
   php _build/build.transport.php
   ```

5. Install the generated transport package via MODx Package Manager

## Post-Installation Setup

### 1. Configure System Settings

Navigate to **System > System Settings** and set the following:

- `themantic.copyright_year` - Copyright year for footer
- `themantic.footer_text` - Custom footer text
- `themantic.about_page_id` - Resource ID for About page
- `themantic.contact_page_id` - Resource ID for Contact page
- `themantic.login_resource_id` - Resource ID for Login page
- `themantic.logout_resource_id` - Resource ID for Logout page
- `themantic.register_resource_id` - Resource ID for Registration page
- `themantic.account_page_id` - Resource ID for Account page

### 2. Create Your First Page

1. Go to **Resources** in the left tree
2. Right-click and select **Create > Create a Document Here**
3. Give your page a title
4. Select a Themantic template from the **Template** dropdown:
   - **ThematicBase** - Basic page template
   - **ThematicLanding** - Landing page with hero section
   - **ThematicBlog** - Blog post template
   - **ThematicEcommerce** - Product listing template
5. Add your content
6. Click **Save**

### 3. Set Up Navigation

The Themantic menu automatically generates from your page structure. To customize:

1. Edit the `thematicNavigation` chunk
2. Modify the `ThematicMenu` snippet call parameters:
   ```
   [[ThematicMenu? 
       &startId=`0` 
       &level=`1` 
       &classNames=`item`
   ]]
   ```

### 4. Customize Semantic UI Theme

1. Navigate to `assets/components/themantic/semantic-ui/`
2. Edit `semantic.json` to configure your build
3. Modify variables in `src/site/` to customize colors, fonts, etc.
4. Rebuild with `npm run build`

## Updating

### Via Package Manager

1. Navigate to **Extras > Installer**
2. Find Themantic in your installed packages
3. Click **Update** if an update is available

### Manual Update

1. Backup your site and database
2. Download the latest version
3. Replace the core and assets files
4. Clear MODx cache
5. Test thoroughly

## Troubleshooting

### Assets Not Loading

1. Check file permissions (755 for directories, 644 for files)
2. Verify paths in System Settings
3. Clear browser cache
4. Clear MODx cache

### Templates Not Appearing

1. Ensure the package installed correctly
2. Clear MODx cache
3. Check Elements > Templates in Manager

### Semantic UI Not Working

1. Verify jQuery is loaded before Semantic UI
2. Check browser console for JavaScript errors
3. Ensure semantic.min.css and semantic.min.js are loaded

## Getting Help

- Documentation: [docs/user-guide.md](docs/user-guide.md)
- Forum: [MODx Community Forums](https://community.modx.com)
- Issues: [GitHub Issues](https://github.com/daemondevin/themantic/issues)

## Next Steps

- [Customization Guide](docs/customization.md)
- [Developer Guide](docs/developer-guide.md)
- [Creating Custom Templates](docs/templates.md)

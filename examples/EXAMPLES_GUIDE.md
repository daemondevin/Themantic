# Themantic Examples Directory

Complete examples demonstrating all features of the Themantic framework.

## 📁 Directory Structure

```
examples/
├── index.php                          # Main navigation page
├── README.md                          # This file
│
├── 01-basic/                          # Basic Components
│   ├── buttons.php                    # ✅ All button variations
│   ├── icons.php                      # Icon usage
│   ├── labels.php                     # Label components
│   ├── messages.php                   # Messages and alerts
│   ├── headers.php                    # Header components
│   ├── images.php                     # Image variations
│   ├── inputs.php                     # Input fields
│   ├── segments.php                   # Content segments
│   └── dividers.php                   # Content dividers
│
├── 02-collections/                    # Component Collections
│   ├── forms.php                      # ✅ Complete form examples
│   ├── grids.php                      # Grid layouts
│   ├── menus.php                      # Navigation menus
│   ├── tables.php                     # Data tables
│   ├── breadcrumbs.php               # Breadcrumb navigation
│   └── messages.php                   # Message collections
│
├── 03-views/                          # View Components
│   ├── cards.php                      # Card layouts
│   ├── comments.php                   # Comment threads
│   ├── feeds.php                      # Activity feeds
│   ├── statistics.php                 # Statistic displays
│   ├── items.php                      # Item views
│   └── advertisements.php             # Ad placements
│
├── 04-modules/                        # Interactive Modules
│   ├── modals.php                     # ✅ Modal dialogs
│   ├── dropdowns.php                  # Dropdown menus
│   ├── accordions.php                 # Accordion panels
│   ├── tabs.php                       # Tab interfaces
│   ├── popups.php                     # Popup tooltips
│   ├── progress.php                   # Progress bars
│   ├── sliders.php                    # Range sliders
│   └── calendars.php                  # Date pickers
│
├── 05-advanced/                       # Advanced Techniques
│   ├── custom-components.php          # ✅ Creating custom components
│   ├── dynamic-forms.php              # Forms with dynamic fields
│   ├── ajax-integration.php           # AJAX data loading
│   ├── event-handling.php             # JavaScript events
│   ├── component-composition.php      # Composing components
│   ├── theming.php                    # Custom themes
│   └── validation.php                 # Form validation
│
├── 06-snippets/                       # MODX Integration
│   ├── snippet-examples.md            # ✅ MODX snippet patterns
│   ├── chunk-integration.php          # Using with chunks
│   ├── template-variables.php         # TV integration
│   ├── getresources.php              # pdoTools integration
│   └── formit-integration.php         # FormIt examples
│
└── 07-real-world/                     # Complete Applications
    ├── login-form.php                 # ✅ Authentication page
    ├── dashboard.php                  # ✅ Admin dashboard
    ├── product-catalog.php            # E-commerce catalog
    ├── contact-page.php               # Contact form
    ├── blog-listing.php               # Blog index
    ├── blog-post.php                  # Single blog post
    ├── user-profile.php               # User profile page
    └── checkout-flow.php              # Multi-step checkout
```

## 🎯 What's Included

### ✅ Completed Examples

1. **buttons.php** - Comprehensive button examples including:
   - Basic buttons with text and icons
   - All color variations
   - Size variations (mini to massive)
   - Button states (active, disabled, loading)
   - Variations (basic, inverted, compact, circular)
   - Animated buttons
   - Social buttons
   - Attached and floated buttons
   - Button groups
   - Interactive examples with data attributes

2. **forms.php** - Complete form examples:
   - Simple contact form
   - Registration form with validation
   - Search form
   - Login form with social options
   - Inline forms
   - Form validation states
   - Disabled and loading states
   - Dropdown integration
   - File upload forms

3. **modals.php** - Modal dialog examples:
   - Basic modals
   - Scrolling content modals
   - Full screen modals
   - Confirmation dialogs
   - Forms in modals
   - Sized modals
   - Image modals
   - Multiple modal stacking
   - Custom actions
   - Loading states
   - Inverted modals

4. **custom-components.php** - Advanced component creation:
   - AlertComponent (custom message component)
   - PriceCard (pricing card component)
   - Timeline (event timeline component)
   - Complete code examples
   - Helper method documentation

5. **login-form.php** - Production-ready login page:
   - Form validation
   - Error handling
   - Remember me functionality
   - Social login buttons
   - Responsive design
   - Demo credentials

6. **dashboard.php** - Complete admin dashboard:
   - Statistics cards
   - Charts (using Chart.js)
   - Data tables
   - Recent activity feed
   - Quick actions
   - Navigation menu

7. **snippet-examples.md** - MODX integration:
   - Simple button snippet
   - Contact form with email sending
   - Product grid with getResources
   - User profile display
   - Breadcrumb navigation
   - Statistics widget
   - Chunk-based templates

## 🚀 Quick Start

### Running Examples Locally

1. **Copy examples directory** to your MODX installation:
   ```bash
   cp -r examples/ /path/to/modx/core/components/themantic/
   ```

2. **Access via web browser**:
   ```
   http://yoursite.com/core/components/themantic/examples/
   ```

3. **Or create a MODX resource**:
   ```html
   [[!include? &file=`[[++core_path]]components/themantic/examples/index.php`]]
   ```

### Using in MODX Templates

```html
<!-- Include a specific example -->
[[!include? &file=`[[++core_path]]components/themantic/examples/01-basic/buttons.php`]]
```

### Creating MODX Snippets

Copy snippet code from `06-snippets/snippet-examples.md` and create new snippets in MODX Manager.

## 📖 Learning Path

1. **Start Here**: `index.php` - Browse all examples
2. **Basic Components**: `01-basic/` - Learn individual components
3. **Collections**: `02-collections/` - See components working together
4. **Interactive**: `04-modules/` - Add interactivity
5. **Advanced**: `05-advanced/` - Custom components and patterns
6. **MODX Integration**: `06-snippets/` - MODX-specific usage
7. **Real Applications**: `07-real-world/` - Complete working apps

## 💡 Tips

### For Developers

- Each example file is **self-contained** and can run independently
- All examples include **inline comments** explaining the code
- **View source** to see the generated HTML
- Examples use **real data** where possible for authenticity

### For MODX Users

- Examples can be **copied directly** into your MODX templates
- Snippet examples show **best practices** for MODX integration
- Check `06-snippets/` for **ready-to-use** MODX snippets
- Real-world examples demonstrate **production patterns**

### For Component Creators

- Study `05-advanced/custom-components.php` for **component creation**
- Use `BaseComponent` for **consistent behavior**
- Follow **naming conventions** in existing components
- Include **validation** and **error handling**

## 🎨 Customization

All examples use default Fomantic-UI themes. To customize:

1. **Override CSS** in your own stylesheet
2. **Modify component properties** to change colors/sizes
3. **Create custom components** following the patterns shown
4. **Use Fomantic-UI themes** for different styles

## 🔧 Development

### Adding New Examples

1. Create file in appropriate category directory
2. Follow the template structure:
   ```php
   <?php
   if (!isset($themantic)) {
       die('Themantic not initialized');
   }
   ?>
   <!DOCTYPE html>
   <html>
   <head>
       <title>Example Title</title>
   </head>
   <body>
       <div class="ui container">
           <!-- Your example code -->
       </div>
   </body>
   </html>
   ```
3. Add to `index.php` navigation
4. Update this README

### Testing Examples

- Test on **multiple browsers** (Chrome, Firefox, Safari)
- Check **mobile responsiveness**
- Validate **HTML/CSS**
- Test **JavaScript functionality**
- Verify **MODX integration**

## 📚 Additional Resources

- [Themantic Documentation](../IMPROVEMENTS.md)
- [Usage Guide](../USAGE_GUIDE.md)
- [Fomantic-UI Docs](https://fomantic-ui.com)
- [MODX Documentation](https://docs.modx.com)

## 🤝 Contributing

To contribute new examples:

1. Fork the repository
2. Create your example following existing patterns
3. Test thoroughly
4. Submit pull request with description

## 📝 License

These examples are part of the Themantic project and follow the same license.

## 🆘 Support

- Issues: GitHub Issues
- Questions: GitHub Discussions
- Documentation: README files in each directory

---

**Last Updated**: February 2024  
**Version**: 2.0  
**Maintainer**: Themantic Team

<?php
/**
 * MODX Snippet Integration Examples
 * 
 * Shows how to use Themantic components in MODX snippets
 */

?>
# MODX Snippet Examples

## Installation

1. Create snippets in MODX Manager
2. Copy the code from examples below
3. Call snippets in your templates

---

## Example 1: Simple Button Snippet

**Snippet Name:** `ThematicButton`

```php
<?php
/**
 * ThematicButton
 * 
 * Renders a Fomantic-UI button
 * 
 * Usage:
 * [[!ThematicButton? &text=`Click Me` &color=`blue` &icon=`download`]]
 */

$themantic = $modx->getPlaceholder('themantic');

if (!$themantic) {
    return 'Themantic not initialized';
}

return $themantic->render('button', $scriptProperties);
?>
```

**Template Usage:**
```html
[[!ThematicButton? 
    &text=`Download PDF`
    &color=`green`
    &icon=`file pdf`
    &href=`/assets/files/brochure.pdf`
    &tag=`a`
]]
```

---

## Example 2: Contact Form Snippet

**Snippet Name:** `ThematicContactForm`

```php
<?php
/**
 * ThematicContactForm
 * 
 * Renders a contact form with validation and email sending
 */

$themantic = $modx->getPlaceholder('themantic');
$output = '';
$success = '';
$error = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_submit'])) {
    $name = $modx->getOption('name', $_POST, '');
    $email = $modx->getOption('email', $_POST, '');
    $subject = $modx->getOption('subject', $_POST, '');
    $message = $modx->getOption('message', $_POST, '');
    
    // Validate
    if (empty($name) || empty($email) || empty($message)) {
        $error = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        // Send email
        $modx->getService('mail', 'mail.modPHPMailer');
        $modx->mail->set(modMail::MAIL_BODY, $message);
        $modx->mail->set(modMail::MAIL_FROM, $email);
        $modx->mail->set(modMail::MAIL_FROM_NAME, $name);
        $modx->mail->set(modMail::MAIL_SUBJECT, $subject);
        $modx->mail->address('to', $modx->getOption('emailsender'));
        
        if ($modx->mail->send()) {
            $success = 'Thank you! Your message has been sent.';
            $_POST = []; // Clear form
        } else {
            $error = 'Sorry, there was an error sending your message.';
        }
        
        $modx->mail->reset();
    }
}

// Show success message
if ($success) {
    $output .= $themantic->render('message', [
        'type' => 'success',
        'header' => 'Success!',
        'content' => $success,
        'icon' => 'check circle'
    ]);
}

// Show error message
if ($error) {
    $output .= $themantic->render('message', [
        'type' => 'error',
        'header' => 'Error',
        'content' => $error,
        'icon' => 'exclamation triangle'
    ]);
}

// Build form
$output .= '<form class="ui form" method="POST">';

$output .= '<div class="field">';
$output .= '<label>Name *</label>';
$output .= '<input type="text" name="name" value="' . htmlspecialchars($_POST['name'] ?? '') . '" required>';
$output .= '</div>';

$output .= '<div class="field">';
$output .= '<label>Email *</label>';
$output .= '<input type="email" name="email" value="' . htmlspecialchars($_POST['email'] ?? '') . '" required>';
$output .= '</div>';

$output .= '<div class="field">';
$output .= '<label>Subject</label>';
$output .= '<input type="text" name="subject" value="' . htmlspecialchars($_POST['subject'] ?? '') . '">';
$output .= '</div>';

$output .= '<div class="field">';
$output .= '<label>Message *</label>';
$output .= '<textarea name="message" rows="5" required>' . htmlspecialchars($_POST['message'] ?? '') . '</textarea>';
$output .= '</div>';

$output .= $themantic->render('button', [
    'text' => 'Send Message',
    'type' => 'submit',
    'name' => 'contact_submit',
    'color' => 'blue',
    'icon' => 'send'
]);

$output .= '</form>';

return $output;
?>
```

**Template Usage:**
```html
<div class="ui container">
    <h1>Contact Us</h1>
    [[!ThematicContactForm]]
</div>
```

---

## Example 3: Product Grid Snippet

**Snippet Name:** `ThematicProductGrid`

```php
<?php
/**
 * ThematicProductGrid
 * 
 * Displays products in a grid with cards
 * 
 * Properties:
 * &limit - Number of products to show (default: 12)
 * &category - Category ID to filter (optional)
 */

$themantic = $modx->getPlaceholder('themantic');
$limit = $modx->getOption('limit', $scriptProperties, 12);
$category = $modx->getOption('category', $scriptProperties, null);

// Get products (example using getResources)
$productIds = $modx->runSnippet('getResources', [
    'parents' => $category ?? 5, // Products parent ID
    'limit' => $limit,
    'returnIds' => true,
    'sortby' => 'menuindex',
    'sortdir' => 'ASC'
]);

if (empty($productIds)) {
    return '<p>No products found.</p>';
}

$products = explode(',', $productIds);
$output = '<div class="ui four column stackable grid">';

foreach ($products as $productId) {
    $product = $modx->getObject('modResource', $productId);
    
    if (!$product) continue;
    
    $output .= '<div class="column">';
    $output .= $themantic->render('card', [
        'image' => $product->getTVValue('product_image'),
        'header' => $product->get('pagetitle'),
        'description' => $product->getTVValue('product_description'),
        'meta' => '$' . $product->getTVValue('price'),
        'extra' => $themantic->render('button', [
            'text' => 'View Details',
            'color' => 'blue',
            'fluid' => true,
            'href' => $modx->makeUrl($productId),
            'tag' => 'a'
        ])
    ]);
    $output .= '</div>';
}

$output .= '</div>';

return $output;
?>
```

**Template Usage:**
```html
[[!ThematicProductGrid? &limit=`8` &category=`5`]]
```

---

## Example 4: User Profile Snippet

**Snippet Name:** `ThematicUserProfile`

```php
<?php
/**
 * ThematicUserProfile
 * 
 * Displays user profile with edit capability
 */

$themantic = $modx->getPlaceholder('themantic');

// Check if user is logged in
if (!$modx->user->isAuthenticated()) {
    return $themantic->render('message', [
        'type' => 'warning',
        'header' => 'Login Required',
        'content' => 'Please log in to view your profile.'
    ]);
}

$user = $modx->user;
$profile = $user->getOne('Profile');

$output = '<div class="ui grid">';

// Sidebar with avatar
$output .= '<div class="four wide column">';
$output .= '<div class="ui card">';
$output .= '<div class="image">';
$output .= '<img src="' . ($profile->get('photo') ?? '/assets/images/avatar-placeholder.png') . '">';
$output .= '</div>';
$output .= '<div class="content">';
$output .= '<div class="header">' . $user->get('username') . '</div>';
$output .= '<div class="meta">' . $profile->get('email') . '</div>';
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

// Main content
$output .= '<div class="twelve wide column">';
$output .= '<div class="ui segment">';
$output .= '<h2 class="ui header">Profile Information</h2>';

$output .= '<table class="ui definition table">';
$output .= '<tbody>';
$output .= '<tr><td>Full Name</td><td>' . $profile->get('fullname') . '</td></tr>';
$output .= '<tr><td>Email</td><td>' . $profile->get('email') . '</td></tr>';
$output .= '<tr><td>Phone</td><td>' . $profile->get('phone') . '</td></tr>';
$output .= '<tr><td>Member Since</td><td>' . date('F j, Y', $user->get('createdon')) . '</td></tr>';
$output .= '</tbody>';
$output .= '</table>';

$output .= $themantic->render('button', [
    'text' => 'Edit Profile',
    'color' => 'blue',
    'icon' => 'edit',
    'href' => $modx->makeUrl($modx->getOption('profile_edit_id')),
    'tag' => 'a'
]);

$output .= '</div>';
$output .= '</div>';

$output .= '</div>';

return $output;
?>
```

---

## Example 5: Breadcrumb Snippet

**Snippet Name:** `ThematicBreadcrumb`

```php
<?php
/**
 * ThematicBreadcrumb
 * 
 * Renders breadcrumb navigation
 */

$themantic = $modx->getPlaceholder('themantic');

// Get current resource
$resourceId = $modx->resource->get('id');

// Build breadcrumb trail
$trail = [];
$currentId = $resourceId;

while ($currentId > 0) {
    $resource = $modx->getObject('modResource', $currentId);
    
    if (!$resource) break;
    
    array_unshift($trail, [
        'text' => $resource->get('pagetitle'),
        'href' => $modx->makeUrl($currentId),
        'active' => ($currentId == $resourceId)
    ]);
    
    $currentId = $resource->get('parent');
}

// Add home
array_unshift($trail, [
    'text' => 'Home',
    'href' => $modx->makeUrl($modx->getOption('site_start')),
    'active' => false
]);

return $themantic->render('breadcrumb', [
    'items' => $trail
]);
?>
```

---

## Example 6: Statistics Widget

**Snippet Name:** `ThematicStats`

```php
<?php
/**
 * ThematicStats
 * 
 * Display statistics using Fomantic-UI statistics
 */

$themantic = $modx->getPlaceholder('themantic');

// Get statistics (example data)
$totalUsers = $modx->getCount('modUser');
$totalResources = $modx->getCount('modResource', ['deleted' => 0]);
$totalViews = 12547; // From analytics

$output = '<div class="ui three statistics">';

$output .= $themantic->render('statistic', [
    'value' => number_format($totalUsers),
    'label' => 'Users',
    'icon' => 'users',
    'color' => 'blue'
]);

$output .= $themantic->render('statistic', [
    'value' => number_format($totalResources),
    'label' => 'Pages',
    'icon' => 'file',
    'color' => 'green'
]);

$output .= $themantic->render('statistic', [
    'value' => number_format($totalViews),
    'label' => 'Views',
    'icon' => 'eye',
    'color' => 'orange'
]);

$output .= '</div>';

return $output;
?>
```

---

## Advanced: Chunk-based Templates

**Chunk Name:** `ProductCardTpl`

```html
<div class="ui card">
    <div class="image">
        <img src="[[+image]]">
    </div>
    <div class="content">
        <div class="header">[[+title]]</div>
        <div class="meta">[[+price]]</div>
        <div class="description">[[+description]]</div>
    </div>
    <div class="extra content">
        [[!ThematicButton? 
            &text=`Add to Cart`
            &color=`green`
            &icon=`shopping cart`
            &fluid=`1`
            &data-id=`[[+id]]`
            &onClick=`addToCart([[+id]])`
        ]]
    </div>
</div>
```

**Snippet using chunk:**

```php
<?php
$themantic = $modx->getPlaceholder('themantic');
$products = // ... get products

$output = '';
foreach ($products as $product) {
    $output .= $modx->getChunk('ProductCardTpl', [
        'id' => $product->id,
        'title' => $product->pagetitle,
        'image' => $product->getTVValue('image'),
        'price' => '$' . $product->getTVValue('price'),
        'description' => $product->getTVValue('description')
    ]);
}

return '<div class="ui four cards">' . $output . '</div>';
?>
```

---

## Tips for MODX Integration

1. **Always check if Themantic is initialized:**
   ```php
   $themantic = $modx->getPlaceholder('themantic');
   if (!$themantic) {
       return 'Themantic not initialized';
   }
   ```

2. **Use $scriptProperties for snippet parameters:**
   ```php
   $color = $modx->getOption('color', $scriptProperties, 'blue');
   ```

3. **Sanitize user input:**
   ```php
   $input = htmlspecialchars($_POST['field'] ?? '');
   ```

4. **Cache snippets when possible:**
   ```html
   [[ThematicButton]] <!-- Cached -->
   [[!ThematicButton]] <!-- Uncached -->
   ```

5. **Combine with getResources/pdoTools:**
   ```html
   [[!getResources? 
       &parents=`5`
       &tpl=`ProductCardTpl`
       &limit=`12`
   ]]
   ```

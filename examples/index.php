<?php
/**
 * Themantic Examples Index
 * 
 * Navigation page for all examples
 */

if (!isset($themantic)) {
    die('Themantic not initialized');
}

$examples = [
    '01-basic' => [
        'title' => 'Basic Components',
        'description' => 'Learn the fundamentals of Themantic components',
        'icon' => 'cube',
        'color' => 'blue',
        'items' => [
            ['file' => 'buttons.php', 'title' => 'Buttons', 'description' => 'Various button styles and states'],
            ['file' => 'icons.php', 'title' => 'Icons', 'description' => 'Icon usage and combinations'],
            ['file' => 'labels.php', 'title' => 'Labels', 'description' => 'Label variations and attachments'],
            ['file' => 'messages.php', 'title' => 'Messages', 'description' => 'Information, warning, and error messages'],
        ]
    ],
    '02-collections' => [
        'title' => 'Collections',
        'description' => 'Components that work together',
        'icon' => 'th',
        'color' => 'green',
        'items' => [
            ['file' => 'forms.php', 'title' => 'Forms', 'description' => 'Form inputs and validation'],
            ['file' => 'grids.php', 'title' => 'Grids', 'description' => 'Responsive grid layouts'],
            ['file' => 'menus.php', 'title' => 'Menus', 'description' => 'Navigation menus'],
            ['file' => 'tables.php', 'title' => 'Tables', 'description' => 'Data tables with sorting'],
        ]
    ],
    '03-views' => [
        'title' => 'Views',
        'description' => 'Content presentation components',
        'icon' => 'eye',
        'color' => 'violet',
        'items' => [
            ['file' => 'cards.php', 'title' => 'Cards', 'description' => 'Card layouts for content'],
            ['file' => 'comments.php', 'title' => 'Comments', 'description' => 'Comment threads'],
            ['file' => 'feeds.php', 'title' => 'Feeds', 'description' => 'Activity and news feeds'],
            ['file' => 'statistics.php', 'title' => 'Statistics', 'description' => 'Statistical displays'],
        ]
    ],
    '04-modules' => [
        'title' => 'Modules',
        'description' => 'Interactive JavaScript components',
        'icon' => 'puzzle piece',
        'color' => 'orange',
        'items' => [
            ['file' => 'modals.php', 'title' => 'Modals', 'description' => 'Dialog boxes and overlays'],
            ['file' => 'dropdowns.php', 'title' => 'Dropdowns', 'description' => 'Dropdown menus and selects'],
            ['file' => 'accordions.php', 'title' => 'Accordions', 'description' => 'Collapsible content'],
            ['file' => 'tabs.php', 'title' => 'Tabs', 'description' => 'Tabbed interfaces'],
        ]
    ],
    '05-advanced' => [
        'title' => 'Advanced',
        'description' => 'Advanced techniques and patterns',
        'icon' => 'graduation cap',
        'color' => 'red',
        'items' => [
            ['file' => 'custom-components.php', 'title' => 'Custom Components', 'description' => 'Create your own components'],
            ['file' => 'dynamic-forms.php', 'title' => 'Dynamic Forms', 'description' => 'Forms with dynamic fields'],
            ['file' => 'ajax-integration.php', 'title' => 'AJAX Integration', 'description' => 'Async data loading'],
            ['file' => 'event-handling.php', 'title' => 'Event Handling', 'description' => 'JavaScript events'],
        ]
    ],
    '06-snippets' => [
        'title' => 'MODX Snippets',
        'description' => 'Integration with MODX',
        'icon' => 'code',
        'color' => 'teal',
        'items' => [
            ['file' => 'snippet-examples.md', 'title' => 'Snippet Examples', 'description' => 'MODX snippet integration'],
            ['file' => 'chunk-integration.php', 'title' => 'Chunk Integration', 'description' => 'Using with MODX chunks'],
        ]
    ],
    '07-real-world' => [
        'title' => 'Real-World Examples',
        'description' => 'Complete working applications',
        'icon' => 'globe',
        'color' => 'purple',
        'items' => [
            ['file' => 'login-form.php', 'title' => 'Login Form', 'description' => 'Complete authentication page'],
            ['file' => 'dashboard.php', 'title' => 'Dashboard', 'description' => 'Admin dashboard example'],
            ['file' => 'product-catalog.php', 'title' => 'Product Catalog', 'description' => 'E-commerce product listing'],
            ['file' => 'contact-page.php', 'title' => 'Contact Page', 'description' => 'Contact form with map'],
        ]
    ],
];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Themantic Examples</title>
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2em 0;
        }
        .example-header {
            text-align: center;
            color: white;
            margin-bottom: 2em;
        }
        .example-header h1 {
            font-size: 3em;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        .example-header p {
            font-size: 1.2em;
            opacity: 0.9;
        }
        .category-card {
            background: white;
            border-radius: 8px;
            padding: 1.5em;
            margin-bottom: 2em;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        .category-header {
            display: flex;
            align-items: center;
            margin-bottom: 1em;
            padding-bottom: 1em;
            border-bottom: 2px solid #f0f0f0;
        }
        .category-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1em;
            font-size: 1.5em;
        }
        .example-item {
            padding: 1em;
            margin: 0.5em 0;
            background: #f9f9f9;
            border-radius: 4px;
            transition: all 0.2s;
            cursor: pointer;
        }
        .example-item:hover {
            background: #f0f0f0;
            transform: translateX(5px);
        }
        .example-item h4 {
            margin: 0 0 0.5em 0;
        }
        .example-item p {
            margin: 0;
            color: #666;
            font-size: 0.9em;
        }
        .stats-bar {
            background: white;
            padding: 2em;
            border-radius: 8px;
            margin-bottom: 2em;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <div class="ui container">
        
        <!-- Header -->
        <div class="example-header">
            <h1>
                <i class="rocket icon"></i>
                Themantic Examples
            </h1>
            <p>Interactive examples and tutorials for building with Themantic</p>
        </div>

        <!-- Statistics -->
        <div class="stats-bar">
            <div class="ui four statistics">
                <?php
                $totalExamples = 0;
                foreach ($examples as $category) {
                    $totalExamples += count($category['items']);
                }
                
                echo $themantic->render('statistic', [
                    'value' => count($examples),
                    'label' => 'Categories',
                    'color' => 'blue'
                ]);
                
                echo $themantic->render('statistic', [
                    'value' => $totalExamples,
                    'label' => 'Examples',
                    'color' => 'green'
                ]);
                
                echo $themantic->render('statistic', [
                    'value' => '100+',
                    'label' => 'Components',
                    'color' => 'violet'
                ]);
                
                echo $themantic->render('statistic', [
                    'value' => '∞',
                    'label' => 'Possibilities',
                    'color' => 'orange'
                ]);
                ?>
            </div>
        </div>

        <!-- Example Categories -->
        <?php foreach ($examples as $categoryId => $category): ?>
        <div class="category-card">
            <div class="category-header">
                <div class="category-icon ui <?php echo $category['color']; ?> circular label" style="width: 60px; height: 60px; font-size: 1.5em;">
                    <i class="<?php echo $category['icon']; ?> icon"></i>
                </div>
                <div>
                    <h2 class="ui header" style="margin: 0;">
                        <?php echo $category['title']; ?>
                        <div class="sub header"><?php echo $category['description']; ?></div>
                    </h2>
                </div>
            </div>

            <div class="ui two column stackable grid">
                <?php foreach ($category['items'] as $item): ?>
                <div class="column">
                    <a href="<?php echo $categoryId . '/' . $item['file']; ?>" style="color: inherit; text-decoration: none;">
                        <div class="example-item">
                            <h4>
                                <i class="file code icon"></i>
                                <?php echo $item['title']; ?>
                            </h4>
                            <p><?php echo $item['description']; ?></p>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>

        <!-- Getting Started -->
        <div class="ui segment" style="background: white; padding: 2em;">
            <h2 class="ui header">
                <i class="play circle icon"></i>
                Getting Started
            </h2>
            <p>Each example is self-contained and demonstrates specific features. Click on any example above to view the code and see it in action.</p>
            
            <h3 class="ui header">Quick Links</h3>
            <div class="ui list">
                <div class="item">
                    <i class="book icon"></i>
                    <div class="content">
                        <a href="../IMPROVEMENTS.md">Read the Documentation</a>
                    </div>
                </div>
                <div class="item">
                    <i class="github icon"></i>
                    <div class="content">
                        <a href="https://github.com/daemondevin/Themantic">View on GitHub</a>
                    </div>
                </div>
                <div class="item">
                    <i class="download icon"></i>
                    <div class="content">
                        <a href="https://fomantic-ui.com">Fomantic-UI Documentation</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div style="text-align: center; color: white; padding: 2em 0; margin-top: 2em;">
            <p>
                Built with <i class="heart icon"></i> using 
                <strong>Themantic</strong> and <strong>Fomantic-UI</strong>
            </p>
        </div>

    </div>
</body>
</html>

<?php
/**
 * Custom Components Examples
 * 
 * Demonstrates how to create and use custom components
 */

if (!isset($themantic)) {
    die('Themantic not initialized');
}

// ============================================================================
// EXAMPLE 1: Simple Alert Component
// ============================================================================

use Themantic\Components\BaseComponent;

class AlertComponent extends BaseComponent
{
    protected array $defaultProperties = [
        'type' => 'info',
        'dismissible' => false,
        'icon' => true,
    ];
    
    protected array $requiredProperties = ['message'];
    
    public function render(array $properties = []): string
    {
        $props = $this->mergeProperties($properties);
        
        if (!$this->validate($props)) {
            return '';
        }
        
        // Determine color and icon based on type
        $typeMap = [
            'success' => ['color' => 'green', 'icon' => 'check circle'],
            'error' => ['color' => 'red', 'icon' => 'times circle'],
            'warning' => ['color' => 'yellow', 'icon' => 'exclamation triangle'],
            'info' => ['color' => 'blue', 'icon' => 'info circle'],
        ];
        
        $type = $typeMap[$props['type']] ?? $typeMap['info'];
        
        $classes = $this->buildClasses('ui message', [
            'color' => $type['color'],
            'icon' => $props['icon'] ? 'icon' : '',
        ]);
        
        if ($props['dismissible']) {
            $classes .= ' dismissible';
        }
        
        $html = '<div class="' . $classes . '">';
        
        if ($props['dismissible']) {
            $html .= '<i class="close icon"></i>';
        }
        
        if ($props['icon']) {
            $html .= '<i class="' . $type['icon'] . ' icon"></i>';
        }
        
        $html .= '<div class="content">';
        
        if (!empty($props['title'])) {
            $html .= '<div class="header">' . $this->sanitize($props['title']) . '</div>';
        }
        
        $html .= '<p>' . $this->sanitize($props['message']) . '</p>';
        $html .= '</div></div>';
        
        return $html;
    }
    
    public function getName(): string
    {
        return 'alert';
    }
}

// ============================================================================
// EXAMPLE 2: Price Card Component
// ============================================================================

class PriceCard extends BaseComponent
{
    protected array $defaultProperties = [
        'currency' => '$',
        'period' => 'month',
        'featured' => false,
    ];
    
    protected array $requiredProperties = ['title', 'price'];
    
    public function render(array $properties = []): string
    {
        $props = $this->mergeProperties($properties);
        
        if (!$this->validate($props)) {
            return '';
        }
        
        $classes = 'ui card';
        if ($props['featured']) {
            $classes .= ' blue';
        }
        
        $features = $props['features'] ?? [];
        $featuresList = '';
        
        foreach ($features as $feature) {
            $icon = $feature['included'] ?? true ? 'check green' : 'times red';
            $featuresList .= '<div class="item">';
            $featuresList .= '<i class="' . $icon . ' icon"></i>';
            $featuresList .= $this->sanitize($feature['text'] ?? $feature);
            $featuresList .= '</div>';
        }
        
        $buttonText = $props['buttonText'] ?? 'Choose Plan';
        $buttonColor = $props['featured'] ? 'blue' : 'grey';
        
        return <<<HTML
        <div class="{$classes}">
            <div class="content">
                {$this->renderHeader($props)}
                {$this->renderPrice($props)}
                {$this->renderDescription($props)}
            </div>
            {$this->renderFeatures($featuresList)}
            <div class="extra content">
                {$this->renderButton($buttonText, $buttonColor)}
            </div>
        </div>
HTML;
    }
    
    protected function renderHeader(array $props): string
    {
        $html = '<div class="header" style="text-align: center;">';
        $html .= $this->sanitize($props['title']);
        $html .= '</div>';
        return $html;
    }
    
    protected function renderPrice(array $props): string
    {
        $html = '<div class="meta" style="text-align: center; font-size: 2em; margin: 1em 0;">';
        $html .= '<strong>';
        $html .= $this->sanitize($props['currency']);
        $html .= $this->sanitize($props['price']);
        $html .= '</strong>';
        $html .= '<span style="font-size: 0.5em; color: grey;">/' . $this->sanitize($props['period']) . '</span>';
        $html .= '</div>';
        return $html;
    }
    
    protected function renderDescription(array $props): string
    {
        if (empty($props['description'])) {
            return '';
        }
        return '<div class="description" style="text-align: center;">' . 
               $this->sanitize($props['description']) . 
               '</div>';
    }
    
    protected function renderFeatures(string $featuresList): string
    {
        if (empty($featuresList)) {
            return '';
        }
        return '<div class="content"><div class="ui list">' . $featuresList . '</div></div>';
    }
    
    protected function renderButton(string $text, string $color): string
    {
        return $this->themantic->render('button', [
            'text' => $text,
            'color' => $color,
            'fluid' => true,
        ]);
    }
    
    public function getName(): string
    {
        return 'pricecard';
    }
}

// ============================================================================
// EXAMPLE 3: Timeline Component
// ============================================================================

class Timeline extends BaseComponent
{
    protected array $requiredProperties = ['events'];
    
    public function render(array $properties = []): string
    {
        $props = $this->mergeProperties($properties);
        
        if (!$this->validate($props)) {
            return '';
        }
        
        $events = $props['events'];
        $html = '<div class="ui timeline">';
        
        foreach ($events as $index => $event) {
            $html .= $this->renderEvent($event, $index);
        }
        
        $html .= '</div>';
        
        // Add custom CSS for timeline
        $html .= $this->getTimelineCSS();
        
        return $html;
    }
    
    protected function renderEvent(array $event, int $index): string
    {
        $icon = $event['icon'] ?? 'circle';
        $color = $event['color'] ?? 'blue';
        $title = $this->sanitize($event['title'] ?? '');
        $date = $this->sanitize($event['date'] ?? '');
        $content = $this->sanitize($event['content'] ?? '');
        
        return <<<HTML
        <div class="event">
            <div class="dot">
                <i class="{$icon} {$color} icon"></i>
            </div>
            <div class="content">
                <div class="ui small header">{$title}</div>
                <div class="date">{$date}</div>
                <p>{$content}</p>
            </div>
        </div>
HTML;
    }
    
    protected function getTimelineCSS(): string
    {
        return <<<CSS
        <style>
        .ui.timeline {
            position: relative;
            padding: 2em 0;
        }
        .ui.timeline:before {
            content: '';
            position: absolute;
            left: 20px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e0e0e0;
        }
        .ui.timeline .event {
            position: relative;
            padding: 1em 0 1em 4em;
        }
        .ui.timeline .event .dot {
            position: absolute;
            left: 8px;
            top: 1.5em;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: white;
            border: 2px solid #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .ui.timeline .event .dot i {
            font-size: 0.8em;
        }
        .ui.timeline .event .date {
            color: grey;
            font-size: 0.9em;
            margin: 0.25em 0;
        }
        </style>
CSS;
    }
    
    public function getName(): string
    {
        return 'timeline';
    }
}

// Register custom components
$themantic->registerComponent('alert', AlertComponent::class);
$themantic->registerComponent('pricecard', PriceCard::class);
$themantic->registerComponent('timeline', Timeline::class);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Custom Components - Themantic</title>
</head>
<body>
    <div class="ui container" style="margin-top: 2em;">
        
        <h1 class="ui header">Custom Components Examples</h1>
        <div class="ui divider"></div>

        <!-- Alert Component Examples -->
        <h2 class="ui header">Custom Alert Component</h2>
        <div class="ui segment">
            <?php
            echo $themantic->render('alert', [
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Your changes have been saved.',
                'dismissible' => true
            ]);
            
            echo $themantic->render('alert', [
                'type' => 'error',
                'message' => 'An error occurred while processing your request.'
            ]);
            
            echo $themantic->render('alert', [
                'type' => 'warning',
                'title' => 'Warning',
                'message' => 'This action cannot be undone.'
            ]);
            
            echo $themantic->render('alert', [
                'type' => 'info',
                'message' => 'New features are now available.',
                'icon' => false
            ]);
            ?>
        </div>

        <!-- Price Card Examples -->
        <h2 class="ui header">Custom Price Card Component</h2>
        <div class="ui segment">
            <div class="ui three cards">
                <?php
                echo $themantic->render('pricecard', [
                    'title' => 'Basic',
                    'price' => '9',
                    'description' => 'For individuals',
                    'features' => [
                        '10 GB Storage',
                        '2 Users',
                        'Email Support',
                        ['text' => 'Advanced Features', 'included' => false]
                    ],
                    'buttonText' => 'Start Free Trial'
                ]);
                
                echo $themantic->render('pricecard', [
                    'title' => 'Professional',
                    'price' => '29',
                    'description' => 'For small teams',
                    'featured' => true,
                    'features' => [
                        '100 GB Storage',
                        '10 Users',
                        'Priority Support',
                        'Advanced Features'
                    ],
                    'buttonText' => 'Get Started'
                ]);
                
                echo $themantic->render('pricecard', [
                    'title' => 'Enterprise',
                    'price' => '99',
                    'description' => 'For large organizations',
                    'features' => [
                        'Unlimited Storage',
                        'Unlimited Users',
                        '24/7 Support',
                        'All Features',
                        'Custom Integration'
                    ],
                    'buttonText' => 'Contact Sales'
                ]);
                ?>
            </div>
        </div>

        <!-- Timeline Example -->
        <h2 class="ui header">Custom Timeline Component</h2>
        <div class="ui segment">
            <?php
            echo $themantic->render('timeline', [
                'events' => [
                    [
                        'title' => 'Project Started',
                        'date' => 'January 1, 2024',
                        'content' => 'Initial project kickoff and planning phase.',
                        'icon' => 'flag',
                        'color' => 'green'
                    ],
                    [
                        'title' => 'Design Phase',
                        'date' => 'January 15, 2024',
                        'content' => 'UI/UX design and wireframing completed.',
                        'icon' => 'paint brush',
                        'color' => 'blue'
                    ],
                    [
                        'title' => 'Development',
                        'date' => 'February 1, 2024',
                        'content' => 'Core development and feature implementation.',
                        'icon' => 'code',
                        'color' => 'orange'
                    ],
                    [
                        'title' => 'Testing',
                        'date' => 'February 20, 2024',
                        'content' => 'Quality assurance and bug fixes.',
                        'icon' => 'bug',
                        'color' => 'red'
                    ],
                    [
                        'title' => 'Launch',
                        'date' => 'March 1, 2024',
                        'content' => 'Product successfully launched to production.',
                        'icon' => 'rocket',
                        'color' => 'purple'
                    ]
                ]
            ]);
            ?>
        </div>

        <!-- Code Examples -->
        <h2 class="ui header">How to Create Custom Components</h2>
        <div class="ui segment">
            <h3>1. Create Component Class</h3>
            <pre class="ui segment"><code><?php echo htmlspecialchars('
class MyComponent extends BaseComponent
{
    protected array $defaultProperties = [
        \'color\' => \'blue\',
    ];
    
    protected array $requiredProperties = [\'title\'];
    
    public function render(array $properties = []): string
    {
        $props = $this->mergeProperties($properties);
        
        if (!$this->validate($props)) {
            return \'\';
        }
        
        // Build your component HTML
        return \'<div>...</div>\';
    }
    
    public function getName(): string
    {
        return \'mycomponent\';
    }
}
'); ?></code></pre>

            <h3>2. Register Component</h3>
            <pre class="ui segment"><code><?php echo htmlspecialchars('
$themantic->registerComponent(\'mycomponent\', MyComponent::class);
'); ?></code></pre>

            <h3>3. Use Component</h3>
            <pre class="ui segment"><code><?php echo htmlspecialchars('
echo $themantic->render(\'mycomponent\', [
    \'title\' => \'Hello World\'
]);
'); ?></code></pre>
        </div>

        <!-- Helper Methods Available -->
        <h2 class="ui header">Available Helper Methods</h2>
        <div class="ui segment">
            <div class="ui list">
                <div class="item">
                    <i class="check icon"></i>
                    <div class="content">
                        <code>$this->mergeProperties($properties)</code> - Merge with defaults
                    </div>
                </div>
                <div class="item">
                    <i class="check icon"></i>
                    <div class="content">
                        <code>$this->validate($properties)</code> - Validate required properties
                    </div>
                </div>
                <div class="item">
                    <i class="check icon"></i>
                    <div class="content">
                        <code>$this->sanitize($html)</code> - Escape HTML
                    </div>
                </div>
                <div class="item">
                    <i class="check icon"></i>
                    <div class="content">
                        <code>$this->buildClasses($base, $props)</code> - Build CSS classes
                    </div>
                </div>
                <div class="item">
                    <i class="check icon"></i>
                    <div class="content">
                        <code>$this->buildHtmlAttributes($attrs)</code> - Build HTML attributes
                    </div>
                </div>
                <div class="item">
                    <i class="check icon"></i>
                    <div class="content">
                        <code>$this->parseContent($content)</code> - Parse MODX tags
                    </div>
                </div>
                <div class="item">
                    <i class="check icon"></i>
                    <div class="content">
                        <code>$this->themantic->render($name, $props)</code> - Render other components
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
    // Enable dismissible alerts
    $('.message .close').on('click', function() {
        $(this).closest('.message').transition('fade');
    });
    </script>
</body>
</html>

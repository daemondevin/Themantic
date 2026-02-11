<?php

namespace Themantic\Components;

use Themantic\Components\BaseComponent;

/**
 * Button Component
 * 
 * Renders a Fomantic-UI button with full support for all variations
 * 
 * @example
 * $button = $themantic->render('button', [
 *     'text' => 'Click Me',
 *     'color' => 'blue',
 *     'size' => 'large',
 *     'icon' => 'download',
 * ]);
 */
class Button extends BaseComponent {
    /**
     * Default properties
     */
    protected array $defaultProperties = [
        'type' => 'button',
        'tag' => 'button',
        'fluid' => false,
        'basic' => false,
        'inverted' => false,
        'compact' => false,
        'circular' => false,
        'loading' => false,
        'disabled' => false,
        'animated' => false,
    ];

    /**
     * Required properties
     */
    protected array $requiredProperties = []; // Text or icon is required, checked in validate()

    /**
     * Validate button properties
     */
    public function validate(array $properties = []): bool {
        // Either text or icon must be provided
        if (empty($properties['text']) && empty($properties['icon'])) {
            $this->logError('Button requires either "text" or "icon" property');
            return false;
        }

        return parent::validate($properties);
    }

    /**
     * Render the button
     */
    public function render(array $properties = []): string {
        // Merge with defaults
        $props = $this->mergeProperties($properties);

        // Validate
        if (!$this->validate($props)) {
            return $this->renderError('Invalid button configuration');
        }

        // Build classes
        $classes = $this->buildButtonClasses($props);

        // Build attributes
        $attributes = $this->buildButtonAttributes($props);

        // Build content
        $content = $this->buildButtonContent($props);

        // Get tag
        $tag = $this->prop($props, 'tag', 'button');

        // Render
        return $this->renderElement($tag, $classes, $content, $attributes);
    }

    /**
     * Build button classes
     */
    protected function buildButtonClasses(array $props): string {
        $classes = [];

        // Size
        if ($size = $this->getSizeClass($props['size'] ?? null)) {
            $classes[] = $size;
        }

        // Color
        if ($color = $this->getColorClass($props['color'] ?? null)) {
            $classes[] = $color;
        }

        // Base class
        $classes[] = 'ui';

        // Icon position (left/right)
        if (!empty($props['icon']) && !empty($props['text'])) {
            if (!empty($props['iconPosition']) && $props['iconPosition'] === 'right') {
                $classes[] = 'right labeled icon';
            } elseif (!empty($props['iconPosition']) && $props['iconPosition'] === 'left') {
                $classes[] = 'left labeled icon';
            } else {
                $classes[] = 'labeled icon';
            }
        } elseif (!empty($props['icon'])) {
            $classes[] = 'icon';
        }

        // Button class
        $classes[] = 'button';

        // Build with standard modifiers
        return $this->buildClasses(
            implode(' ', $classes),
            $props,
            ['attached', 'floated']
        );
    }

    /**
     * Build button attributes
     */
    protected function buildButtonAttributes(array $props): array {
        $attributes = [];

        // ID
        if (!empty($props['id'])) {
            $attributes['id'] = $props['id'];
        }

        // Name
        if (!empty($props['name'])) {
            $attributes['name'] = $props['name'];
        }

        // Type (for <button> tags)
        if ($props['tag'] === 'button') {
            $attributes['type'] = $props['type'] ?? 'button';
        }

        // Value
        if (!empty($props['value'])) {
            $attributes['value'] = $props['value'];
        }

        // Href (for <a> tags)
        if ($props['tag'] === 'a' && !empty($props['href'])) {
            $attributes['href'] = $props['href'];
        }

        // Target
        if (!empty($props['target'])) {
            $attributes['target'] = $props['target'];
        }

        // Disabled
        if (!empty($props['disabled'])) {
            $attributes['disabled'] = true;
        }

        // Tabindex
        if (isset($props['tabindex'])) {
            $attributes['tabindex'] = (int)$props['tabindex'];
        }

        // Data attributes
        if ($dataAttrs = $this->extractDataAttributes($props)) {
            foreach ($dataAttrs as $key => $value) {
                $attributes['data-' . $key] = $value;
            }
        }

        // ARIA attributes
        if ($ariaAttrs = $this->extractAriaAttributes($props)) {
            foreach ($ariaAttrs as $key => $value) {
                $attributes['aria-' . $key] = $value;
            }
        }

        // Click handler
        if (!empty($props['onClick'])) {
            $attributes['onclick'] = $props['onClick'];
        }

        return $attributes;
    }

    /**
     * Build button content
     */
    protected function buildButtonContent(array $props): string {
        $content = [];

        // Icon
        if (!empty($props['icon'])) {
            $content[] = $this->renderIcon($props['icon']);
        }

        // Text
        if (!empty($props['text'])) {
            $text = $this->parseContent($props['text'], $props);
            $content[] = $this->sanitize($text);
        }

        // Animated content
        if (!empty($props['animated'])) {
            return $this->renderAnimatedContent($props, $content);
        }

        return implode('', $content);
    }

    /**
     * Render icon
     */
    protected function renderIcon(string $icon): string {
        return sprintf('<i class="%s icon"></i>', $this->sanitize($icon));
    }

    /**
     * Render animated button content
     */
    protected function renderAnimatedContent(array $props, array $content): string {
        $visible = implode('', $content);
        $hidden = !empty($props['animatedText']) 
            ? $this->sanitize($props['animatedText']) 
            : '';

        return sprintf(
            '<div class="visible content">%s</div><div class="hidden content">%s</div>',
            $visible,
            $hidden
        );
    }

    /**
     * Render the element
     */
    protected function renderElement(string $tag, string $classes, string $content, array $attributes): string {
        $attrString = $this->buildHtmlAttributes($attributes);
        
        return sprintf(
            '<%s class="%s"%s>%s</%s>',
            $tag,
            $classes,
            $attrString ? ' ' . $attrString : '',
            $content,
            $tag
        );
    }

    /**
     * Render error message (for debug mode)
     */
    protected function renderError(string $message): string {
        if (!$this->isDebug()) {
            return '';
        }

        return sprintf(
            '<!-- Button Error: %s -->',
            $this->sanitize($message)
        );
    }

    /**
     * Get component name
     */
    public function getName(): string {
        return 'button';
    }
}
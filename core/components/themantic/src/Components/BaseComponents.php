<?php

namespace Themantic\Components;

use Themantic\ComponentInterface;
use Themantic\Themantic;
use Themantic\Traits\ClassBuilder;
use Themantic\Traits\AttributeBuilder;

/**
 * Base Component
 * 
 * Abstract base class for all Themantic components
 */
abstract class BaseComponent implements ComponentInterface {
    use ClassBuilder, AttributeBuilder;

    protected Themantic $themantic;
    protected array $properties = [];
    protected array $defaultProperties = [];
    protected array $requiredProperties = [];

    public function __construct(Themantic $themantic) {
        $this->themantic = $themantic;
    }

    /**
     * Render the component
     */
    abstract public function render(array $properties = []): string;

    /**
     * Get component name
     */
    public function getName(): string {
        $class = get_class($this);
        return strtolower(basename(str_replace('\\', '/', $class)));
    }

    /**
     * Validate properties
     */
    public function validate(array $properties = []): bool {
        foreach ($this->requiredProperties as $required) {
            if (!isset($properties[$required]) || $properties[$required] === '') {
                $this->themantic->logError(
                    get_class($this) . '::validate',
                    "Missing required property: {$required}",
                    Themantic::ERR_METHOD
                );
                return false;
            }
        }

        return true;
    }

    /**
     * Merge properties with defaults
     */
    protected function mergeProperties(array $properties): array {
        return array_merge($this->defaultProperties, $properties);
    }

    /**
     * Get property value with default
     */
    protected function prop(array $properties, string $key, $default = null) {
        return $properties[$key] ?? $this->defaultProperties[$key] ?? $default;
    }

    /**
     * Check if property exists and is truthy
     */
    protected function hasProp(array $properties, string $key): bool {
        return !empty($properties[$key]);
    }

    /**
     * Parse content (process MODX tags)
     */
    protected function parseContent(string $content, array $properties = []): string {
        return $this->themantic->parseContent($content, $properties);
    }

    /**
     * Sanitize HTML
     */
    protected function sanitize(string $html): string {
        return htmlspecialchars($html, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Build data attributes
     */
    protected function buildDataAttributes(array $properties, array $dataKeys = []): string {
        $attributes = [];

        foreach ($dataKeys as $key) {
            if (isset($properties[$key])) {
                $dataKey = 'data-' . str_replace('_', '-', $key);
                $attributes[] = $dataKey . '="' . $this->sanitize($properties[$key]) . '"';
            }
        }

        return implode(' ', $attributes);
    }

    /**
     * Build ARIA attributes
     */
    protected function buildAriaAttributes(array $properties): string {
        $attributes = [];

        foreach ($properties as $key => $value) {
            if (str_starts_with($key, 'aria-') || str_starts_with($key, 'aria_')) {
                $ariaKey = str_replace('_', '-', $key);
                $attributes[] = $ariaKey . '="' . $this->sanitize($value) . '"';
            }
        }

        return implode(' ', $attributes);
    }

    /**
     * Render template
     */
    protected function renderTemplate(string $template, array $data = []): string {
        // Simple template rendering - replace {{key}} with values
        foreach ($data as $key => $value) {
            $template = str_replace('{{' . $key . '}}', (string)$value, $template);
        }

        // Remove any unreplaced placeholders
        $template = preg_replace('/\{\{[^}]+\}\}/', '', $template);

        return $template;
    }

    /**
     * Get chunk
     */
    protected function getChunk(string $name, array $properties = []): string {
        return $this->themantic->getChunk($name, $properties);
    }

    /**
     * Log error
     */
    protected function logError(string $message, string $type = Themantic::ERR_METHOD): void {
        $this->themantic->logError(get_class($this), $message, $type);
    }

    /**
     * Get Themantic instance
     */
    protected function getThemantic(): Themantic {
        return $this->themantic;
    }

    /**
     * Wrap content in component element
     */
    protected function wrap(string $content, string $tag, string $classes, array $attributes = []): string {
        $attrs = $this->buildAttributes($attributes);
        $attrs = $attrs ? ' ' . $attrs : '';
        
        return "<{$tag} class=\"{$classes}\"{$attrs}>{$content}</{$tag}>";
    }

    /**
     * Build HTML attributes string
     */
    protected function buildAttributes(array $attributes): string {
        $parts = [];

        foreach ($attributes as $key => $value) {
            if (is_bool($value)) {
                if ($value) {
                    $parts[] = $this->sanitize($key);
                }
            } elseif ($value !== null && $value !== '') {
                $parts[] = $this->sanitize($key) . '="' . $this->sanitize($value) . '"';
            }
        }

        return implode(' ', $parts);
    }

    /**
     * Check if in debug mode
     */
    protected function isDebug(): bool {
        return (bool)$this->themantic->getOption('debug_mode', false);
    }
}
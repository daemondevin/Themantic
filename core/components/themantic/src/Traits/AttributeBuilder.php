<?php

namespace Themantic\Traits;

/**
 * Attribute Builder Trait
 * 
 * Provides methods for building HTML attributes
 */
trait AttributeBuilder {
    /**
     * Build HTML attributes from array
     *
     * @param array $attributes Associative array of attributes
     * @param array $exclude Keys to exclude
     * @return string HTML attribute string
     */
    protected function buildHtmlAttributes(array $attributes, array $exclude = []): string {
        $parts = [];

        foreach ($attributes as $key => $value) {
            // Skip excluded keys
            if (in_array($key, $exclude, true)) {
                continue;
            }

            // Skip null or empty string values (but allow 0 and false)
            if ($value === null || $value === '') {
                continue;
            }

            // Handle boolean attributes
            if (is_bool($value)) {
                if ($value) {
                    $parts[] = $this->escapeAttribute($key);
                }
                continue;
            }

            // Regular attribute
            $parts[] = sprintf(
                '%s="%s"',
                $this->escapeAttribute($key),
                $this->escapeAttribute($value)
            );
        }

        return implode(' ', $parts);
    }

    /**
     * Build data-* attributes
     *
     * @param array $data Data attributes without 'data-' prefix
     * @return string HTML data attribute string
     */
    protected function buildDataAttributes(array $data): string {
        $attributes = [];

        foreach ($data as $key => $value) {
            // Convert underscores to hyphens
            $key = str_replace('_', '-', $key);
            
            // Add data- prefix if not present
            if (!str_starts_with($key, 'data-')) {
                $key = 'data-' . $key;
            }

            // Handle arrays and objects as JSON
            if (is_array($value) || is_object($value)) {
                $value = json_encode($value);
            }

            $attributes[$key] = $value;
        }

        return $this->buildHtmlAttributes($attributes);
    }

    /**
     * Build ARIA attributes
     *
     * @param array $aria ARIA attributes without 'aria-' prefix
     * @return string HTML ARIA attribute string
     */
    protected function buildAriaAttributes(array $aria): string {
        $attributes = [];

        foreach ($aria as $key => $value) {
            // Convert underscores to hyphens
            $key = str_replace('_', '-', $key);
            
            // Add aria- prefix if not present
            if (!str_starts_with($key, 'aria-')) {
                $key = 'aria-' . $key;
            }

            // Boolean ARIA attributes
            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }

            $attributes[$key] = $value;
        }

        return $this->buildHtmlAttributes($attributes);
    }

    /**
     * Extract data attributes from properties
     *
     * @param array $properties All properties
     * @return array Data attributes
     */
    protected function extractDataAttributes(array $properties): array {
        $data = [];

        foreach ($properties as $key => $value) {
            if (str_starts_with($key, 'data-') || str_starts_with($key, 'data_')) {
                $key = str_replace(['data-', 'data_'], '', $key);
                $data[$key] = $value;
            }
        }

        return $data;
    }

    /**
     * Extract ARIA attributes from properties
     *
     * @param array $properties All properties
     * @return array ARIA attributes
     */
    protected function extractAriaAttributes(array $properties): array {
        $aria = [];

        foreach ($properties as $key => $value) {
            if (str_starts_with($key, 'aria-') || str_starts_with($key, 'aria_')) {
                $key = str_replace(['aria-', 'aria_'], '', $key);
                $aria[$key] = $value;
            }
        }

        return $aria;
    }

    /**
     * Build ID attribute
     */
    protected function buildIdAttribute(?string $id): string {
        return $id ? sprintf('id="%s"', $this->escapeAttribute($id)) : '';
    }

    /**
     * Build name attribute
     */
    protected function buildNameAttribute(?string $name): string {
        return $name ? sprintf('name="%s"', $this->escapeAttribute($name)) : '';
    }

    /**
     * Build value attribute
     */
    protected function buildValueAttribute($value): string {
        if ($value === null || $value === '') {
            return '';
        }

        return sprintf('value="%s"', $this->escapeAttribute($value));
    }

    /**
     * Build placeholder attribute
     */
    protected function buildPlaceholderAttribute(?string $placeholder): string {
        return $placeholder ? sprintf('placeholder="%s"', $this->escapeAttribute($placeholder)) : '';
    }

    /**
     * Build title attribute
     */
    protected function buildTitleAttribute(?string $title): string {
        return $title ? sprintf('title="%s"', $this->escapeAttribute($title)) : '';
    }

    /**
     * Build href attribute
     */
    protected function buildHrefAttribute(?string $href): string {
        return $href ? sprintf('href="%s"', $this->escapeAttribute($href)) : '';
    }

    /**
     * Build src attribute
     */
    protected function buildSrcAttribute(?string $src): string {
        return $src ? sprintf('src="%s"', $this->escapeAttribute($src)) : '';
    }

    /**
     * Build alt attribute
     */
    protected function buildAltAttribute(?string $alt): string {
        return $alt ? sprintf('alt="%s"', $this->escapeAttribute($alt)) : '';
    }

    /**
     * Build target attribute
     */
    protected function buildTargetAttribute(?string $target): string {
        $validTargets = ['_blank', '_self', '_parent', '_top'];
        
        if ($target && in_array($target, $validTargets, true)) {
            return sprintf('target="%s"', $target);
        }

        return '';
    }

    /**
     * Build rel attribute
     */
    protected function buildRelAttribute(?string $rel): string {
        return $rel ? sprintf('rel="%s"', $this->escapeAttribute($rel)) : '';
    }

    /**
     * Build type attribute
     */
    protected function buildTypeAttribute(?string $type): string {
        return $type ? sprintf('type="%s"', $this->escapeAttribute($type)) : '';
    }

    /**
     * Build disabled attribute
     */
    protected function buildDisabledAttribute(bool $disabled): string {
        return $disabled ? 'disabled' : '';
    }

    /**
     * Build required attribute
     */
    protected function buildRequiredAttribute(bool $required): string {
        return $required ? 'required' : '';
    }

    /**
     * Build readonly attribute
     */
    protected function buildReadonlyAttribute(bool $readonly): string {
        return $readonly ? 'readonly' : '';
    }

    /**
     * Build checked attribute
     */
    protected function buildCheckedAttribute(bool $checked): string {
        return $checked ? 'checked' : '';
    }

    /**
     * Build selected attribute
     */
    protected function buildSelectedAttribute(bool $selected): string {
        return $selected ? 'selected' : '';
    }

    /**
     * Build tabindex attribute
     */
    protected function buildTabindexAttribute(?int $tabindex): string {
        return $tabindex !== null ? sprintf('tabindex="%d"', $tabindex) : '';
    }

    /**
     * Build role attribute
     */
    protected function buildRoleAttribute(?string $role): string {
        return $role ? sprintf('role="%s"', $this->escapeAttribute($role)) : '';
    }

    /**
     * Combine multiple attribute strings
     */
    protected function combineAttributes(...$parts): string {
        $attributes = array_filter($parts, fn($part) => $part !== '');
        
        return implode(' ', $attributes);
    }

    /**
     * Escape attribute value
     */
    protected function escapeAttribute($value): string {
        if (is_numeric($value)) {
            return (string)$value;
        }

        if (!is_string($value)) {
            $value = (string)$value;
        }

        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Build style attribute from array
     */
    protected function buildStyleAttribute(array $styles): string {
        if (empty($styles)) {
            return '';
        }

        $parts = [];

        foreach ($styles as $property => $value) {
            if ($value !== null && $value !== '') {
                $parts[] = sprintf('%s: %s', $property, $value);
            }
        }

        if (empty($parts)) {
            return '';
        }

        return sprintf('style="%s"', $this->escapeAttribute(implode('; ', $parts)));
    }
}
<?php

namespace Themantic\Traits;

/**
 * Class Builder Trait
 * 
 * Provides methods for building CSS class strings for Fomantic-UI components
 */
trait ClassBuilder {
    /**
     * Build CSS classes from base and properties
     *
     * @param string $base Base class (e.g., 'ui button')
     * @param array $properties Component properties
     * @param array $modifiers Keys to check for modifiers (size, color, etc.)
     * @return string Complete class string
     */
    protected function buildClasses(string $base, array $properties = [], array $modifiers = []): string {
        $classes = [];

        // Add size modifier
        if (!empty($properties['size'])) {
            $classes[] = $properties['size'];
        }

        // Add color modifier
        if (!empty($properties['color'])) {
            $classes[] = $properties['color'];
        }

        // Add custom modifiers
        foreach ($modifiers as $key) {
            if (!empty($properties[$key])) {
                $classes[] = $properties[$key];
            }
        }

        // Add base class
        $classes[] = $base;

        // Add variations
        if (!empty($properties['variation'])) {
            $variations = $this->parseMultiValue($properties['variation']);
            $classes = array_merge($classes, $variations);
        }

        // Add states
        if (!empty($properties['state'])) {
            $states = $this->parseMultiValue($properties['state']);
            $classes = array_merge($classes, $states);
        }

        // Boolean flags
        $flags = [
            'disabled', 'loading', 'active', 'fluid', 'compact',
            'basic', 'inverted', 'circular', 'labeled', 'icon',
            'attached', 'floated', 'fitted', 'hidden', 'visible'
        ];

        foreach ($flags as $flag) {
            if (!empty($properties[$flag]) && $this->isTrue($properties[$flag])) {
                $classes[] = $flag;
            }
        }

        // Add custom classes
        if (!empty($properties['class'])) {
            $classes[] = $properties['class'];
        }

        // Remove empty values and duplicates
        $classes = array_filter($classes);
        $classes = array_unique($classes);

        return implode(' ', $classes);
    }

    /**
     * Parse comma or space-separated values
     */
    protected function parseMultiValue($value): array {
        if (is_array($value)) {
            return $value;
        }

        if (!is_string($value)) {
            return [];
        }

        // Split by comma or space
        $values = preg_split('/[,\s]+/', $value, -1, PREG_SPLIT_NO_EMPTY);
        
        return array_map('trim', $values);
    }

    /**
     * Check if value is truthy
     */
    protected function isTrue($value): bool {
        if (is_bool($value)) {
            return $value;
        }

        if (is_string($value)) {
            $value = strtolower($value);
            return in_array($value, ['1', 'true', 'yes', 'on'], true);
        }

        return (bool)$value;
    }

    /**
     * Build Fomantic size class
     */
    protected function getSizeClass(?string $size): string {
        if (empty($size)) {
            return '';
        }

        $validSizes = [
            'mini', 'tiny', 'small', 'medium', 'large',
            'big', 'huge', 'massive'
        ];

        return in_array($size, $validSizes, true) ? $size : '';
    }

    /**
     * Build Fomantic color class
     */
    protected function getColorClass(?string $color): string {
        if (empty($color)) {
            return '';
        }

        $validColors = [
            'red', 'orange', 'yellow', 'olive', 'green',
            'teal', 'blue', 'violet', 'purple', 'pink',
            'brown', 'grey', 'black'
        ];

        return in_array($color, $validColors, true) ? $color : '';
    }

    /**
     * Build attachment class
     */
    protected function getAttachedClass(?string $attached): string {
        if (empty($attached)) {
            return '';
        }

        $validAttached = ['top', 'bottom', 'left', 'right'];
        
        if ($attached === 'true' || $attached === '1') {
            return 'attached';
        }

        return in_array($attached, $validAttached, true) ? "{$attached} attached" : '';
    }

    /**
     * Build floated class
     */
    protected function getFloatedClass(?string $floated): string {
        if (empty($floated)) {
            return '';
        }

        $validFloated = ['left', 'right'];

        return in_array($floated, $validFloated, true) ? "{$floated} floated" : '';
    }

    /**
     * Build alignment class
     */
    protected function getAlignedClass(?string $aligned): string {
        if (empty($aligned)) {
            return '';
        }

        $validAligned = ['left', 'center', 'right', 'justified'];

        return in_array($aligned, $validAligned, true) ? "{$aligned} aligned" : '';
    }

    /**
     * Build width class (for grid columns)
     */
    protected function getWidthClass($width): string {
        if (empty($width)) {
            return '';
        }

        // Number to word mapping
        $widthMap = [
            1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four',
            5 => 'five', 6 => 'six', 7 => 'seven', 8 => 'eight',
            9 => 'nine', 10 => 'ten', 11 => 'eleven', 12 => 'twelve',
            13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen', 16 => 'sixteen'
        ];

        if (is_numeric($width)) {
            $width = (int)$width;
            return isset($widthMap[$width]) ? "{$widthMap[$width]} wide" : '';
        }

        // Already a word
        if (array_search($width, $widthMap, true)) {
            return "{$width} wide";
        }

        return '';
    }

    /**
     * Combine multiple class parts
     */
    protected function combineClasses(...$parts): string {
        $classes = [];

        foreach ($parts as $part) {
            if (is_array($part)) {
                $classes = array_merge($classes, $part);
            } elseif (is_string($part) && $part !== '') {
                $classes[] = $part;
            }
        }

        return implode(' ', array_filter(array_unique($classes)));
    }
}
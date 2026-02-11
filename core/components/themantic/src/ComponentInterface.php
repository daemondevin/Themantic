<?php

namespace Themantic;

/**
 * Component Interface
 * 
 * All Themantic components must implement this interface
 */
interface ComponentInterface
{
    /**
     * Render the component
     *
     * @param array $properties Component properties
     * @return string Rendered HTML
     */
    public function render(array $properties = []): string;

    /**
     * Validate component properties
     *
     * @param array $properties
     * @return bool
     */
    public function validate(array $properties = []): bool;

    /**
     * Get component name
     *
     * @return string
     */
    public function getName(): string;
}
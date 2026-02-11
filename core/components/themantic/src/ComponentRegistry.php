<?php

namespace Themantic;

/**
 * Component Registry
 * 
 * Manages component registration and discovery
 */
class ComponentRegistry {
    protected Themantic $themantic;
    protected array $components = [];
    protected array $aliases = [];

    public function __construct(Themantic $themantic) {
        $this->themantic = $themantic;
    }

    /**
     * Register a component
     */
    public function register(string $name, string $class, ?string $alias = null): void {
        $name = strtolower($name);
        
        if (!class_exists($class)) {
            throw new \InvalidArgumentException("Component class not found: {$class}");
        }

        $this->components[$name] = $class;

        if ($alias !== null) {
            $this->aliases[strtolower($alias)] = $name;
        }
    }

    /**
     * Unregister a component
     */
    public function unregister(string $name): void {
        $name = strtolower($name);
        
        unset($this->components[$name]);
        
        // Remove any aliases pointing to this component
        foreach ($this->aliases as $alias => $target) {
            if ($target === $name) {
                unset($this->aliases[$alias]);
            }
        }
    }

    /**
     * Check if component exists
     */
    public function has(string $name): bool {
        $name = strtolower($name);
        
        return isset($this->components[$name]) || isset($this->aliases[$name]);
    }

    /**
     * Get component class
     */
    public function get(string $name): ?string {
        $name = strtolower($name);

        // Check if it's an alias
        if (isset($this->aliases[$name])) {
            $name = $this->aliases[$name];
        }

        return $this->components[$name] ?? null;
    }

    /**
     * Get all registered components
     */
    public function all(): array {
        return $this->components;
    }

    /**
     * Get all aliases
     */
    public function getAliases(): array {
        return $this->aliases;
    }

    /**
     * Create an alias for a component
     */
    public function alias(string $alias, string $name): void {
        $name = strtolower($name);
        $alias = strtolower($alias);

        if (!isset($this->components[$name])) {
            throw new \InvalidArgumentException("Component not found: {$name}");
        }

        $this->aliases[$alias] = $name;
    }

    /**
     * Bulk register components from array
     */
    public function registerMultiple(array $components): void {
        foreach ($components as $name => $class) {
            $this->register($name, $class);
        }
    }

    /**
     * Auto-discover components in a directory
     */
    public function discover(string $directory, string $namespace = 'Themantic\\Components\\'): void {
        if (!is_dir($directory)) {
            return;
        }

        $files = glob($directory . '/*.php');

        foreach ($files as $file) {
            $className = basename($file, '.php');
            $fqcn = $namespace . $className;

            if (class_exists($fqcn)) {
                $name = strtolower($className);
                $this->register($name, $fqcn);
            }
        }
    }

    /**
     * Get components by category
     */
    public function getByCategory(string $category): array {
        $categories = $this->themantic->getComponentsByCategory();
        
        if (!isset($categories[$category])) {
            return [];
        }

        $componentNames = $categories[$category];
        $result = [];

        foreach ($componentNames as $name) {
            if ($class = $this->get($name)) {
                $result[$name] = $class;
            }
        }

        return $result;
    }

    /**
     * Clear all registered components
     */
    public function clear(): void {
        $this->components = [];
        $this->aliases = [];
    }
}
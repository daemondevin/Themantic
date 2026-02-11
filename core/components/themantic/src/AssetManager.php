<?php

namespace Themantic;

/**
 * Asset Manager
 * 
 * Handles injection and management of CSS/JS assets
 */
class AssetManager {
    protected Themantic $themantic;
    protected bool $injected = false;
    protected array $scripts = [];
    protected array $styles = [];

    public function __construct(Themantic $themantic) {
        $this->themantic = $themantic;
    }

    /**
     * Inject core Fomantic-UI assets
     */
    public function inject(): void {
        if ($this->injected) {
            return;
        }

        $modx = $this->themantic->getModx();

        // jQuery
        $modx->regClientStartupScript(
            $this->themantic->getOption('jqueryCdn')
        );

        // Fomantic CSS
        $modx->regClientStartupHTMLBlock(
            '<link rel="stylesheet" href="' . 
            $this->themantic->getOption('fomanticCssCdn') . 
            '">'
        );

        // Fomantic JS
        $modx->regClientScript(
            $this->themantic->getOption('fomanticJsCdn')
        );

        $this->injected = true;
    }

    /**
     * Add custom script
     */
    public function addScript(string $script, bool $inline = false): void {
        if ($inline) {
            $this->themantic->getModx()->regClientScript(
                '<script>' . $script . '</script>',
                true
            );
        } else {
            $this->themantic->getModx()->regClientScript($script);
        }

        $this->scripts[] = $script;
    }

    /**
     * Add custom stylesheet
     */
    public function addStyle(string $style, bool $inline = false): void {
        if ($inline) {
            $this->themantic->getModx()->regClientHTMLBlock(
                '<style>' . $style . '</style>'
            );
        } else {
            $this->themantic->getModx()->regClientHTMLBlock(
                '<link rel="stylesheet" href="' . $style . '">'
            );
        }

        $this->styles[] = $style;
    }

    /**
     * Add inline JavaScript
     */
    public function addInlineScript(string $script): void {
        $this->addScript($script, true);
    }

    /**
     * Add inline CSS
     */
    public function addInlineStyle(string $style): void {
        $this->addStyle($style, true);
    }

    /**
     * Check if assets are injected
     */
    public function isInjected(): bool {
        return $this->injected;
    }

    /**
     * Get registered scripts
     */
    public function getScripts(): array {
        return $this->scripts;
    }

    /**
     * Get registered styles
     */
    public function getStyles(): array {
        return $this->styles;
    }

    /**
     * Reset injection state (useful for testing)
     */
    public function reset(): void {
        $this->injected = false;
        $this->scripts = [];
        $this->styles = [];
    }
}
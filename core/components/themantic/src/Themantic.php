<?php

namespace Themantic;

use MODX\Revolution\modX;
use MODX\Revolution\modChunk;
use \InvalidArgumentException;
use \OutOfRangeException;

/**
 * Themantic
 *
 * This class serves as a vessel for all the other classes
 * provided in this package.
 *
 * @package   Themantic
 * @version   1.0
 * @see       https://github.com/daemondevin/Themantic
 */
/**
 * Class Themantic
 *
 * @package Themantic
 */
class Themantic {
    const ERR_SCRIPT   = 'script';
    const ERR_SNIPPPET = 'snippet';
    const ERR_METHOD   = 'method';
    const ERR_USER     = 'user';

    public $modx = null;
    public $themantic = null;
    public $version = null;
    public $chunk = null;
    public $namespace = 'themantic';
    public $options = [];
    public $chunks = [];
    public $framework = null;
    public $components = [];

    private $services = [];
    private $instantiated = [];
    private $elements = [
            'button', 'container', 'divider', 'emoji', 'flag',
            'header', 'icon', 'image', 'input', 'label', 'list',
            'loader', 'placeholder', 'rail', 'reveal', 'segment',
            'step', 'text',
    ];
    private $collections = ['breadcrumb', 'form', 'grid', 'menu', 'message', 'table'];
    private $views = ['advertisements', 'card', 'comment', 'feed', 'item', 'statistic'];
    private $modules = [
            'accordion', 'calendar', 'checkbox', 'dimmer',
            'dropdown', 'embed', 'modal', 'popup', 'progress',
            'rating', 'search', 'shape', 'sidebar', 'slider',
            'sticky', 'tab', 'toast', 'transition',
    ];

    protected ?ComponentRegistry $componentRegistry = null;
    protected ?AssetManager $assetManager = null;

    /**
     * Component class mapping
     */
    protected array $componentMap = [
        // Core Elements
        'button'    => Components\Elements\Button::class,
        'icon'      => Components\Elements\Icon::class,
        'message'   => Components\Elements\Message::class,
        'label'     => Components\Elements\Label::class,
        'segment'   => Components\Elements\Segment::class,
        'divider'   => Components\Elements\Divider::class,
        'header'    => Components\Elements\Header::class,
        'image'     => Components\Elements\Image::class,
        'input'     => Components\Elements\Input::class,
        'list'      => Components\Elements\ListComponent::class,
        'loader'    => Components\Elements\Loader::class,
        
        // Collections
        'grid'      => Components\Collections\Grid::class,
        'menu'      => Components\Collections\Menu::class,
        'table'     => Components\Collections\Table::class,
        'form'      => Components\Collections\Form::class,
        'breadcrumb'=> Components\Collections\Breadcrumb::class,
        
        // Views
        'card'      => Components\Views\Card::class,
        'item'      => Components\Views\Item::class,
        'statistic' => Components\Views\Statistic::class,
        'comment'   => Components\Views\Comment::class,
        'feed'      => Components\Views\Feed::class,
        
        // Modules
        'modal'     => Components\Modules\Modal::class,
        'dropdown'  => Components\Modules\Dropdown::class,
        'accordion' => Components\Modules\Accordion::class,
        'tab'       => Components\Modules\Tab::class,
        'popup'     => Components\Modules\Popup::class,
        'progress'  => Components\Modules\Progress::class,
    ];

    /**
     * Build the Themantic object
     *
     * @param  \modX  &$modx     A reference to the modX instance.
     * @param  array  $options  An array of configuration options. Optional.
     */
    public function __construct(\modX &$modx, array $options = []) {

        $this->modx = &$modx;
        $this->namespace = $this->getOption('namespace', $options, 'themantic');
        
        $inject    = $this->getOption('themantic.inject', $options, true);
        $version   = $this->getOption('themantic.version', $options, '2.9.3');
        $corePath  = $this->getOption('themantic.core_path', $options, $this->modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/themantic/');
        $assetsUrl = $this->getOption('themantic.assets_url', $options, $this->modx->getOption('assets_url', null, MODX_ASSETS_URL) . 'components/themantic/');
        $this->options = array_merge(
                [
                        'corePath'        => $corePath,
                        'modelPath'       => $corePath . 'src/Model/',

                        'elementsPath'    => $corePath . 'src/Components/Tags/',
                        'collectionsPath' => $corePath . 'src/Components/Collections/',
                        'viewsPath'       => $corePath . 'src/Components/Views/',
                        'modulesPath'     => $corePath . 'src/Components/Modules/',

                        'processorsPath'  => $corePath . 'src/Processors/',

                        'templatesPath'   => $corePath . 'elements/templates/',
                        'chunksPath'      => $corePath . 'elements/chunks/',
                        'snippetsPath'    => $corePath . 'elements/snippets/',
                        'pluginsPath'     => $corePath . 'elements/plugins/',

                        'assetsUrl'       => $assetsUrl,
                        'jsUrl'           => $assetsUrl . 'js/',
                        'cssUrl'          => $assetsUrl . 'css/',
                        'imagesUrl'       => $assetsUrl . 'images/',
                        'connectorUrl'    => $assetsUrl . 'connector.php',
                        
                        'fomanticCssCdn'  => 'https://cdn.jsdelivr.net/npm/fomantic-ui@'.$version.'/dist/semantic.min.css',
                        'fomanticJsCdn'   => 'https://cdn.jsdelivr.net/npm/fomantic-ui@'.$version.'/dist/semantic.min.js',
                        'jqueryCdn'       => 'https://code.jquery.com/jquery-3.7.1.min.js',
                        'auto_inject'     => $inject
                ], $options
        );
        
        if ($this->options['auto_inject']) {
            $this->injectAssets();
        }
        
        $this->modx->addPackage('themantic', $this->getOption('modelPath'), '', 'Themantic\\');


        $this->components = [
                'elements'     => $this->elements,
                'colllections' => $this->collections,
                'views'        => $this->views,
                'modules'      => $this->modules,
        ];

        $this->autoload();
    }

    /**
     * Get a local configuration option or a namespaced system setting by key.
     *
     * @param  string      $key      The option key to search for.
     * @param  array|null  $options  An array of options that override local options.
     * @param  mixed       $default  The default value returned if the option is not found locally or as a
     *                               namespaced system setting; by default this value is null.
     *
     * @return mixed The option value or the default value specified.
     */
    final public function getOption(string $key, ?array $options = array(), $default = null) {
        $option = $default;
        if (!empty($key) && is_string($key)) {
            if ($options !== null && array_key_exists($key, $options)) {
                $option = $options[$key];
            } elseif (array_key_exists($key, $this->options)) {
                $option = $this->options[$key];
            } elseif (array_key_exists("{$this->namespace}.{$key}", $this->modx->config)) {
                $option = $this->modx->getOption("{$this->namespace}.{$key}");
            }
        }
        return $option;
    }

    /**
     * Checks to see if we're running MODx version 3.
     */
    final public function isModx3(): bool {
        $modxVersion = $this->modx->getVersionData();
        if ($modxVersion['version'] >= '3') {
            return true;
        }
        return false;
    }

    /**
     * Get required includes and load them automagically.
     */
    final public function autoload(): void {
        require_once MODX_CORE_PATH . 'components/themantic/vendor/autoload.php';
    }

    /**
     * Gets a Chunk and caches it; also falls back to file-based templates
     * for easier debugging.
     * @param  string  $name        The name of the Chunk
     * @param  array   $properties  The properties for the Chunk
     *
     * @return string The processed content of the Chunk
     */
    final public function getChunk(string $name, array $properties = array()): string {
        $chunk = null;
        if (!isset($this->chunks[$name])) {
            $chunk = $this->modx->getObject('modChunk',array('name' => $name),true);
            if (empty($chunk)) {
                $chunk = $this->_getTplChunk($name);
                if ($chunk == false) return false;
            }
            $this->chunks[$name] = $chunk->getContent();
        } else {
            $o = $this->chunks[$name];
            $chunk = $this->modx->newObject('modChunk');
            $chunk->setContent($o);
        }
        $chunk->setCacheable(false);
        return $chunk->process($properties);
    }

    /**
     * Returns a modChunk object from a template file.
     * @param  string  $name  The name of the Chunk. Will parse to name.chunk.tpl
     *
     * @return modChunk/boolean Returns the modChunk object if found, otherwise
     * false.
     */
    private function _getTplChunk(string $name) {
        $chunk = false;
        $f = $this->options['chunksPath'].strtolower($name).'.chunk.tpl';
        if (file_exists($f)) {
            $o = file_get_contents($f);
            $chunk = $this->modx->newObject('modChunk');
            $chunk->set('name',$name);
            $chunk->setContent($o);
        }
        return $chunk;
    }
    
    /**
     * Get AssetManager instance (lazy loading)
     */
    public function getAssetManager(): AssetManager {
        if ($this->assetManager === null) {
            $this->assetManager = new AssetManager($this);
        }
        
        return $this->assetManager;
    }

    /**
     * Get ComponentRegistry instance
     */
    public function getComponentRegistry(): ComponentRegistry {
        if ($this->componentRegistry === null) {
            $this->componentRegistry = new ComponentRegistry($this);
        }
        
        return $this->componentRegistry;
    }

    /**
     * Render a component by name
     *
     * @param string $name Component name
     * @param array|string $properties Component properties
     * @return string Rendered HTML
     */
    public function render(string $name, $properties = []): string {
        try {
            $component = $this->make($name);
            
            if (is_string($properties)) {
                $properties = $this->decodeJsonProperty($properties);
            }
            
            return $component->render($properties);
            
        } catch (\Exception $e) {
            $this->logError(__METHOD__, $e->getMessage(), self::ERR_METHOD);
            
            if ($this->getOption('debug_mode', false)) {
                return "<!-- Error rendering {$name}: {$e->getMessage()} -->";
            }
            
            return '';
        }
    }

    /**
     * Create a component instance
     *
     * @param string $name Component name
     * @return ComponentInterface
     * @throws InvalidArgumentException
     */
    public function make(string $name): ComponentInterface {
        $name = strtolower($name);

        if (!isset($this->componentMap[$name])) {
            throw new InvalidArgumentException("Unknown component: {$name}");
        }

        $class = $this->componentMap[$name];

        if (!class_exists($class)) {
            throw new InvalidArgumentException("Component class not found: {$class}");
        }

        return new $class($this);
    }

    /**
     * Register a custom component
     */
    public function registerComponent(string $name, string $class): void {
        if (!class_exists($class)) {
            throw new InvalidArgumentException("Class not found: {$class}");
        }

        $this->componentMap[strtolower($name)] = $class;
    }

    /**
     * Get all registered component names
     */
    public function getRegisteredComponents(): array {
        return array_keys($this->componentMap);
    }

    /**
     * Get component categories
     */
    public function getComponentsByCategory(): array {
        return [
            'elements' => self::ELEMENTS,
            'collections' => self::COLLECTIONS,
            'views' => self::VIEWS,
            'modules' => self::MODULES,
        ];
    }
    
    /**
     * Inject Fomantic-UI assets into page head
     */
    protected function injectAssets(): void {
        static $injected = false;
        if ($injected) {
            return;
        }

        $this->modx->regClientStartupScript($this->options['jqueryCdn']);
        $this->modx->regClientStartupHTMLBlock(
            '<link rel="stylesheet" href="' . $this->options['fomanticCssCdn'] . '">'
        );
        $this->modx->regClientScript($this->options['fomanticJsCdn']);

        $injected = true;
    }
    
    /**
     * Parse and sanitize content
     */
    public function parseContent($content) {
        if (empty($content)) {
            return '';
        }
        return $this->modx->parseChunk($content, [], '[[+', ']]');
    }
    
    /**
     * Get property with default value
     */
    public function getProperty(array $properties, $key, $default = '') {
        return isset($properties[$key]) && $properties[$key] !== '' ? $properties[$key] : $default;
    }
    
    public function decodeJsonProperty($value): array {
        if (is_array($value)) {
            return $value;
        }

        if (!is_string($value) || trim($value) === '') {
            return [];
        }

        $decoded = json_decode($value, true);
        return json_last_error() === JSON_ERROR_NONE ? $decoded : [];
    }

    /**
     * Log error message
     * 
     * @param  string  $method    The method in which threw the error.
     * @param  string  $message    A message detailing the erroneous event.
     * @param  string  $type   The kind of error that occured. (method, snippet, script, etc.)
     * @param  string  $level  MODx log level
     *
     * @return false
     */
    public function logError(
        string $method,
        string $message,
        string $type = self::ERR_METHOD,
        int $level = modX::LOG_LEVEL_ERROR
    ): bool {
        $prefix = match ($type) {
            self::ERR_METHOD => "[Themantic] Invalid method call: {$method}",
            self::ERR_SNIPPET => "[Themantic] Invalid snippet call: {$method}",
            self::ERR_SCRIPT => "[Themantic] Script error in {$method}",
            default => "[Themantic] Unknown error in {$method}",
        };

        $this->modx->log($level, "{$prefix} - {$message}", '', __CLASS__);
        return true;
    }
    
    /**
     * Register a service in the container
     * 
     * @param  string  $id    The method in which threw the error.
     */
    public function bind(string $id, $concrete = null): void {
        if ($concrete === null) {
            $concrete = $id;
        }

        $this->services[$id] = $concrete;
    }

    /**
     * Register a singleton service
     */
    public function singleton(string $id, $concrete = null): void {
        $this->bind($id, $concrete);
    }

    /**
     * Check if service exists in container
     */
    public function has(string $id): bool {
        return isset($this->services[$id]) || isset($this->instantiated[$id]);
    }

    /**
     * Get service from container
     */
    public function get(string $id) {
        if (isset($this->instantiated[$id])) {
            return $this->instantiated[$id];
        }

        if (!$this->has($id)) {
            throw new InvalidArgumentException("Service not found: {$id}");
        }

        $concrete = $this->services[$id];

        // If it's a closure, execute it
        if ($concrete instanceof \Closure) {
            $object = $concrete($this);
        } 
        // If it's a class name, instantiate it
        elseif (is_string($concrete) && class_exists($concrete)) {
            $object = new $concrete($this);
        } 
        // Otherwise return as-is
        else {
            $object = $concrete;
        }

        // Cache the instance
        $this->instantiated[$id] = $object;

        return $object;
    }

    /**
     * Remove service from container
     */
    public function forget(string $id): void {
        unset($this->services[$id], $this->instantiated[$id]);
    }

    /**
     * Get MODX instance
     */
    public function getModx(): modX {
        return $this->modx;
    }

    /**
     * Get namespace
     */
    public function getNamespace(): string {
        return $this->namespace;
    }

    /**
     * Get version
     */
    public function getVersion(): string {
        return $this->getOption('version', '2.9.3');
    }
}
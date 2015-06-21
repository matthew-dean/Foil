<?php
/*
 * This file is part of the Foil package.
 *
 * (c) Giuseppe Mazzapica <giuseppe.mazzapica@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Foil;

use Pimple\Container;
use Foil\Contracts\BootableServiceProviderInterface as Bootable;
use Pimple\ServiceProviderInterface as ServiceProvider;
use Foil\Contracts\SectionInterface;
use SplQueue;

/**
 * Instantiates and store services by instantiating Pimple container and service providers.
 * Bootable providers are booted too.
 *
 * @author  Giuseppe Mazzapica <giuseppe.mazzapica@gmail.com>
 * @package foil\foil
 * @license http://opensource.org/licenses/MIT MIT
 */
final class Foil
{
    /**
     * @var array
     */
    private static $defaults = [
        'autoescape'          => true,
        'default_charset'     => 'utf-8',
        'strict_variables'    => false,
        'ext'                 => 'php',
        'folders'             => [],
        'section_def_mode'    => SectionInterface::MODE_APPEND,
        'html_tags_functions' => false,
        'template_class'      => false,
    ];

    /**
     * @var array
     */
    private static $providers = [
        'kernel'     => '\\Foil\\Providers\\Kernel',
        'aura_html'  => '\\Foil\\Providers\\AuraHtml',
        'core'       => '\\Foil\\Providers\\Core',
        'context'    => '\\Foil\\Providers\\Context',
        'extensions' => '\\Foil\\Providers\\Extensions',
        'blocks'     => '\\Foil\\Providers\\Blocks',
    ];

    /**
     * @var \Foil\API
     */
    private $api;

    /**
     * @var \Pimple\Container
     */
    private $container;

    /**
     * @param  array $options
     * @param  array $providers
     * @return self
     */
    public static function boot(array $options = [], array $providers = [])
    {
        $providers = empty($providers)
            ? self::$providers
            : array_merge(self::$providers, array_filter($providers, 'is_string'));

        $container = new Container(['options' => array_merge(self::$defaults, $options)]);
        $api = new API($container);
        $container['api'] = $api;
        self::setup($container, $providers);

        return new self($container, $api);
    }

    /**
     * @return \Foil\Engine
     */
    public function engine()
    {
        return $this->container['engine'];
    }

    /**
     * @param \Pimple\Container $container
     * @param \Foil\API         $api
     */
    public function __construct(Container $container, API $api)
    {
        $this->container = $container;
        $this->api = $api;
    }

    /**
     * @return \Foil\API
     */
    public function api()
    {
        return $this->api;
    }

    /**
     * @param \Pimple\Container $container
     * @param array             $providers
     */
    private static function setup(Container $container, array $providers)
    {
        $queue = new SplQueue();
        array_walk($providers, function ($class) use ($queue, $container) {
            $provider = class_exists($class) ? new $class() : false;
            $provider instanceof ServiceProvider and $container->register($provider);
            $provider instanceof Bootable and $queue->enqueue($provider);
        });

        while (! $queue->isEmpty()) {
            $queue->dequeue()->boot($container);
        }

        $container['events']->fire('f.bootstrapped');
    }
}

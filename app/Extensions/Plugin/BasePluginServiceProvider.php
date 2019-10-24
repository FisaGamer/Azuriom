<?php

namespace Azuriom\Extensions\Plugin;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

abstract class BasePluginServiceProvider extends ServiceProvider
{
    use HasPlugin;

    /**
     * The plugin's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [];

    /**
     * The plugin's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [];

    /**
     * The policy mappings for this plugin.
     *
     * @var array
     */
    protected $policies = [];

    /**
     * The router instance.
     *
     * @var \Illuminate\Routing\Router
     */
    protected $router;

    /**
     * Register any plugin services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected function registerMiddlewares()
    {
        $this->middleware($this->middleware);

        $this->middlewareGroup($this->middlewareGroups);
    }

    protected function registerPolicies()
    {
        foreach ($this->policies() as $key => $value) {
            Gate::policy($key, $value);
        }
    }

    protected function loadViews()
    {
        $viewsPath = $this->pluginResourcePath('views');

        $this->loadViewsFrom($viewsPath, $this->pluginName);
    }

    protected function loadTranslations()
    {
        $langPath = $this->pluginResourcePath('lang');

        $this->loadTranslationsFrom($langPath, $this->pluginName);
    }

    protected function loadMigrations()
    {
        $this->loadMigrationsFrom($this->pluginPath('database/migrations'));
    }

    protected function middlewareGroup($name, $middleware = null)
    {
        if (is_array($name)) {
            foreach ($name as $key => $value) {
                $this->router->middlewareGroup($key, $value);
            }
        } else {
            $this->router->middlewareGroup($name, $middleware);
        }
    }

    protected function middleware($name, $middleware = null)
    {
        if (is_array($name)) {
            foreach ($name as $key => $value) {
                $this->router->aliasMiddleware($key, $value);
            }
        } else {
            $this->router->aliasMiddleware($name, $middleware);
        }
    }

    public function policies()
    {
        return $this->policies;
    }

    protected function pluginPath($path = '')
    {
        return plugin_path($this->pluginName.'/'.$path);
    }

    protected function pluginResourcePath($path = '')
    {
        return $this->pluginPath('resources/'.$path);
    }
}

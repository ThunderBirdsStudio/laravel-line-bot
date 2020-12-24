<?php

namespace Tbs\LineBot;

use Illuminate\Support\ServiceProvider;

class LineServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                $this->getConfigFile() => config_path('line-bot.php'),
            ], 'config');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->mergeConfigFrom(
            $this->getConfigFile(), 'line-bot'
        );

        $this->app->bind('line-bot', function () {
            return new LineBot();
        });

        $this->app->alias('line-bot', LineBot::class);
    }

    /**
     * @return string
     */
    protected function getConfigFile(): string
    {
        return __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'line-bot.php';
    }
}

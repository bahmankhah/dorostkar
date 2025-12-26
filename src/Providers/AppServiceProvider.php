<?php

namespace Dorostkar\Providers;

use Dorostkar\Modules\AIAgent\AIAgentModule;
use Dorostkar\WPLite\Container;
use Dorostkar\WPLite\Provider;
use function Dorostkar\WPLite\appLogger;


class AppServiceProvider extends Provider
{
    /** @var AIAgentModule|null */
    private $aiAgentModule = null;

    public function register() {
 
    }
    
    /**
     * Register AI Agent Module
     *
     * @return void
     */
    private function registerAIAgentModule()
    {
        // Check master switch - if disabled, skip entire module
        if (!defined('FOROOSHYAR_AIAGENT_ENABLED') || !FOROOSHYAR_AIAGENT_ENABLED) {
            appLogger('Forooshyar: AI Agent Module disabled via FOROOSHYAR_AIAGENT_ENABLED constant');
            return;
        }
        
        if (class_exists(AIAgentModule::class)) {
            $this->aiAgentModule = new AIAgentModule();
            $this->aiAgentModule->register();
            appLogger('Forooshyar: AI Agent Module registered');
        }
    }
    
    public function bootEarly() {
    }
    
    public function admin() {
        // Admin initialization - register hooks but don't execute translation-dependent code yet
    }
    
    public function onInit() {
        
        // Load Persian text domain - moved to plugins_loaded hook for WordPress 6.5+ compatibility
        add_action('plugins_loaded', function() {
            load_plugin_textdomain(
                'dorostkar',
                false,
                dirname(plugin_basename(dirname(dirname(__DIR__)))) . '/languages'
            );
                   
        });
        // Register AI Agent Module
        $this->registerAIAgentModule();
        
    }
    
    public function boot() {
        
        // Boot AI Agent Module (only if enabled)
        if ($this->aiAgentModule !== null && defined('FOROOSHYAR_AIAGENT_ENABLED') && FOROOSHYAR_AIAGENT_ENABLED) {
            $this->aiAgentModule->boot();
            appLogger('Forooshyar: AI Agent Module booted');
        }
    }
    
    public function ajax() {
    }
    
    public function rest() {
    }
    
    public function activate() {
    }
    
    public function deactivate() {
    }
    
    public function uninstall() {
    }
}
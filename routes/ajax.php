<?php

use Dorostkar\Controllers\AIAgentController;
use Dorostkar\WPLite\Facades\Route;

Route::ajax(function ($router) {
    // ============================================
    // AI Agent Module
    // ============================================
    
    // Single entity analysis (dry run)
    $router->post('aiagent_analyze_single', [AIAgentController::class, 'analyzeSingle'])->make();
    
    // Analysis job management
    $router->post('aiagent_start_analysis', [AIAgentController::class, 'startAnalysis'])->make();
    $router->post('aiagent_cancel_analysis', [AIAgentController::class, 'cancelAnalysis'])->make();
    $router->post('aiagent_get_analysis_progress', [AIAgentController::class, 'getAnalysisProgress'])->make();
    $router->post('aiagent_process_batch', [AIAgentController::class, 'processBatch'])->make();
    $router->post('aiagent_acknowledge_completion', [AIAgentController::class, 'acknowledgeCompletion'])->make();
    $router->post('aiagent_run_analysis', [AIAgentController::class, 'runAnalysis'])->make(); // Legacy
    
    // Action management
    $router->post('aiagent_execute_action', [AIAgentController::class, 'executeAction'])->make();
    $router->post('aiagent_approve_action', [AIAgentController::class, 'approveAction'])->make();
    $router->post('aiagent_dismiss_action', [AIAgentController::class, 'dismissAction'])->make();
    $router->post('aiagent_approve_all_actions', [AIAgentController::class, 'approveAllActions'])->make();
    $router->post('aiagent_dismiss_all_actions', [AIAgentController::class, 'dismissAllActions'])->make();
    
    // Statistics and testing
    $router->post('aiagent_get_stats', [AIAgentController::class, 'getStats'])->make();
    $router->post('aiagent_test_connection', [AIAgentController::class, 'testConnection'])->make();
    
    // AI Agent settings
    $router->post('aiagent_save_settings', [AIAgentController::class, 'saveSettings'])->make();
    $router->post('aiagent_reset_settings', [AIAgentController::class, 'resetSettings'])->make();
    $router->post('aiagent_export_settings', [AIAgentController::class, 'exportSettings'])->make();
    $router->post('aiagent_import_settings', [AIAgentController::class, 'importSettings'])->make();
});

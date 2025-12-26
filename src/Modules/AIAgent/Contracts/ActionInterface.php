<?php
/**
 * Action Interface
 * 
 * @package Dorostkar\Modules\AIAgent\Contracts
 */

namespace Dorostkar\Modules\AIAgent\Contracts;

interface ActionInterface
{
    /**
     * Execute the action
     *
     * @param array $data
     * @return array ['success' => bool, 'message' => string, 'data' => array]
     */
    public function execute(array $data);

    /**
     * Validate action data
     *
     * @param array $data
     * @return array ['valid' => bool, 'errors' => array]
     */
    public function validate(array $data);

    /**
     * Check if action requires manual approval
     *
     * @return bool
     */
    public function requiresApproval();

    /**
     * Get action metadata
     *
     * @return array
     */
    public function getMeta();

    /**
     * Check if action is enabled in settings
     *
     * @return bool
     */
    public function isEnabled();

    /**
     * Get action type identifier
     *
     * @return string
     */
    public function getType();
}

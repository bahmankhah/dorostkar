<?php
/**
 * Subscription Interface
 * 
 * @package Dorostkar\Modules\AIAgent\Contracts
 */

namespace Dorostkar\Modules\AIAgent\Contracts;

interface SubscriptionInterface
{
    /**
     * Check if AI Agent module is globally enabled
     *
     * @return bool
     */
    public function isModuleEnabled();

    /**
     * Check if specific feature is enabled
     *
     * @param string $feature
     * @return bool
     */
    public function isFeatureEnabled($feature);

    /**
     * Get subscription tier (free, basic, pro, enterprise)
     *
     * @return string
     */
    public function getSubscriptionTier();

    /**
     * Get all enabled features for current tier
     *
     * @return array
     */
    public function getEnabledFeatures();

    /**
     * Check usage limits (analyses per day, actions per day)
     *
     * @param string $limitType
     * @return array ['allowed' => int, 'used' => int, 'remaining' => int]
     */
    public function checkUsageLimit($limitType);
}

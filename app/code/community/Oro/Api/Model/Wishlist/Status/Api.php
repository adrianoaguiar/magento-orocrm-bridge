<?php
/**
 * Oro Inc.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is published at http://opensource.org/licenses/osl-3.0.php.
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magecore.com so we can send you a copy immediately
 *
 * @category   Oro
 * @package    Oro_Api
 * @copyright  Copyright 2013 Oro Inc. (http://www.orocrm.com)
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

class Oro_Api_Model_Wishlist_Status_Api extends Oro_Api_Model_Wishlist_Api
{
    /**
     * Get wishlist status list
     *
     * @param array|object $filters
     * @param null|\stdClass $pager
     * @return array
     * @throws Mage_Api_Exception
     */
    public function items($filters, $pager = null)
    {
        /** @var Oro_Api_Model_Resource_Wishlist_Status_Collection $collection */
        $collection = Mage::getResourceModel('oro_api/wishlist_status_collection');
        /** @var $apiHelper Mage_Api_Helper_Data */
        $apiHelper = Mage::helper('oro_api');
        $filters = $apiHelper->parseFilters($filters);
        try {
            foreach ($filters as $field => $value) {
                $collection->addFieldToFilter($field, $value);
            }
        } catch (Mage_Core_Exception $e) {
            $this->_fault('filters_invalid', $e->getMessage());
        }

        if ($pager && !$this->_apiHelper->applyPager($collection, $pager)) {
            // there's no such page, so no results for it
            return array();
        }
        $result = $collection->toArray();

        return $result;
    }
}

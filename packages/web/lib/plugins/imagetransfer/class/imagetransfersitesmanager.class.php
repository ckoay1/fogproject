<?php
/**
 * Image transfer plugin
 *
 * PHP version 5
 *
 * @category Image Transfer
 * @package  FOGProject
 * @author   CES Team
 */
 

class ImageTransferSitesManager extends FOGManagerController
{
   /**
     * The base table name.
     *
     * @var string
     */
    public $tablename = 'imgTransferSites';
    /**
     * Install our table.
     *
     * @return bool
     */

    public function install()
    {
        $this->uninstall();
        $sql = Schema::createTable(
            $this->tablename,
            true,
            array(
                'siteID',
                'siteCode'
            ),
            array(
                'INTEGER',
                'VARCHAR(255)'
            ),
            array(
                false,
                false
            ),
            array(
                false,
                false
            ),
            array(),
            'MyISAM',
            'utf8',
            'siteID',
            'siteID'
        );
            
        if (!self::$DB->query($sql)) {
            return false;
        }

        return self::getClass('ImageTransferSrcImagesManager')->install();
    }

     /**
     * Uninstalls the plugin
     *
     * @return bool
     */
    public function uninstall()
    {
        self::getClass('ImageTransferSrcImagesManager')->uninstall();
        return parent::uninstall();
    }


}

<?php
/**
 * Image transfer plugin
 *
 * PHP version 5
 *
 * @category ImageTransferStatesManager
 * @package  FOGProject
 * @author   CES Team
 */

class ImageTransferStatesManager extends FOGManagerController
{
    /**
     * The base table name.
     *
     * @var string
     */
    public $tablename = 'imgTransferStates';
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
                'itsID',
                'itsName',
                'itsDescription',
                'itsIcon'
            ),
            array(
                'INTEGER',
                'VARCHAR(30)',
                'TEXT',
                'VARCHAR(255)'
            ),
            array(
                false,
                false,
                false,
                false
            ),
            array(
                false,
                false,
                false,
                false
            ),
            array(),
            'MyISAM',
            'utf8',
            'itsID',
            'itsID'
        );
        if (!self::$DB->query($sql)) {
            return false;
        } else {
            
            $sql = sprintf(
                "INSERT INTO `%s` VALUES "
                . "(1, 'In-Progress', 'Image Transfer In Progress', 'spinner fa-pulse fa-fw'),"
                . "(2, 'Completed', 'Image Transfer Completed', 'check-circle'),"
                . "(3, 'Failed', 'Image Transfer Failed', 'ban')"
                ,
                $this->tablename
            );
            
            if (!self::$DB->query($sql)) {
                return false;
            }

            return self::getClass('ImageTransferSitesManager')->install();

        }
    }
    /**
     * Uninstalls the plugin
     *
     * @return bool
     */
    public function uninstall()
    {
        self::getClass('ImageTransferSitesManager')->uninstall();
        return parent::uninstall();
    }
}

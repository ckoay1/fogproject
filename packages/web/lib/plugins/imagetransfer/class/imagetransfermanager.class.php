<?php
/**
 * Image transfer plugin
 *
 * PHP version 5
 *
 * @category ImageTransferManager
 * @package  FOGProject
 * @author   CES Team
 */
 
class ImageTransferManager extends FOGManagerController
{
    /**
     * The table name.
     *
     * @var string
     */
    public $tablename = 'imgTransferLog';
    /**
     * Installs the database for the plugin.
     *
     * @return bool
     */
    public function install()
    {
        /**
         * Add the information into the database.
         * This is commented out so we don't actually
         * create anything.
         */
        $this->uninstall();
        $sql = Schema::createTable(
            $this->tablename,
            true,
            array(
				'itID',
				'itUserID',
				'itSource',
				'itDestination',
				'itImageName',	
				//5
				'itImageSourceID',
				'itImageDestID',
				'itImageSize',
				'itImageServerSize',
				'itStartTime',
				//5
				'itEndTime',
				'itTransferRate',
				'itStatusID',
				'itStatusRemark'
            ),
            array(
                'INTEGER',
                'INTEGER',
                'VARCHAR(50)',
                'VARCHAR(50)',
                'VARCHAR(40)',
				//5
                'INTEGER',
                'INTEGER',
                'VARCHAR(255)',
				'BIGINT UNSIGNED NOT NULL DEFAULT 0',
                'TIMESTAMP',
				//5
                'TIMESTAMP',
                'VARCHAR(250)',
                'INTEGER',
                'VARCHAR(255)'
            ),
            array(
                false,
                false,
                false,
                false,
                false,
				//5
                false,
                false,
                false,
                false,
                false,
				//5
                false,
                false,
                false,
                false
            ),
            array(
                false,
                false,
                false,
                false,
                false,
				//5
                false,
                false,
                false,
                false,
                'CURRENT_TIMESTAMP',
				//5
                'CURRENT_TIMESTAMP',
                false,
                false,
                false
            ),
            array(),
            'MyISAM',
            'utf8',
            'itID',
            'itID'
        );

        if (!self::$DB->query($sql)) {
            return false;
        }

        return self::getClass('ImageTransferStatesManager')->install();
    }
    /**
     * Uninstalls the plugin
     *
     * @return bool
     */
    public function uninstall()
    {
        self::getClass('ImageTransferStatesManager')->uninstall();
        return parent::uninstall();
    }
}

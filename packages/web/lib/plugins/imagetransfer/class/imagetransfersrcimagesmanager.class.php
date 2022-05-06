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
 

class ImageTransferSrcImagesManager extends FOGManagerController
{
   /**
     * The base table name.
     *
     * @var string
     */
    public $tablename = 'imgTransferSrcImages';
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
                'srcImageID',
                'srcImageName',
                'srcImageSize',
                'srcImageServerSize'
            ),
            array(
                'INTEGER',
                'VARCHAR(255)',
                'VARCHAR(255)',
                'bigint unsigned'
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
            'srcImageID',
            'srcImageID'
        );

        return self::$DB->query($sql);
    }

     /**
     * Uninstalls the plugin
     *
     * @return bool
     */
    public function uninstall()
    {
        return parent::uninstall();
    }


}

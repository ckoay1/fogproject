<?php
/**
 * Image transfer plugin
 *
 * PHP version 5
 *
 * @category ImageTransferSites
 * @package  FOGProject
 * @author   CES Team
 */
 

class ImageTransferSites extends FOGController
{
    /**
     * The image type table.
     *
     * @var string
     */
    protected $databaseTable = 'imgTransferSites';
    /**
     * The image type fields and common names.
     *
     * @var array
     */
    protected $databaseFields = array(
        'id' => 'siteID',
        'name' => 'siteCode'
    );
    /**
     * The required fields.
     *
     * @var array
     */
    protected $databaseFieldsRequired = array(
        'siteCode'
    );

}

<?php
/**
 * Image transfer plugin
 *
 * PHP version 5
 *
 * @category ImageTransferSrcImages
 * @package  FOGProject
 * @author   CES Team
 */
 

class ImageTransferSrcImages extends FOGController
{
    /**
     * The image type table.
     *
     * @var string
     */
    protected $databaseTable = 'imgTransferSrcImages';
    /**
     * The image type fields and common names.
     *
     * @var array
     */
    protected $databaseFields = array(
        'id' => 'srcImageID',
        'name' => 'srcImageName',
        'size' => 'srcImageSize',
        'serverSize' => 'srcImageServerSize',

    );
    /**
     * The required fields.
     *
     * @var array
     */
    protected $databaseFieldsRequired = array(
        'srcImageID',
        'srcImageName'
    );

}

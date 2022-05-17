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
 
class ImageTransfer extends FOGController
{
    /**
     * The example table.
     *
     * @var string
     */
    protected $databaseTable = 'imgTransferLog';
    /**
     * The database fields and commonized items.
     *
     * @var array
     */

    protected $databaseFields = array(
        'id' => 'itID',
        'user' => 'itUserID',
        'source' => 'itSource',
        'destination' => 'itDestination',
        'imageName' => 'itImageName',
        'imageSourceID' => 'itImageSourceID',
        'imageDestID' => 'itImageDestID',
        'imageSize' => 'itImageSize',
        'imageServerSize' => 'itImageServerSize',
        'startTime' => 'itStartTime',
        'endTime' => 'itEndTime',
        'transferRate' => 'itTransferRate',
        'statusID' => 'itStatusID',
        'statusRemark' => 'itStatusRemark'
    );
    /**
     * The required fields
     *
     * @var array
     */
    protected $databaseFieldsRequired = array(
        'id',
        'source',
        'destination',
        'imageName',
    );

}

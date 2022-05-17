<?php
/**
 * Access Control plugin
 *
 * PHP version 5
 *
 * @category Image Transfer
 * @package  FOGProject
 * @author   CES Team
 */

class ImageTransferStates extends FOGController
{

    /**
     * Table name.
     *
     * @var string
     */
    protected $databaseTable = 'imgTransferStates';
    /**
     * Table fields.
     *
     * @var array
     */
    protected $databaseFields = array(
        'id' => 'itsID',
        'name' => 'itsName',
        'description' => 'itsDescription',
        'icon' => 'itsIcon'
    );
    /**
     * Required fields.
     *
     * @var array
     */
    protected $databaseFieldsRequired = array(
        'itsID',
    );
}

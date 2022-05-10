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
 
class ImageTransferManagementPage extends FOGPage
{
    public $node = 'imagetransfer';
    /**
     * Constructor
     *
     * @param string $name The name for the page.
     *
     * @return void
     */
    public function __construct($name = '')
    {
        if(isset($_REQUEST['siteCode']))
        {
            //self::$showhtml = false;

            $pxelAPI = new PXELApi();
            $pxelListSrcImage = json_decode($pxelAPI->listImagesBySite($_REQUEST['siteCode']));
            $srcImage = $pxelListSrcImage->Images;

            foreach ((array)$srcImage as &$img) {
                $items[] = array(
                    $img->id,
                    $img->name,
                    $img->size,
                    $img->srvsize
                );
                unset($img);
            }

            self::getClass('ImageTransferSrcImagesManager')->truncateTable();
            if(count($items) > 0)
            {
                self::getClass('ImageTransferSrcImagesManager')->insertBatch(
                    array(
                        'id',
                        'name',
                        'size',
                        'serverSize'
                    ),
                    $items
                );
            }

            echo self::getClass('ImageTransferSrcImagesManager')->buildSelectBox(
                filter_input(INPUT_POST, 'imagename'),
                'imagetransferSrcImages',
                'id'
            );
            exit();
        }
        else
        {
             /**
             * The name to give.
             */
            $this->name = _('Image Transfer Management');
            /**
             * Add this page to the PAGES_WITH_OBJECTS hook event.
             */
            self::$HookManager->processEvent(
                'PAGES_WITH_OBJECTS',
                array('PagesWithObjects' => &$this->PagesWithObjects)
            );
            /**
             * Get our $_GET['node'], $_GET['sub'], and $_GET['id']
             * in a nicer to use format.
             */
            global $node;
            global $sub;
            global $id;
            /**
             * Customize our settings as needed.
             */
            switch ($sub) {
            case 'addImageTransferConfirm':
                parent::__construct($this->name);
                break;
            default:
                parent::__construct($this->name);
                self::getClass('ImageTransferSrcImagesManager')->truncateTable();
            }

            /**
             * Set title to our initiator name.
             */
            $this->title = $this->name;
   
            $this->menu = array(
                'addImageTransfer' => sprintf(_('Create New Image Transfer')),
                'activeTransferStatus' => sprintf(_('Active Transfer Status')),
                'imageTransferHistory' => sprintf(_('Image Transfer History'))
            );

        }
        
    }


    /**
     * Add new image transfer.
     *
     * @return void
     */
    public function addImageTransfer()
    {
        $pxelAPI = new PXELApi();
        $pxelListSites = json_decode($pxelAPI->listSites());

        unset(
            $this->form,
            $this->data,
            $this->headerData,
            $this->templates,
            $this->attributes
        );
        $this->title = _('New Image Transfer');
        $this->attributes = array(
            array('class' => 'col-xs-4'),
            array('class' => 'col-xs-8 form-group'),
        );
        $this->templates = array(
            '${field}',
            '${input}',
        );
        $source = (int)filter_input(INPUT_POST, 'imagetransferSource');
        $source_desc = filter_input(INPUT_POST, 'imagetransferSource');
        $destination = (int)filter_input(INPUT_POST, 'imagetransferDestination');
        $imagename = (int)filter_input(INPUT_POST, 'imagetransferSrcImage');
        
        self::getClass('ImageTransferSitesManager')->truncateTable();
        self::getClass('ImageTransferSitesManager')->insertBatch(
            array(
                'name'
            ),
            $pxelListSites->Sites
        );

        $fields = array(
            '<label for="source">'
            . _('Source')
            . '</label>' => '<div class="input-group">'
            . self::getClass('ImageTransferSitesManager')->buildSelectBox(
                $source_desc,
                'imagetransferSource',
                'id'
            )
            . '</div>',
            '<label for="destination">'
            . _('Destination')
            . '</label>' => '<div class="input-group">'
            . self::getClass('ImageTransferSitesManager')->buildSelectBox(
                $destination,
                'imagetransferDestination',
                'id'
            )
            . '</div>',
            '<label for="image">'
            . _('Image Name')
            . '</label>' => '<div class="input-group" id="imgTrfSrc">'
            . self::getClass('ImageTransferSrcImagesManager')->buildSelectBox(
                $imagename,
                'imagetransferSrcImage',
                'id'
            )
            . '</div>',
            '<label for="add">'
            . _('Create New Image Transfer')
            . '</label>' => '<button type="submit" name="add" id="add" ' 
            . 'class="btn btn-info btn-block">'
            . _('Add')
            . '</button> '
        );
        array_walk($fields, $this->fieldsToData);
       
        self::$HookManager
            ->processEvent(
                'IMAGETRANSFER_ADD',
                array(
                    'headerData' => &$this->headerData,
                    'data' => &$this->data,
                    'templates' => &$this->templates,
                    'attributes' => &$this->attributes
                )
            );
        unset($fields);
        echo '<div class="col-xs-9">';
        echo '<div class="panel panel-info">';
        echo '<div class="panel-heading text-center">';
        echo '<h4 class="title">';
        echo $this->title;
        echo '</h4>';
        echo '</div>';
        echo '<div class="panel-body">';
        echo '<form class="form-horizontal" method="post" action="'
            . '?node=imagetransfer&sub=addImageTransferConfirm'
            . '">';
        $this->render(12);
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        unset(
            $this->data,
            $this->form,
            $this->headerData,
            $this->templates,
            $this->attributes
        );
    }

    /**
     * Add new image transfer confirmation.
     *
     * @return void
     */
    public function addImageTransferConfirm()
    {
        $source = filter_input(
            INPUT_POST,
            'imagetransferSource'
        );
        
        $destination = filter_input(
            INPUT_POST,
            'imagetransferDestination'
        );

        $imageid = filter_input(
            INPUT_POST,
            'imagetransferSrcImages'
        );

        foreach ((array)self::getClass('ImageTransferSitesManager')
            ->find(array('id' => $source)) as &$findSites
        )
        {
            $source_desc = $findSites->get('name');
            unset($findSites);
            break;
        }
            
        foreach ((array)self::getClass('ImageTransferSitesManager')
        ->find(array('id' => $destination)) as &$findSites
        )
        {
            $destination_desc = $findSites->get('name');
            unset($findSites);
            break;
        }
            
        foreach ((array)self::getClass('ImageTransferSrcImagesManager')
        ->find(array('id' => $imageid)) as &$findSites
        )
        {
            $image_desc = $findSites->get('name');
            $image_size = $findSites->get('size');
            $image_server_size = $findSites->get('imageServerSize');

            $image_size_formated = self::formatByteSize(
                            array_sum(
                                explode(
                                    ':',
                                    $image_size 
                                )
                            )
                        );
            unset($findSites);
            break;
        }
        
        unset(
            $this->data,
            $this->headerData,
            $this->templates,
            $this->attributes
        );

        $this->title = _('Confirm Image Transfer');
        $this->attributes = array(
            array('class' => 'col-xs-4'),
            array('class' => 'col-xs-8 form-group'),
        );
        $this->templates = array(
            '${field}',
            '${input}',
        );


        $fields = array(
            '<label for="source">'
            . _('Source')
            . '</label>' => '<label for="source_value">'
            . $source_desc
            . '</label>'
            . '<input type="hidden" name="hidden_srcdesc" value="'.$source_desc  .'"/>',
            '<label for="destination">'
            . _('Destination')
            . '</label>' => '<label for="destination_value">'
            . $destination_desc
            . '</label>'
            . '<input type="hidden" name="hidden_destdesc" value="'.$destination_desc  .'"/>',
            '<label for="image">'
            . _('Image Name')
            . '</label>' => '<label for="image_value">'
            . $image_desc
            . '</label>'
            . '<input type="hidden" name="hidden_imageid" value="'.$imageid  .'"/>'
            . '<input type="hidden" name="hidden_imagedesc" value="'.$image_desc  .'"/>',
            '<label for="image_size">'
            . _('Image Name')
            . '</label>' => '<label for="image_size_value">'
            . $image_size_formated
            . '</label>'
            . '<input type="hidden" name="hidden_imagesize" value="'.$image_size  .'"/>'
            . '<input type="hidden" name="hidden_imageserversize" value="'.$image_server_size  .'"/>',
            '<label for="add">'
            . _('Create New Image Transfer')
            . '</label>' => '<button type="submit" name="addimagetransfer" id="addimagetransfer" '
            . 'class="btn btn-info btn-block">'
            . _('Confirm Transfer')
            . '</button>'
        );
        array_walk($fields, $this->fieldsToData);
     
        self::$HookManager
        ->processEvent(
            'IMAGETRANSFER_DEPLOY',
            array(
                'headerData' => &$this->headerData,
                'data' => &$this->data,
                'templates' => &$this->templates,
                'attributes' => &$this->attributes
            )
        );

        unset($fields);
        echo '<!-- Confirm Items -->';
        echo '<div class="col-xs-9">';
        echo '<div class="panel panel-warning">';
        echo '<div class="panel-heading text-center">';
        echo '<h4 class="title">';
        echo $this->title;
        echo '</h4>';
        echo '</div>';
        echo '<div class="panel-body">';
        echo '<form class="form-horizontal" method="post" action="'
            . '?node=imagetransfer&sub=addImageTransfer'
            . '">';
        $this->render(12);
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        unset(
            $this->data,
            $this->headerData,
            $this->templates,
            $this->attributes
        );
    }

    /**
     * Add new image transfer post.
     *
     * @return void
     */
    public function addImageTransferPost()
    {
        $pxelAPI = new PXELApi();
        $source_desc = filter_input(
            INPUT_POST,
            'hidden_srcdesc'
        );

        $destination_desc = filter_input(
            INPUT_POST,
            'hidden_destdesc'
        );
       
        $image = filter_input(
            INPUT_POST,
            'hidden_imageid'
        );

        $image_desc = filter_input(
            INPUT_POST,
            'hidden_imagedesc'
        );

        $image_size = filter_input(
            INPUT_POST,
            'hidden_imagesize'
        );

        $image_server_size = filter_input(
            INPUT_POST,
            'hidden_imageserversize'
        );
        

        try {

            $ImageTransfer = self::getClass('ImageTransfer')
                ->set('user', self::$FOGUser->get('id'))
                ->set('source', $source_desc)
                ->set('destination', $destination_desc)
                ->set('imageName', $image_desc)
                ->set('imageSourceID', $image)
                ->set('imageSize', $image_size)
                ->set('imageServerSize', $image_server_size)
                ->set('startTime', self::formatTime('now', 'Y-m-d H:i:s'))
                ->set('statusID', '1');
            
            if (!$ImageTransfer->save()) {
                throw new Exception(_('Add image transfer failed!'));
            }

            $hook = 'IMAGETRANSFER_ADD_SUCCESS';
            $msg = json_encode(
                array(
                    'msg' => _('Image Trasfer added!'),
                    'title' => _('Image Trasfer Create Success'),
                    'redirect' => _('?node=imagetransfer&sub=activeTransferStatus')
                )
            );

            //Call PXEL API for Image Transfer
            $newTransferId = $ImageTransfer->get('id');
            $requestdata = "{
                \"sourceSiteName\":\"$source_desc\", 
                \"sourceImageName\":\"$image_desc\",
                \"destSiteName\":\"$destination_desc\",
                \"transferId\":\"$newTransferId\"
            }";
            $pxelAPI->transferImage($requestdata);

        } catch (Exception $e) {
            $hook = 'IMAGETRANSFER_ADD_FAIL';
            $msg = json_encode(
                array(
                    'error' => $e->getMessage(),
                    'title' => _('Image Trasfer Create Fail')
                )
            );
        }

        self::$HookManager
            ->processEvent(
                $hook,
                array('ImageTransfer' => &$ImageTransfer)
            );
        unset($ImageTransfer);
        echo $msg;
        exit();
    }

    
    /**
     * Active transfer status list
     *
     * @return void
     */
    public function activeTransferStatus()
    {
        // echo "Test";
        unset(
            $this->form,
            $this->data,
            $this->headerData,
            $this->templates,
            $this->attributes
        );

        $this->title = _('Active Transfer Status');

        $this->headerData = array(
            _('Started By:'),
            _('Source:'), 
            _('Destination:'),
            _('Image Name:'),
            _('Image Size: ON CLIENT'),
            _('Start Time'),
            _('Status')
        );
        $this->templates = array(
            '${startedby}',
            '<small>${source}</small>',
            '<small>${destination}</small>',
            '<small>${imageName}</small>',
            '<small>${imageSize}</small>',
            '<small>${startTime}</small>',
            '<small>${statusDesc}</small>',
        );
        $this->attributes = array(
            array(
                'width' => 40,
            ),
            array(
                'width' => 50,
            ),
            array(
                'width' => 50,
            ),
            array(
                'width' => 100,
            ),
            array(
                'width' => 70,
            ),
            array(
                'width' => 100,
            ),
            array(
                'width' => 50,
                'class' => 'filter-false'
            ),
        );


        foreach ((array)self::getClass('ImageTransferManager')
        ->find(array('statusID' => '1')) as &$findRecord
        )
        {
            $image_size_formated = self::formatByteSize(
                array_sum(
                    explode(
                        ':',
                        $findRecord->get('imageSize') 
                    )
                )
            );
            foreach ((array)self::getClass('UserManager')
            ->find(array('id' => $findRecord->get('user'))) as $user
            ) {
                $userName = $user->get('name');
                unset($user);
                break;
            }

            foreach ((array)self::getClass('ImageTransferStatesManager')
            ->find(array('id' => $findRecord->get('statusID'))) as $status
            ) {
                $statusDesc = $status->get('name');
                unset($status);
                break;
            }

            
      
            $this->data[] = array(
                'startedby' => $userName,
                'source' => $findRecord->get('source'),
                'destination' => $findRecord->get('destination'),
                'imageName' => $findRecord->get('imageName'),
                'imageSize' => $image_size_formated,
                'startTime' => $findRecord->get('startTime'),
                'statusDesc' => $statusDesc
            );

            unset($findRecord);
        }

        self::$HookManager
            ->processEvent(
                'IMAGETRANSFER_STATUS',
                array(
                    'headerData' => &$this->headerData,
                    'data' => &$this->data,
                    'templates' => &$this->templates,
                    'attributes' => &$this->attributes
                )
            );

        echo '<div class="tab-content col-xs-9">';
        echo '<div class="panel panel-info">';
        echo '<div class="panel-heading text-center">';
        echo '<h4 class="title">';
        echo $this->title;
        echo '</h4>';
        echo '</div>';
        echo '<div class="panel-body">';
        $this->render(12);
        echo '</div>';
        echo '</div>';
        echo '</div>';

        unset(
            $this->data,
            $this->form,
            $this->headerData,
            $this->templates,
            $this->attributes
        );
    }

    
    /**
     * Active transfer history filter
     *
     * @return void
     */
    public function imageTransferHistory()
    {
        $this->title = _('Image Transfer History') .'- ' . _('Search');
        unset(
                        $this->data,
                        $this->form,
                        $this->headerData,
                        $this->templates,
                        $this->attributes
                );
        $this->templates = array(
                '${field}',
                '${input}'
                );
        $this->attributes = array(
                        array('class' => 'col-xs-4'),
                        array('class' => 'col-xs-8 form-group')
                 );
        $userNames = self::getSubObjectIDs(
            'User',
            '',
            'name'
        );
        
        $sourceSite = self::getSubObjectIDs(
            'ImageTransfer',
            '',
            'source'
        );
        $destSite = self::getSubObjectIDs(
            'ImageTransfer',
            '',
            'destination'
        );
        
        $imageNames = self::getSubObjectIDs(
            'ImageTransfer',
            '',
            'imageName'
        );
        
        $transferStatus = self::getSubObjectIDs(
            'ImageTransferStates',
            '',
            'name'
        );
        

        $userNames = array_values(
            array_filter(
                array_unique(
                    (array)$userNames
                )
            )
        );

        $sourceSite = array_values(
            array_filter(
                array_unique(
                    (array)$sourceSite
                )
            )
        );
        $destSite = array_values(
            array_filter(
                array_unique(
                    (array)$destSite
                )
            )
        );
        $imageNames = array_values(
            array_filter(
                array_unique(
                    (array)$imageNames
                )
            )
        );
        $transferStatus = array_values(
            array_filter(
                array_unique(
                    (array)$transferStatus
                )
            )
        );

        natcasesort($userNames);
        natcasesort($sourceSite);
        natcasesort($destSite);
        natcasesort($imageNames);
        natcasesort($transferStatus);

        if (is_array($userNames) && count($userNames) > 0) {
            $userSelForm = self::selectForm(
                'usersearch',
                $userNames
            );
            unset($userNames);
        }
        if (is_array($sourceSite) && count($sourceSite) > 0) {
            $sourceSelForm = self::selectForm(
                'sourcesearch',
                $sourceSite
            );
            unset($sourceSite);
        }
        if (is_array($destSite) && count($destSite) > 0) {
            $destSelForm = self::selectForm(
                'destsearch',
                $destSite
            );
            unset($destSite);
        }
        if (is_array($imageNames) && count($imageNames) > 0) {
            $imageSelForm = self::selectForm(
                'imagesearch',
                $imageNames
            );
            unset($imageNames);
        }
        if (is_array($transferStatus) && count($transferStatus) > 0) {
            $transferStatusSelForm = self::selectForm(
                'transferstatussearch',
                $transferStatus
            );
            unset($transferStatus);
        }
        

        $fields = array(
                '<label for="usersearch">'
                . _('Enter an create by to search for')
                . '</label>' => $userSelForm,
                '<label for="sourcesearch">'
                . _('Enter an source site to search for')
                . '</label>' => $sourceSelForm,
                '<label for="destsearch">'
                . _('Enter an destination site to search for')
                . '</label>' => $destSelForm,
                '<label for="imagesearch">'
                . _('Enter a image name to search for')
                . '</label>' => $imageSelForm,
                '<label for="transferstatussearch">'
                . _('Enter a transfer status to search for')
                . '</label>' => $transferStatusSelForm,
                '<label for="performsearch">'
                . _('Perform search')
                . '</label>' => '<button type="submit" name="performsearch" '
                . 'class="btn btn-info btn-block" id="performsearch">'
                . _('Search')
                . '</button>'
                );
        
        array_walk($fields, $this->fieldsToData);
        echo '<div class="col-xs-9">';
        echo '<div class="panel panel-info">';
        echo '<div class="panel-heading text-center">';
        echo '<h4 class="title">';
        echo $this->title;
        echo '</h4>';
        echo '</div>';
        echo '<div class="panel-body">';
        echo '<form class="form-horizontal" method="post" action="'
                     . $this->formAction
                     . '">';
        $this->render(12);
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    
    /**
     * Active transfer history filter
     *
     * @return void
     */
    public function imageTransferHistoryPost()
    {
        //START Report Filtering
        $usersearch = filter_input(
            INPUT_POST,
            'usersearch'
        );
        $sourcesearch = filter_input(
            INPUT_POST,
            'sourcesearch'
        );
        $destsearch = filter_input(
            INPUT_POST,
            'destsearch'
        );
        $imagesearch = filter_input(
            INPUT_POST,
            'imagesearch'
        );
        $transferstatussearch = filter_input(
            INPUT_POST,
            'transferstatussearch'
        );
        
        if (!$usersearch) {
            $usersearch = '%';
        }
        if (!$sourcesearch) {
            $sourcesearch = '%';
        }
        if (!$destsearch) {
            $destsearch = '%';
        }
        if (!$imagesearch) {
            $imagesearch = '%';
        }
        if (!$transferstatussearch) {
            $transferstatussearch = '%';
        }

        $userIDs = self::getSubObjectIDs(
            'User',
            array('name' => $usersearch)
        );

        $transferstatus = self::getSubObjectIDs(
            'ImageTransferStates',
            array('name' => $transferstatussearch)
        );
        //END Report Filtering

        $this->title = _('Image Transfer History Report');
 
        $csvHead = array(
            _('Created By') => 'createdBy',
            _('Source') => 'source',
            _('Destination') => 'destination',
            _('Image Name') => 'imageName',
            _('Image Size On Client') => 'imageSize',
            _('Start Time') => 'startTime',
            _('End Time') => 'endTime',
            _('Duration') => 'duration',
            _('Transfer Rate') => 'transferRate',
            _('Transfer Status') => 'transferStatus',
            _('Status Remark') => 'statusRemark',
        );

        $this->ReportMaker = self::getClass('ReportMaker');
        
        foreach ((array)$csvHead as $csvHeader => &$classGet) {
            $this->ReportMaker->addCSVCell($csvHeader);
            unset($classGet);
        }
        $this->ReportMaker->endCSVLine();

        $this->headerData = array(
            _('Created By'),
            _('Source'),
            _('Destination'),
            _('Image Name'),
            _('Image Size On Client'),
            _('Start Time'),
            _('End Time'),
            _('Duration'),
            _('Transfer Status'),
        );
        $this->templates = array(
            '${createdBy}',
            '${source}',
            '${destination}',
            '${imageName}',
            '${imageSize}',
            '${startTime}',
            '${endTime}',
            '${duration}',
            '${transferStatus}',
        );

        Route::listem(
            'ImageTransfer',
            'name',
            'false',
            array(
                'user' => $userIDs,
                'source' => $sourcesearch,
                'destination' => $destsearch,
                'imageName' => $imagesearch,
                'statusID' => $transferstatus
         )
        );
        
        $TransferLogs = json_decode(
            Route::getData()
        );
        $TransferLogs = $TransferLogs->imagetransfers;

        foreach ((array)$TransferLogs as &$TransferLog) 
        {
            //START Report Columns
            $createdBy = (
                $TransferLog->user ?:
                self::$FOGUser->get('name')
            );
            $createdBy = self::getSubObjectIDs(
                'User',
                array('id' => $TransferLog->user ),
                'name'
            );
            $createdBy = implode($createdBy);

            $source = $TransferLog->source;
            $destination = $TransferLog->destination;
            $imageName = $TransferLog->imageName;
            $imageSize = $TransferLog->imageSize;
            $startTime = $TransferLog->startTime;
            $endTime = $TransferLog->endTime;
            $imageSize_formated = self::formatByteSize(
                array_sum(
                    explode(
                        ':',
                        $imageSize 
                    )
                )
            );
            $transferRate = $TransferLog->transferRate;
            $transferStatus = self::getSubObjectIDs(
                'ImageTransferStates',
                array('id' => $TransferLog->statusID ),
                'name'
            );
            $transferStatus = implode($transferStatus);
            $statusRemark = $TransferLog->statusRemark;

            if (!self::validDate($startTime)) {
                continue;
            }
            if($endTime != 0)
                $diff = self::diff($startTime, $endTime);
            else   
            $endTime = '';
            //END Report Columns

            unset($TransferLog);
    
            $this->data[] = array(
                'createdBy' => $createdBy,
                'source' => $source,
                'destination' => $destination,
                'imageName' => $imageName,
                'imageSize' => $imageSize_formated,
                'startTime' => $startTime,
                'endTime' => $endTime,
                'duration' => $diff,
                'transferRate' => $transferRate,
                'transferStatus' => $transferStatus,
                'statusRemark' => $statusRemark
            );
            $this->ReportMaker
                ->addCSVCell($createdBy)
                ->addCSVCell($source)
                ->addCSVCell($destination)
                ->addCSVCell($imageName)
                ->addCSVCell($imageSize_formated)
                ->addCSVCell($startTime)
                ->addCSVCell($endTime)
                ->addCSVCell($diff)
                ->addCSVCell($transferRate)
                ->addCSVCell($transferStatus)
                ->addCSVCell($statusRemark)
                ->endCSVLine();

            unset(
                $createdBy,
                $source,
                $destination,
                $imageName,
                $imageSize,
                $imageSize_formated,
                $startTime,
                $endTime,
                $diff,
                $transferRate,
                $transferStatus,
                $statusRemark
            );


        }
        $this->ReportMaker->appendHTML($this->process(12));
        echo '<div class="col-xs-9">';
        echo '<div class="panel panel-info">';
        echo '<div class="panel-heading text-center">';
        echo '<h4 class="title">';
        echo $this->title;
        echo '</h4>';
        echo '</div>';
        echo '<div class="panel-body">';
        if (is_array($this->data) && count($this->data) > 0) {
            echo '<div class="text-center">';
            printf(
                $this->reportString,
                'ImageTransferHistory',
                _('Export CSV'),
                _('Export CSV'),
                self::$csvfile,
                'ImageTransferHistory',
                _('Export PDF'),
                _('Export PDF'),
                self::$pdffile
            );
            echo '</div>';
        }
        $this->ReportMaker->outputReport(0, true);
        echo '</div>';
        echo '</div>';
        echo '</div>';
        $_SESSION['foglastreport'] = serialize($this->ReportMaker);

    }
    
}

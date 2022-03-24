<?php
/**
 * Presents the page the same to all.
 *
 * PHP version 5
 *
 * @category Index
 * @package  FOGProject
 * @author   Tom Elliott <tommygunsster@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0 GPLv3
 * @link     https://fogproject.org
 */
/**
 * Presents the page the same to all.
 *
 * @category Index
 * @package  FOGProject
 * @author   Tom Elliott <tommygunsster@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0 GPLv3
 * @link     https://fogproject.org
 */
echo '<!DOCTYPE html>';
echo '<html lang="'
    . ProcessLogin::getLocale()
    . '">';
echo '<head>';
echo '<meta charset="utf-8"/>';
echo '<meta http-equiv="X-UA-Compatible" content="IE=edge"/>';
echo '<meta name="viewport" content="width=device-width, initial-scale=1"/>';
echo '<title>' . $this->pageTitle . '</title>';
self::$HookManager
    ->processEvent(
        'CSS',
        array(
            'stylesheets' => &$this->stylesheets
        )
    );
foreach ((array)$this->stylesheets as &$stylesheet) {
    echo '<link href="'
        . $stylesheet
        . '?ver='
        . FOG_BCACHE_VER
        . '" rel="stylesheet" type="text/css"/>';
    unset($stylesheet);
}
unset($this->stylesheets);
echo '<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>';
echo '</head>';
echo '<body >';
if (self::$FOGUser->isValid()) {
    /**
     * Navigation items
     */
    //CES_CUSTOMIZATION 20220323 START  
    //echo '<nav class="navbar navbar-inverse navbar-fixed-top">';
    echo '<nav class="navbar navbar-fixed-top" style="background-color: #f8f8f8;border-color: #337AB7">';
    //CES_CUSTOMIZATION 20220323 END        
    echo '<div class="container-fluid">';
    echo '<div class="navbar-header">';
    echo '<button type="button" class="navbar-toggle collapsed" data-toggle="'
        . 'collapse" data-target=".navbar-collapse">';
    echo '<span class="sr-only">'
        . _('Toggle Navigation')
        . '</span>';
    echo '<span class="icon-bar"></span>';
    echo '<span class="icon-bar"></span>';
    echo '<span class="icon-bar"></span>';
    echo '</button>';
    echo '</div>';
    echo '<div class="collapse navbar-collapse">';
    echo '<ul class="nav navbar-nav">';
    echo '<a class="navbar-brand" href="../management/index.php?node=home">';
    //CES_CUSTOMIZATION 20220301 START  
    //echo '<b>FOG</b> Project';
    echo '<p> <img style="width:40%;position:relative" src="../pxelhdr.png" class="logoimg" alt="'._('FOG Project') . '"/> ' . '(' .FOG_VERSION_CES .') </p>';
    //CES_CUSTOMIZATION 20220301 END        
    echo '</a>';
    self::getSearchForm();
    echo $this->menu;
    self::getLogout();
    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</nav>';
    self::$HookManager
        ->processEvent(
            'CONTENT_DISPLAY',
            array(
                'content' => &$this->body,
                'sectionTitle' => &$this->sectionTitle,
                'pageTitle' => &$this->pageTitle
            )
        );
    /**
     * Main Content
     */
    echo '<div class="container-fluid'
        . (
            $this->isHomepage ?
            ' dashboard' :
            ''
        )
        . '">';

    //CES_CUSTOMIZATION 20220302 START localized edit mode with :
    if(strpos($this->sectionTitle,":") == true)
        $this->sectionTitle = _(substr($this->sectionTitle,0,strpos($this->sectionTitle,":"))) .substr($this->sectionTitle,strpos($this->sectionTitle,":"));
    //CES_CUSTOMIZATION 20220302 END localized

    echo '<div class="panel panel-primary">';
    echo '<div class="panel-heading text-center">';
    echo '<h4 class="title">'
        . _($this->sectionTitle)
        . '</h4>';
    if (self::$FOGUser->isValid && $this->pageTitle) {
        echo '<h5 class="title">'
            . $this->pageTitle
            . '</h5>';
    }
    echo '</div>';
    echo '<input type="hidden" class="fog-delete" id="FOGDeleteAuth" value="'
        . (int)self::$fogdeleteactive
        . '"/>';
    echo '<input type="hidden" class="fog-export" id="FOGExportAuth" value="'
        . (int)self::$fogexportactive
        . '"/>';
    echo '<input type="hidden" class="fog-variable" id="screenview" value="'
        . self::$defaultscreen
        . '"/>';
    echo '<div class="panel-body">';
    self::getMenuItems();
    self::getMainSideMenu();
    echo $this->body;
    echo '</div>';
    echo '</div>';
    echo '</div>';
} else {
    //CES_CUSTOMIZATION 20220323 START     
    //echo '<nav class="navbar navbar-inverse navbar-fixed-top">';
    //echo '<nav class="navbar navbar-fixed-top" style="background-color: #f8f8f8;border-color: #337AB7">';
    //CES_CUSTOMIZATION 20220323 END     
    echo '<div class="container-fluid">';
    echo '<div class="navbar-header">';
    echo '<button type="button" class="navbar-toggle collapsed" data-toggle="'
        . 'collapse" data-target=".navbar-collapse">';
    echo '<span class="sr-only">'
        . _('Toggle Navigation')
        . '</span>';
    echo '<span class="icon-bar"></span>';
    echo '<span class="icon-bar"></span>';
    echo '<span class="icon-bar"></span>';
    echo '</button>';
    echo '</div>';
    echo '<div class="collapse navbar-collapse">';
    echo '<ul class="nav navbar-nav">';
    echo '<a class="navbar-brand" href="../management/index.php?node=home">';
    //CES_CUSTOMIZATION 20220301 START        
    //echo '<b>FOG</b> Project';
    //echo _('FOG Project');
    //echo '<p> <img style="width:100%;position:relative" src="../pxelhdr.png" class="logoimg" alt="'._('FOG Project') . '"/> </p>';
    //CES_CUSTOMIZATION 20220301 END        
    echo '</a>';
    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</nav>';
    /**
     * Main Content
     */
    echo '<div class="container-fluid'
        . (
            $this->isHomepage ?
            ' dashboard' :
            ''
        )
        . '">';
    echo $this->body;
    echo '</div>';
}
     
echo '<div class="collapse navbar-collapse" style="visibility:hidden;display:none" >'; //CES_CUSTOMIZATION 20220301 (Hide footer)   
echo '<footer class="footer">';
echo '<nav class="navbar navbar-inverse navbar-fixed-bottom">';
echo '<div class="container-fluid">';
echo '<ul class="nav navbar-nav">';
echo '<li><a href="https://wiki.fogproject.org/wiki/index.php?title=Credits">'
    . _('Credits')
    . '</a></li>';
echo '<li><a href="?node=client">'
    . _('FOG Client')
    . '</a></li>';
echo '<li><a href="https://www.paypal.com/cgi-bin/webscr?item_name=Donation'
    . '+to+FOG+-+A+Free+Cloning+Solution&cmd=_donations&business=fogproject.org'
    . '@gmail.com" target="_blank">'
    . _('Donate to FOG')
    . '</a></li>';
if (self::$FOGUser->isValid()) {
    echo '<li class="pull-right">';
    echo '<a href="../management/index.php?node=about">';
    echo '<b>';
    echo _('Version');
    echo '</b> ';
    echo FOG_VERSION;
    echo '</a>';
    echo '</li>';
}
echo '</ul>';
echo '</div>';
echo '</nav>';
echo '</footer>';
echo '</div>';


foreach ((array)$this->javascripts as &$javascript) {
    echo '<script src="'
        . $javascript
        . '?ver='
        . FOG_BCACHE_VER
        . '" type="text/javascript"></script>';
    unset($javascript);
}
unset($this->javascripts);
echo '<!-- Memory Usage: ';
echo self::formatByteSize(memory_get_usage(true));
echo '-->';
echo '<!-- Memory Peak: ';
echo self::formatByteSize(memory_get_peak_usage());
echo '-->';
echo '</body>';
echo '</html>';

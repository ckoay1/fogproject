<?php
/**
 * Presents the About Us page.
 *
 * PHP version 5
 *
 * @category AboutUsPage
 * @package  FOGProject
 * @author   WeiTheng
 */

 class AboutUsPage extends FOGPage
 {
    /**
     * The node that uses this item
     *
     * @var string
     */
    public $node = 'aboutus';
    /**
     * Initialize the plugin page
     *
     * @param string $name the name of the page.
     *
     * @return false;
     */
    public function __construct($name = '')
    {
        $this->name = 'About Us';
        parent::__construct($this->name);
        $this->menu = array();
     
    }
    /**
     * The basic function / home page of the class if you will
     *
     * @return void
     */
    public function index()
    {
        $this->title = _('About Us');

        echo '<div class="row">';
            echo '<div class="col-md-12">';
            echo '<div class="panel panel-info">';
                echo '<div class="panel-heading text-center">';
                    echo '<h4 class="title">';
                    echo '<b>PXE</b> for va<b>L</b>idation (PXEL)';
                    echo '</h4>';
                echo '</div>';
                echo '<div class="panel-body">';

                echo '<table class="table table-responsive">';
        
                echo '<tbody>';
                //row
                echo '<tr class="home">';
                echo '<td class="col-xs-2">PXEL Team</td>';
                echo '<td class="col-xs-10">iVE > VLA > VCS > CES </td>';
                echo '</tr>';
                //row
                echo '<tr class="home">';
                echo '<td class="col-xs-2">PXEL Version</td>';
                echo '<td class="col-xs-10">' .FOG_VERSION_CES .'</td>';
                echo '</tr>';
                //row
                echo '<tr class="home">';
                echo '<td class="col-xs-2">PXEL Wiki</td>';
                echo '<td class="col-xs-10"><a href="https://wiki.ith.intel.com/display/OSDeploy" target="_blank"> Visit Here </a></td>';
                echo '</tr>';
                //row
                echo '<tr class="home">';
                echo '<td class="col-xs-2">Support Model (SLA)</td>';
                echo '<td class="col-xs-10"><a href="https://wiki.ith.intel.com/display/OSDeploy/Support+Model" target="_blank"> Visit Here </a></td>';
                echo '</tr>';
                //row
                echo '<tr class="home">';
                echo '<td class="col-xs-2">New Request & Support </td>';
                echo '<td class="col-xs-10"><a href="https://hsdes.intel.com/appstore/gts/#/newticket" target="_blank"> Visit Here </a>';
                echo '(File ticket at <b>HSD > tool support</b> with component <b>tool.pxel</b>)</td>';
                echo '</tr>';
                //row
                echo '<tr class="home">';
                echo '<td class="col-xs-2">Powered By</td>';
                echo '<td class="col-xs-10">FOG Project</td>';
                echo '</tr>';
                //row
                echo '</tbody>';
                echo '</table>';

                echo '</div>';
            echo '</div>';
            echo '</div>';

        echo '</div>';


    }


}

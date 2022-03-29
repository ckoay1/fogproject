<?php
/**
 * Presents the About Us page.
 *
 * PHP version 5
 *
 * @category AboutUsPage
 * @package  FOGProject
 * @author   CES Team <ive.vla.sre.ces@intel.com>
 */
/**
 * Presents the About Us page.
 *
 * @category AboutUsPage
 * @package  FOGProject
 * @author   CES Team <ive.vla.sre.ces@intel.com>
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
                echo '<td class="col-xs-2">PXEL Wiki</td>';
                echo '<td class="col-xs-10"><a href="https://wiki.ith.intel.com/display/OSDeploy"> Wiki Site </a> </td>';
                echo '</tr>';
                echo '<tr class="home">';
                echo '<td class="col-xs-2">PXEL Team</td>';
                echo '<td class="col-xs-10">iVE (intel Validation Engineering) > VLA (Validation Labs & Automation) > VCS (Validation Cloud Solutions) > CES (Cloud & Engineering Solutions) </td>';
                echo '</tr>';
                //row
                echo '<tr class="home">';
                echo '<td class="col-xs-2">PXEL Team Contact</td>';
                echo '<td class="col-xs-10"><a href="mailto:ive.vla.sre.ces@intel.com">Email Us</a></td>';
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

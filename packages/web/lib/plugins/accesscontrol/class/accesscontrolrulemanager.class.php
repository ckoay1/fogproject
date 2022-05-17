<?php
/**
 * Access Control plugin
 *
 * PHP version 5
 *
 * @category AccessControlRuleManager
 * @package  FOGProject
 * @author   Fernando Gietz <fernando.gietz@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0 GPLv3
 * @link     https://fogproject.org
 */
/**
 * Access Control plugin
 *
 * @category AccessControlRuleManager
 * @package  FOGProject
 * @author   Fernando Gietz <fernando.gietz@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0 GPLv3
 * @link     https://fogproject.org
 */
class AccessControlRuleManager extends FOGManagerController
{
    /**
     * Table name
     *
     * @var string
     */
    public $tablename = 'rules';
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
                'ruleID',
                'ruleName',
                'ruleType',
                'ruleValue',
                'ruleParent',
                'ruleCreatedBy',
                'ruleCreatedTime',
                'ruleNode'
            ),
            array(
                'INTEGER',
                'VARCHAR(40)',
                'VARCHAR(40)',
                'VARCHAR(100)',  //CES_CUSTOMIZATION 20220302 START (Increase ruleValue cater sub page)
                'VARCHAR(40)',
                'VARCHAR(40)',
                'TIMESTAMP',
                'VARCHAR(40)'
            ),
            array(
                false,
                false,
                false,
                false,
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
                false,
                'CURRENT_TIMESTAMP',
                false
            ),
            array(),
            'MyISAM',
            'utf8',
            'ruleID',
            'ruleID'
        );
        if (!self::$DB->query($sql)) {
            return false;
        }
        $sql = 'INSERT INTO '
            . $this->tablename
            . ' VALUES '
            . '(2, "MAIN_MENU-user", "MAIN_MENU", "user", '
            . '"main", "fog", NOW(), NULL), '
            . '(3, "MAIN_MENU-host", "MAIN_MENU", "host", '
            . '"main", "fog", NOW(), NULL), '
            . '(4, "MAIN_MENU-group", "MAIN_MENU", "group", '
            . '"main", "fog", NOW(), NULL), '
            . '(5, "MAIN_MENU-image", "MAIN_MENU", "image", '
            . '"main", "fog", NOW(), NULL), '
            . '(6, "MAIN_MENU-storage", "MAIN_MENU", "storage", '
            . '"main", "fog", NOW(), NULL), '
            . '(7, "MAIN_MENU-snapin", "MAIN_MENU", "snapin", '
            . '"main", "fog", NOW(), NULL), '
            . '(8, "MAIN_MENU-printer", "MAIN_MENU", "printer", '
            . '"main", "fog", NOW(), NULL), '
            . '(9, "MAIN_MENU-service", "MAIN_MENU", "service", '
            . '"main", "fog", NOW(), NULL), '
            . '(10, "MAIN_MENU-task", "MAIN_MENU", "task", '
            . '"main", "fog", NOW(), NULL), '
            . '(11, "MAIN_MENU-report", "MAIN_MENU", "report", '
            . '"main", "fog", NOW(), NULL), '
            . '(12, "MAIN_MENU-plugin", "MAIN_MENU", "plugin", '
            . '"main", "fog", NOW(), NULL), '
            . '(13, "MAIN_MENU-about", "MAIN_MENU", "about", '
            . '"main", "fog", NOW(), NULL), '
            . '(14, "SUB_MENULINK-list", "SUB_MENULINK", "list", '
            . '"menu", "fog", NOW(), NULL), '
            . '(15, "SUB_MENULINK-search", "SUB_MENULINK", "search", '
            . '"menu", "fog", NOW(), NULL), '
            . '(16, "SUB_MENULINK-import", "SUB_MENULINK", "import", '
            . '"menu", "fog", NOW(), NULL), '
            . '(17, "SUB_MENULINK-export", "SUB_MENULINK", "export", '
            . '"menu", "fog", NOW(), NULL), '
            . '(18, "SUB_MENULINK-add", "SUB_MENULINK", "add", '
            . '"menu", "fog", NOW(), NULL), '
            . '(19, "SUB_MENULINK-multicast", "SUB_MENULINK", "multicast", '
            . '"menu", "fog", NOW(), "image"), '
            . '(20, "SUB_MENULINK-storageGroup", "SUB_MENULINK", "storageGroup", '
            . '"menu", "fog", NOW(), "storage"), '
            . '(21, "SUB_MENULINK-addStorageNode", "SUB_MENULINK", '
            . '"addStorageNode", "menu", "fog", NOW(), "storage"), '
            . '(22, "SUB_MENULINK-addStorageGroup", "SUB_MENULINK", '
            . '"addStorageGroup", "menu", "fog", NOW(), "storage"), '
            . '(23, "SUB_MENULINK-actice", "SUB_MENULINK", '
            . '"active", "menu", "fog", NOW(), "task"), '
            . '(24, "SUB_MENULINK-listhosts", "SUB_MENULINK", "listhosts", '
            . '"menu", "fog", NOW(), "task"), '
            . '(25, "SUB_MENULINK-listgroups", "SUB_MENULINK", '
            . '"listgroups", "menu", "fog", NOW(), "task"), '
            . '(26, "SUB_MENULINK-activemulticast", "SUB_MENULINK", '
            . '"activemulticast", "menu", "fog", NOW(), "task"), '
            . '(27, "SUB_MENULINK-activesnapins", "SUB_MENULINK", '
            . '"activesnapins", "menu", "fog", NOW(), "task"), '
            . '(28, "SUB_MENULINK-activescheduled", "SUB_MENULINK", '
            . '"activescheduled", "menu", "fog", NOW(), "task"), '
            . '(29, "SUB_MENULINK-home", "SUB_MENULINK", "home", '
            . '"menu", "fog", NOW(), "about"), '
            . '(30, "SUB_MENULINK-license", "SUB_MENULINK", '
            . '"license", "menu", "fog", NOW(), "about"), '
            . '(31, "SUB_MENULINK-kernelUpdate", "SUB_MENULINK", '
            . '"kernelUpdate", "menu", "fog", NOW(), "about"), '
            . '(32, "SUB_MENULINK-pxemenu", "SUB_MENULINK", '
            . '"pxemenu", "menu", "fog", NOW(), "about"), '
            . '(33, "SUB_MENULINK-customizepxe", "SUB_MENULINK", '
            . '"customizepxe", "menu", "fog", NOW(), "about"), '
            . '(34,"SUB_MENULINK-newmenu","SUB_MENULINK", '
            . '"newmenu", "menu", "fog", NOW(), "about"), '
            . '(35, "SUB_MENULINK-clientupdater", "SUB_MENULINK", '
            . '"clientupdater", "menu", "fog", NOW(), "about"), '
            . '(36, "SUB_MENULINK-maclist", "SUB_MENULINK", '
            . '"maclist", "menu", "fog", NOW(), "about"), '
            . '(37, "SUB_MENULINK-settings", "SUB_MENULINK", '
            . '"settings", "menu", "fog", NOW(), "about"), '
            . '(38, "SUB_MENULINK-logviewer", "SUB_MENULINK", '
            . '"logviewer", "menu", "fog", NOW(), "about"), '
            . '(39, "SUB_MENULINK-config", "SUB_MENULINK", '
            . '"config", "menu", "fog", NOW(), "about"), '
            //CES_CUSTOMIZATION 20220302 START (CES Rules)
            //host sub tabs(13)
            . '(40, "SUB_MENULINK-host-tasks", "SUB_MENULINK", '
            . '"?node=host&sub=edit&id=#host-tasks", "submenu", "fog", NOW(), "host"), '
            . '(41, "SUB_MENULINK-host-active-directory", "SUB_MENULINK", '
            . '"?node=host&sub=edit&id=#host-active-directory", "submenu", "fog", NOW(), "host"), '
            . '(42, "SUB_MENULINK-host-printers", "SUB_MENULINK", '
            . '"?node=host&sub=edit&id=#host-printers", "submenu", "fog", NOW(), "host"), '
            . '(43, "SUB_MENULINK-host-snapins", "SUB_MENULINK", '
            . '"?node=host&sub=edit&id=#host-snapins", "submenu", "fog", NOW(), "host"), '
            . '(44, "SUB_MENULINK-host-service", "SUB_MENULINK", '
            . '"?node=host&sub=edit&id=#host-service", "submenu", "fog", NOW(), "host"), '
            . '(45, "SUB_MENULINK-host-powermanagement", "SUB_MENULINK", '
            . '"?node=host&sub=edit&id=#host-powermanagement", "submenu", "fog", NOW(), "host"), '
            . '(46, "SUB_MENULINK-host-hardware-inventory", "SUB_MENULINK", '
            . '"?node=host&sub=edit&id=#host-hardware-inventory", "submenu", "fog", NOW(), "host"), '
            . '(47, "SUB_MENULINK-host-virus-history", "SUB_MENULINK", '
            . '"?node=host&sub=edit&id=#host-virus-history", "submenu", "fog", NOW(), "host"), '
            . '(48, "SUB_MENULINK-host-login-history", "SUB_MENULINK", '
            . '"?node=host&sub=edit&id=#host-login-history", "submenu", "fog", NOW(), "host"), '
            . '(49, "SUB_MENULINK-host-image-history", "SUB_MENULINK", '
            . '"?node=host&sub=edit&id=#host-image-history", "submenu", "fog", NOW(), "host"), '
            . '(50, "SUB_MENULINK-host-snapin-history", "SUB_MENULINK", '
            . '"?node=host&sub=edit&id=#host-snapin-history", "submenu", "fog", NOW(), "host"), '
            . '(51, "SUB_MENULINK-membership", "SUB_MENULINK", '
            . '"?node=host&sub=membership&id=", "submenu", "fog", NOW(), "host"), '
            . '(52, "SUB_MENULINK-delete", "SUB_MENULINK", '
            . '"?node=host&sub=delete&id=", "submenu", "fog", NOW(), "host"), '
            
            //reports(12)
            . '(53, "SUB_MENULINK-equipment_loan", "SUB_MENULINK", '
            . '"?node=report&sub=file&f=equipment loan", "menu", "fog", NOW(), "report"), '
            . '(54, "SUB_MENULINK-history_report", "SUB_MENULINK", '
            . '"?node=report&sub=file&f=history report", "menu", "fog", NOW(), "report"), '
            . '(55, "SUB_MENULINK-host_list", "SUB_MENULINK", '
            . '"?node=report&sub=file&f=host list", "menu", "fog", NOW(), "report"), '
            . '(56, "SUB_MENULINK-hosts_and_users", "SUB_MENULINK", '
            . '"?node=report&sub=file&f=hosts and users", "menu", "fog", NOW(), "report"), '
            . '(57, "SUB_MENULINK-imaging_log", "SUB_MENULINK", '
            . '"?node=report&sub=file&f=imaging log", "menu", "fog", NOW(), "report"), '
            . '(58, "SUB_MENULINK-inventory_report", "SUB_MENULINK", '
            . '"?node=report&sub=file&f=inventory report", "menu", "fog", NOW(), "report"), '
            . '(59, "SUB_MENULINK-pending_mac_list", "SUB_MENULINK", '
            . '"?node=report&sub=file&f=pending mac list", "menu", "fog", NOW(), "report"), '
            . '(60, "SUB_MENULINK-product_keys", "SUB_MENULINK", '
            . '"?node=report&sub=file&f=product keys", "menu", "fog", NOW(), "report"), '
            . '(61, "SUB_MENULINK-snapin_log", "SUB_MENULINK", '
            . '"?node=report&sub=file&f=snapin log", "menu", "fog", NOW(), "report"), '
            . '(62, "SUB_MENULINK-user_tracking", "SUB_MENULINK", '
            . '"?node=report&sub=file&f=user tracking", "menu", "fog", NOW(), "report"), '
            . '(63, "SUB_MENULINK-virus_history", "SUB_MENULINK", '
            . '"?node=report&sub=file&f=virus history", "menu", "fog", NOW(), "report"), '
            . '(64, "SUB_MENULINK-upload", "SUB_MENULINK", '
            . '"upload", "menu", "fog", NOW(), "report"), '

            //groups
            . '(65, "SUB_MENULINK-group-image", "SUB_MENULINK", '
            . '"?node=group&sub=edit&id=#group-image", "submenu", "fog", NOW(), "group"), '
            . '(66, "SUB_MENULINK-group-tasks", "SUB_MENULINK", '
            . '"?node=group&sub=edit&id=#group-tasks", "submenu", "fog", NOW(), "group"), '
            . '(67, "SUB_MENULINK-group-active-directory", "SUB_MENULINK", '
            . '"?node=group&sub=edit&id=#group-active-directory", "submenu", "fog", NOW(), "group"), '
            . '(68, "SUB_MENULINK-group-printers", "SUB_MENULINK", '
            . '"?node=group&sub=edit&id=#group-printers", "submenu", "fog", NOW(), "group"), '
            . '(69, "SUB_MENULINK-group-snapins", "SUB_MENULINK", '
            . '"?node=group&sub=edit&id=#group-snapins", "submenu", "fog", NOW(), "group"), '
            . '(70, "SUB_MENULINK-group-service", "SUB_MENULINK", '
            . '"?node=group&sub=edit&id=#group-service", "submenu", "fog", NOW(), "group"), '
            . '(71, "SUB_MENULINK-group-powermanagement", "SUB_MENULINK", '
            . '"?node=group&sub=edit&id=#group-powermanagement", "submenu", "fog", NOW(), "group"), '
            . '(72, "SUB_MENULINK-inventory", "SUB_MENULINK", '
            . '"?node=group&sub=inventory&id=", "submenu", "fog", NOW(), "group"), '
            . '(73, "SUB_MENULINK-membership", "SUB_MENULINK", '
            . '"?node=group&sub=membership&id=", "submenu", "fog", NOW(), "group"), '
            . '(74, "SUB_MENULINK-delete", "SUB_MENULINK", '
            . '"?node=group&sub=delete&id=", "submenu", "fog", NOW(), "group"), '

            //others
            . '(75, "MAIN_MENU-accesscontrol", "SUB_MENULINK", '
            . '"accesscontrol", "main", "fog", NOW(), ""),'
            . '(76, "FEATURE-imagetransfer", "FEATURE", '
            . '"all-site-transfer", "", "fog", NOW(), "")'

            //CES_CUSTOMIZATION 20220302 END
            ;
        if (self::$DB->query($sql)) {
            $sql = "CREATE UNIQUE INDEX `indexmul` "
                    . "`rules` (`ruleValue`, `ruleNode`)";
            self::$DB->query($sql);
            return self::getClass('AccessControlRuleAssociationManager')->install();
        } else {
            return true;
        }
    }
    /**
     * Uninstalls the plugin
     *
     * @return bool
     */
    public function uninstall()
    {
        self::getClass('AccessControlRuleAssociationManager')->uninstall();
        return parent::uninstall();
    }
}

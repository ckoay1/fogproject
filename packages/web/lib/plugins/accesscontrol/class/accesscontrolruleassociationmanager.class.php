<?php
/**
 * Access Control plugin
 *
 * PHP version 5
 *
 * @category AccessControlRuleAssociationManager
 * @package  FOGProject
 * @author   Fernando Gietz <fernando.gietz@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0 GPLv3
 * @link     https://fogproject.org
 */
/**
 * Access Control plugin
 *
 * @category AccessControlRuleAssociationManager
 * @package  FOGProject
 * @author   Fernando Gietz <fernando.gietz@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0 GPLv3
 * @link     https://fogproject.org
 */
class AccessControlRuleAssociationManager extends FOGManagerController
{
    /**
     * The table name.
     *
     * @var string
     */
    public $tablename = 'roleRuleAssoc';
    /**
     * Installs the database for the plugin.
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
                'rraID',
                'rraName',
                'rraRoleID',
                'rraRuleID'
            ),
            array(
                'INTEGER',
                'VARCHAR(60)',
                'INTEGER',
                'INTEGER'
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
            array(
        array('rraRoleID','rraRuleID')
        ),
            'MyISAM',
            'utf8',
            'rraID',
            'rraID'
        );
        //CES_CUSTOMIZATION 20220302 START (default disabled module for lab users role)
        if (!self::$DB->query($sql)) {
            return false;
        } else {
            $sql = sprintf(
                "INSERT INTO `%s` VALUES"
                . "(1, '', 3, 2),"
                . "(2, '', 3, 6),"
                . "(3, '', 3, 7),"
                . "(4, '', 3, 8),"
                . "(5, '', 3, 9),"
                . "(6, '', 3, 12),"
                . "(7, '', 3, 13),"
                . "(8, '', 3, 27),"
                . "(9, '', 3, 28),"
                . "(10, '', 3, 41),"
                . "(11, '', 3, 42),"
                . "(12, '', 3, 43),"
                . "(13, '', 3, 44),"
                . "(14, '', 3, 45),"
                . "(15, '', 3, 47),"
                . "(16, '', 3, 50),"
                . "(17, '', 3, 53),"
                . "(18, '', 3, 59),"
                . "(19, '', 3, 60),"
                . "(20, '', 3, 61),"
                . "(21, '', 3, 62),"
                . "(22, '', 3, 63),"
                . "(23, '', 3, 64),"
                . "(24, '', 3, 67),"
                . "(25, '', 3, 68),"
                . "(26, '', 3, 69),"
                . "(27, '', 3, 70),"
                . "(28, '', 3, 71),"
                . "(29, '', 3, 75),"
                . "(30, '', 3, 76)",
                $this->tablename
            );
            self::$DB->query($sql);
        }
        //CES_CUSTOMIZATION 20220302 END 

        if (self::$DB->query($sql)) {
            $sql = "CREATE UNIQUE INDEX `indexmul` "
                . "ON `roleRuleAssoc` (`rraRoleID`, `rraRuleID`)";
            return self::$DB->query($sql);
        }
        return false;
    }
    
    public function uninstall()
    {
        return parent::uninstall();
    }
}

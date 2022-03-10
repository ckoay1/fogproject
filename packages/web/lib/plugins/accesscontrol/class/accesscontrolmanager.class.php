<?php
/**
 * Access Control plugin
 *
 * PHP version 5
 *
 * @category AccessControlManager
 * @package  FOGProject
 * @author   Fernando Gietz <fernando.gietz@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0 GPLv3
 * @link     https://fogproject.org
 */
/**
 * Access Control plugin
 *
 * @category AccessControlManager
 * @package  FOGProject
 * @author   Fernando Gietz <fernando.gietz@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0 GPLv3
 * @link     https://fogproject.org
 */
class AccessControlManager extends FOGManagerController
{
    /**
     * The table name.
     *
     * @var string
     */
    public $tablename = 'roles';
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
                'rID',
                'rName',
                'rDesc',
                'rCreatedBy',
                'rCreatedTime'
            ),
            array(
                'INTEGER',
                'VARCHAR(255)',
                'LONGTEXT',
                'VARCHAR(40)',
                'TIMESTAMP'
            ),
            array(
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
                'CURRENT_TIMESTAMP'
            ),
            array(
                'rID',
                'rName'
            ),
            'MyISAM',
            'utf8',
            'rID',
            'rID'
        );

        if (!self::$DB->query($sql)) {
            return false;
        } else {
            $sql = sprintf(
                "INSERT INTO `%s` VALUES"
                . "(1, 'Administrator', 'PXEL Administrator', 'fog', NOW()),"
                . "(2, 'Technician', 'PXEL Technician', 'fog', NOW()),"
                . "(3, 'LabUsers', 'Lab Users', 'fog', NOW())", //CES_CUSTOMIZATION 20220302 (new ces role for lab user)
                $this->tablename
            );
            self::$DB->query($sql);
        }
        return self::getClass('AccessControlAssociationManager')->install();
    }
    /**
     * Uninstalls the plugin
     *
     * @return bool
     */
    public function uninstall()
    {
        self::getClass('AccessControlAssociationManager')->uninstall();
        return parent::uninstall();
    }
}

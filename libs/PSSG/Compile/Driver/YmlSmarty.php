<?php
/**
 *
 *
 * PHP versions 5
 *
 *
 * @category   %%project_category%%
 * @package    %%project_name%%
 * @subpackage %%subpackage_name%%
 * @author     Suzunone <suzunone.eleven@gmail.com>
 * @copyright %%your_project%%
 * @license    MIT LICENSE
 * @version    GIT: $Id$
 * @link %%your_link%%
 * @see %%your_see%%
 * @since      Class available since Release 1.0.0
*/
namespace PSSG\Compile\Driver;

$ds = DIRECTORY_SEPARATOR;

require_once PSSG_BASE_DIR."{$ds}libs{$ds}vendor{$ds}smarty3{$ds}libs{$ds}Smarty.class.php";

/**
 * @category   %%project_category%%
 * @package    %%project_name%%
 * @subpackage %%subpackage_name%%
 * @author     Suzunone <suzunone.eleven@gmail.com>
 * @copyright %%your_project%%
 * @license    MIT LICENSE
 * @version    GIT: $Id$
 * @link %%your_link%%
 * @see %%your_see%%
 * @since      Class available since Release 1.0.0
 */
class YmlSmarty extends Smarty
{
    /**
     * +--
     *
     * @access      public
     * @param       var_text $file_name
     * @return      string
     */
    public function compile($file_name)
    {
        ob_start();
        include $file_name;
        $setting_yml = ob_get_contents();
        ob_end_clean();
        $setting_yml =  spyc_load($setting_yml);
        $this->Smarty->assign('page', $setting_yml['page_variables']);
        if (is_file($setting_yml['file_name'])) {
            return $this->Smarty->fetch($setting_yml['file_name']);
        }

        return $this->Smarty->fetch(dirname($file_name).DIRECTORY_SEPARATOR.$setting_yml['file_name']);
    }
    /* ----------------------------------------- */

}

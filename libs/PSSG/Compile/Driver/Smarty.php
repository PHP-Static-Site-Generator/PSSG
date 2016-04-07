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
class Smarty extends Base
{
    protected $Smarty;

    /**
     * +-- コンストラクタ
     *
     * @access      public
     * @param       array $config
     * @return      void
     */
    public function __construct(array $config)
    {
        $this->Smarty = new \Smarty;
        $this->Smarty->left_delimiter = $config['option']['left_delimiter'];
        $this->Smarty->right_delimiter = $config['option']['right_delimiter'];
        $this->Smarty->force_compile = true;
        $this->Smarty->compile_dir = PSSG_BASE_DIR.DIRECTORY_SEPARATOR.'tmp';
        $this->Smarty->setDefaultModifiers(array('escape'));
    }
    /* ----------------------------------------- */

    /**
     * +--
     *
     * @access      public
     * @return      void
     */
    public function initialize()
    {
        $smarty_driver_variable = $this->PSSG->parseYML('smarty_driver_variable.yml');
        $this->Smarty->assign('site', $smarty_driver_variable);
    }
    /* ----------------------------------------- */

    /**
     * +-- 」
     *
     * @access      public
     * @param       var_text $file_name
     * @return      string
     */
    public function compile($file_name)
    {
        return $this->Smarty->fetch($file_name);
    }
    /* ----------------------------------------- */

    /**
     * +--
     *
     * @access      public
     * @return      void
     */
    public function Smarty()
    {
        return $this->Smarty;
    }
    /* ----------------------------------------- */
}

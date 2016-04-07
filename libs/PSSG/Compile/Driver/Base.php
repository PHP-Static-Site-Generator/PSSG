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


/**
 * @category   %%project_category%%
 * @package    %%project_name%%
 * @subpackage %%subpackage_name%%
 * @abstract
 * @author     Fumikazu Kitagawa<kitagawa@toplog.co.jp>
 * @copyright %%your_project%%
 * @license %%your_license%%
 * @version    GIT: $Id$
 * @link %%your_link%%
 * @see %%your_see%%
 * @since      Class available since Release 1.0.0
 */
abstract class Base
{

    public $PSSG;

    /**
     * +--
     *
     * @access      public
     * @abstract
     * @param       var_text $file_name
     * @return      void
     */
    abstract public function compile($file_path);
    /* ----------------------------------------- */

    /**
     * +--
     *
     * @access      public
     * @param       var_text $file_path
     * @return      void
     */
    public function display($file_path)
    {
        echo $this->compile($file_path);
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
    }
    /* ----------------------------------------- */

}

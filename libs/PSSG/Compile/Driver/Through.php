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
 * @author     Suzunone <suzunone.eleven@gmail.com>
 * @copyright %%your_project%%
 * @license    MIT LICENSE
 * @version    GIT: $Id$
 * @link %%your_link%%
 * @see %%your_see%%
 * @since      Class available since Release 1.0.0
 */
class Through extends Base
{
    /**
     * +-- コンストラクタ
     *
     * @access      public
     * @param       array $config
     * @return      void
     */
    public function __construct(array $config)
    {
    }
    /* ----------------------------------------- */

    /**
     * +--
     *
     * @access      public
     * @param       var_text $file_name
     * @return      string
     */
    public function compile($file_name)
    {
        return file_get_contents($file_name);
    }
    /* ----------------------------------------- */

}

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

require PSSG_BASE_DIR."{$ds}libs{$ds}vendor{$ds}scssphp{$ds}scss.inc.php";

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
class Scss extends Base
{
    protected $scss_php;

    /**
     * +-- コンストラクタ
     *
     * @access      public
     * @param       array $config
     * @return      void
     */
    public function __construct(array $config)
    {
        $this->scss_php = new \scssc;
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
        return $this->scss_php->compile(file_get_contents($file_name));
    }
    /* ----------------------------------------- */

}

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

namespace PSSG{
class AutoLoad{

    /**
     * +--
     *
     * @access      private
     * @static
     * @return      void
     * @codeCoverageIgnore
     */
    private function requireFile($file_path)
    {
        if (is_file($file_path)) {
            require $file_path;
        }

    }
    /* ----------------------------------------- */

    /**
     * +-- オートロード
     *
     * @param       var_text $className
     * @return      void
     */
    public function loadFile($className)
    {
        if (strpos($className, 'PSSG\\') === false) {
            return;
        }
        $className = ltrim($className, '\\');
        $fileName  = '';
        $namespace = '';
        $lastNsPos = strrpos($className, '\\');
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;

        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
        $file_path = dirname(__DIR__).DIRECTORY_SEPARATOR.'libs'.DIRECTORY_SEPARATOR.$fileName;

        $this->requireFile($file_path);
    }
}

function autoload($className)
{
    static $auto_load;
    if (empty($auto_load)) {
        $auto_load = new \PSSG\AutoLoad;
    }
    $auto_load->loadFile($className);
}
\spl_autoload_register('\PSSG\autoload');
}

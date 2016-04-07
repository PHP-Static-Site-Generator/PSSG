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
namespace PSSG\CLI\Server;

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
class Start extends \PSSG\CLI\Base
{
    /**
     * +-- 確認用サーバー起動
     *
     * @access      public
     * @return void
     */
    public function execute()
    {
        $project_dir = $this->argv[2];

        $project_dir .= DIRECTORY_SEPARATOR;

        $cmd = "php -t {$project_dir} -S localhost:7777 {$project_dir}__pssg.php" ;
        $this->secho('Show http://localhost:7777/');
        $this->secho('Press Ctrl-C to quit.');
        `$cmd`;
    }
    /* ----------------------------------------- */

    /**
     * +-- オプションチェック
     *
     * @access      public
     * @return void
     */
    public function optionCheck()
    {
        if (!isset($this->argv[2]) || !is_dir($this->argv[2])) {
            $this->argv[2] = getcwd();
        }
        if (!is_file($this->argv[2].DIRECTORY_SEPARATOR.'__pssg.php') || !is_dir($this->argv[2].DIRECTORY_SEPARATOR.'__config')) {
            $this->eecho($this->cli->createSampleCommand($this->argv[1], '{project directory path}'));
            throw new \PSSG\CLI\OptionException();
        }
    }
    /* ----------------------------------------- */
}

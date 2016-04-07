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
namespace PSSG\CLI\Project;

umask(0);

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
class Create extends Init
{
    /**
     * +-- プロジェクトの初期化
     *
     * @access      public
     * @return void
     */
    public function execute()
    {
        mkdir($this->argv[2], 0777, true);
        $project_dir = realpath($this->argv[2]);
        $this->initializeProject($project_dir);
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
            $this->eecho($this->cli->createSampleCommand($this->argv[1], '{project directory path}'));
            throw new \PSSG\CLI\OptionException();
        }
        if (is_file($this->argv[2]) || is_dir($this->argv[2])) {
            $this->eecho($this->argv[2].' is exists.');
            throw new \PSSG\CLI\OptionException();
        }
    }
    /* ----------------------------------------- */
}

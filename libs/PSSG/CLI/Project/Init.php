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
class Init extends \PSSG\CLI\Base
{
    /**
     * +-- プロジェクトの初期化
     *
     * @access      public
     * @return void
     */
    public function execute()
    {
        $project_dir = getcwd();
        $this->initializeProject($project_dir);

    }
    /* ----------------------------------------- */

    /**
     * +-- プロジェクトを初期化する
     *
     * @access      public
     * @param  var_text $project_dir
     * @return void
     */
    public function initializeProject($project_dir)
    {
        $ds = DIRECTORY_SEPARATOR;
        $project_dir .= $ds;
        $pssg_base_dir = PSSG_BASE_DIR.$ds;
        file_put_contents($project_dir .'__pssg.php', "<?php
require '{$pssg_base_dir}utils{$ds}server.php';
");
        if (!is_dir($project_dir.'__config')) {
            mkdir($project_dir.'__config');
        }

        copy("{$pssg_base_dir}default_config{$ds}driver.yml", $project_dir.'__config'.DIRECTORY_SEPARATOR.'driver.yml');
        copy("{$pssg_base_dir}default_config{$ds}mime.yml", $project_dir.'__config'.DIRECTORY_SEPARATOR.'mime.yml');
        copy("{$pssg_base_dir}default_config{$ds}setting.yml", $project_dir.'__config'.DIRECTORY_SEPARATOR.'setting.yml');
        copy("{$pssg_base_dir}default_config{$ds}smarty_driver_variable.yml", $project_dir.'__config'.DIRECTORY_SEPARATOR.'smarty_driver_variable.yml');

        touch($project_dir.'index.tpl');

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

    }
    /* ----------------------------------------- */
}

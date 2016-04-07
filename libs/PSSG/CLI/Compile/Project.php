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

namespace PSSG\CLI\Compile;

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
class Project extends \PSSG\CLI\Base
{
    /**
     * +-- プロジェクト全体をコンパイル
     *
     * @access      public
     * @return void
     */
    public function execute()
    {
        $project_dir = $this->getProjectDir();

        $ds = DIRECTORY_SEPARATOR;
        $PSSG = new \PSSG\Compile\PSSG;
        $PSSG->initialize($project_dir);
        $driver_exts = array_keys($PSSG->getDriverConfig());
        foreach ($this->getFileList($project_dir, $driver_exts) as list($ok, $file_name)) {

            // @codeCoverageIgnoreStart
            if ($ok) {
            // @codeCoverageIgnoreEnd

                $contents = $PSSG->compile($file_name);
                $compiled_file = $PSSG->getCompiledFile($file_name);
                file_put_contents($compiled_file, $contents);
                $this->secho('[Compiled]'.realpath($file_name).'->'.realpath($compiled_file));
            } else {
                $compiled_file = $PSSG->getOutFile($file_name);
                copy($file_name, $compiled_file);
                $this->secho('[Copy]'.realpath($file_name).'->'.realpath($compiled_file));
            }
        }
        $this->secho("Completed! {$project_dir}__outfile{$ds}");
    }
    /* ----------------------------------------- */

    /**
     * +-- コンパイルするファイルの一覧
     *
     * @access      public
     * @param string $dir
     * @param array  $driver_exts
     * @yield       string
     */
    public function getFileList($dir, array $driver_exts)
    {
        $iterator = new \RecursiveDirectoryIterator($dir);
        $iterator = new \RecursiveIteratorIterator($iterator);
        $project_dir = $this->getProjectDir();

        $list = array();
        foreach ($iterator as $fileinfo) {
            if ($fileinfo->isFile()) {
                if (realpath(dirname($fileinfo->getPathname())) === realpath($project_dir.'__config')) {
                    continue;
                } elseif (realpath(dirname($fileinfo->getPathname())) === realpath($project_dir.'__outfile')) {
                    continue;
                } elseif (realpath($fileinfo->getPathname()) === realpath($project_dir.DIRECTORY_SEPARATOR.'__pssg.php')) {
                    continue;
                }
                $ok = false;
                foreach ($driver_exts as $ext) {
                    if (mb_ereg($ext.'$', $fileinfo->getPathname())) {
                        $ok = true;
                        break;
                    }
                }
                yield [$ok, $fileinfo->getPathname()];
            }
        }
    }
    /* ----------------------------------------- */

    /**
     * +-- プロジェクトディレクトリを取得する
     *
     * @access      public
     * @return      string
     * @codeCoverageIgnore
     */
    public function getProjectDir()
    {
        $project_dir = $this->argv[2];
        $ds = DIRECTORY_SEPARATOR;
        $project_dir .= $ds;
        return $project_dir;
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
        if (!(isset($this->argv[2]) && is_dir($this->argv[2]))) {
            $this->argv[2] = getcwd();
        }
        if (!is_file($this->argv[2].DIRECTORY_SEPARATOR.'__pssg.php') || !is_dir($this->argv[2].DIRECTORY_SEPARATOR.'__config')) {
            $this->eecho($this->cli->createSampleCommand($this->argv[1], '{project directory path}'));

            // @codeCoverageIgnoreStart
            throw new \PSSG\CLI\OptionException();
            // @codeCoverageIgnoreEnd

        }
    }
    /* ----------------------------------------- */
}

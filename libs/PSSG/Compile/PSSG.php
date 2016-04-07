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
namespace PSSG\Compile;

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
class PSSG
{
    const OS_WIN = 1;
    const OS_UNIX = 2;

    protected $os;
    protected $driver_config;
    protected $setting;
    protected $project_dir;

    protected $drivers = [];

    /**
     * +-- コンストラクタ
     *
     * @access      public
     * @return void
     */
    public function __construct()
    {
        switch (DIRECTORY_SEPARATOR) {
            case '/':
                $this->os = self::OS_UNIX;
            break;
            default:
                $this->os = self::OS_WIN;
            break;
        }
    }
    /* ----------------------------------------- */

    /**
     * +-- 初期化する
     *
     * @access      public
     * @param  var_text $project_dir
     * @return void
     */
    public function initialize($project_dir)
    {
        $this->project_dir = $project_dir;

        $this->driver_config = $this->parseYML('driver.yml');
        $this->setting = $this->parseYML('setting.yml');

    }
    /* ----------------------------------------- */

    /**
     * +-- 設定ファイルをパースする
     *
     * @access      public
     * @param  var_text $yml_file
     * @return array
     */
    public function parseYML($yml_file)
    {
        ob_start();
        include $this->project_dir.DIRECTORY_SEPARATOR.'__config'.DIRECTORY_SEPARATOR.$yml_file;
        $setting_yml = ob_get_contents();
        ob_end_clean();

        return spyc_load($setting_yml);
    }
    /* ----------------------------------------- */

    /**
     * +-- settingを返す
     *
     * @access      public
     * @return array
     */
    public function getSetting()
    {
        return $this->setting;
    }
    /* ----------------------------------------- */

    /**
     * +-- driverの設定を返す
     *
     * @access      public
     * @return array
     */
    public function getDriverConfig()
    {
        return $this->driver_config;
    }
    /* ----------------------------------------- */

    /**
     * +-- コンパイルする
     *
     * @access      public
     * @param  string $file_name
     * @return string
     */
    public function compile($file_name)
    {
        $obj = $this->factory($file_name);

        return $obj->compile($file_name);
    }
    /* ----------------------------------------- */

    /**
     * +-- コンパイル結果を表示する
     *
     * @access      public
     * @param  string $file_name
     * @return void
     */
    public function display($file_name)
    {
        $obj = $this->factory($file_name);
        $obj->display($file_name);
    }
    /* ----------------------------------------- */

    /**
     * +-- ソースファイルを返す
     *
     * @access      public
     * @param  var_text $file_name
     * @return string
     */
    public function getSource($file_name)
    {
        foreach ($this->driver_config as $key => $config) {
            if (mb_ereg($config['compiled_ext'].'$', $file_name)) {
                $ck_file_name = mb_ereg_replace($config['compiled_ext'].'$', $key, $file_name);
                if (is_file($ck_file_name)) {
                    return $ck_file_name;
                }
                continue;
            }
        }

        return '';
    }
    /* ----------------------------------------- */

    /**
     * +-- コンパイルしたファイルの置き場所を返す
     *
     * @access      public
     * @param  string $file_name
     * @return string
     */
    public function getCompiledFile($file_name)
    {
        if (!is_file($file_name)) {
            return false;
        }
        $out_dir = $this->project_dir.DIRECTORY_SEPARATOR.'__outfile'.DIRECTORY_SEPARATOR;
        $real_out_dir = $out_dir.mb_substr(dirname($file_name), mb_strlen($this->project_dir)).DIRECTORY_SEPARATOR;

        is_dir($real_out_dir) OR mkdir($real_out_dir, 0777, true);
        $file_name = $real_out_dir.basename($file_name);

        return $this->replaceExt($file_name);
    }
    /* ----------------------------------------- */

    /**
     * +-- 拡張子の置き換え
     *
     * @access      protected
     * @param  string $file_name
     * @return string
     */
    protected function replaceExt($file_name)
    {
        foreach ($this->driver_config as $key => $config) {
            if (mb_ereg($key.'$', $file_name)) {
                break;
            }
        }
        $file_name = mb_ereg_replace($key.'$', $config['compiled_ext'], $file_name);

        return $file_name;
    }
    /* ----------------------------------------- */

    /**
     * +-- サンプルコマンドを作成する
     *
     * @access      public
     * @param  ...    $arguments
     * @return string
     */
    public function createSampleCommand(...$arguments)
    {
        return $this->createBasePssgCmd().' '.join(' ', $arguments);
    }
    /* ----------------------------------------- */

    /**
     * +-- ソースファイル名からコンフィグを返す
     *
     * @access      protected
     * @param  var_text $file_name
     * @return array
     */
    protected function getConfig($file_name)
    {
        foreach ($this->driver_config as $key => $config) {
            if (mb_ereg($key.'$', $file_name)) {
                break;
            }
        }

        return $config;
    }
    /* ----------------------------------------- */

    /**
     * +-- Driverオブジェクトの作成
     *
     * @access      protected
     * @param  var_text                 $file_name
     * @return PSSG\Compile\Driver\Base
     */
    protected function factory($file_name)
    {
        $config = $this->getConfig($file_name);
        $class_name =  "\\PSSG\\Compile\\Driver\\".$config['driver'];

        if (isset($this->drivers[$this->project_dir][$class_name])) {
            return $this->drivers[$this->project_dir][$class_name];
        }

        $obj =  new $class_name($config);
        $obj->PSSG = $this;
        $obj->initialize();
        $this->drivers[$this->project_dir][$class_name] = $obj;

        return $this->drivers[$this->project_dir][$class_name];
    }
    /* ----------------------------------------- */

    /**
     * +-- 環境に応じたpssgコマンドを返す
     *
     * @access      protected
     * @return string
     */
    protected function createBasePssgCmd()
    {
        $cmd = 'pssg';
        if ($this->os === self::OS_WIN) {
            $cmd .= '.bat';
        }

        return $cmd;
    }
    /* ----------------------------------------- */
}

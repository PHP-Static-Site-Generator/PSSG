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
namespace PSSG\CLI;

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

    /**
     * +-- コンストラクタ
     *
     * @access      public
     * @return void
     * @codeCoverageIgnore
     */
    public function __construct()
    {
        switch (DIRECTORY_SEPARATOR) {
            case '/':
                $this->setOs(self::OS_UNIX);
            break;
            default:
                $this->setOs(self::OS_WIN);
            break;
        }
    }
    /* ----------------------------------------- */

    /**
     * +-- 処理を実行する
     *
     * @access      public
     * @param  string $option
     * @return void
     */
    public function execute($option)
    {
        // エイリアス
        // @codeCoverageIgnoreStart
        switch ($option) {
        // @codeCoverageIgnoreEnd
        case 's':
            $option = 'server-start';
        break;
        case 'g':
            $option = 'compile-project';
        break;
        case 'setup':
            $option = 'project-create';
        break;
        case '-?':
        case 'help':
        case 'man':
            $this->help();
            return;
        }

        $obj = $this->factory($option);
        $obj->optionCheck();
        $obj->execute();
    }
    /* ----------------------------------------- */

    /**
     * +-- タスクからオブジェクトを生成する
     *
     * @access      public
     * @param  var_text      $option
     * @return PSSG\CLI\Base
     */
    public function factory($option)
    {
        $class_name = $this->getClassName($option);

        $obj =  $this->build($class_name);
        $obj->setCli($this);
        $obj->initialize();
        return $obj;
    }
    /* ----------------------------------------- */

    /**
     * +-- ヘルプの表示
     *
     * @access      public
     * @return void
     */
    public function help()
    {
        // @codeCoverageIgnoreStart
        echo "NAME","\n",
            "       ",$this->createBasePssgCmd(),"   -   Static Site Generator","\n",
        "SYNOPSIS",
            "\n","       ",$this->createBasePssgCmd()," [Task]","\n",
        "DESCRIPTION",
            "\n","       ","Transform your plain text into static websites.","\n",
        "TASK",
            "\n","       ","project-init",
            "\n","              ","initialize a existing project.",
            "\n","       ","project-create",
            "\n","              ","create a new project.",
            "\n","       ","server-start",
            "\n","              ","test compile server start.",
            "\n","       ","compile-project",
            "\n","              ","compile project all files.",

        "\n";

        // @codeCoverageIgnoreEnd
    }
    /* ----------------------------------------- */

    /**
     * +-- ヘルプやエラーメッセージ用のサンプルコマンドを作成する
     *
     * @access      public
     * @param  ...    $arguments
     * @return string
     * @codeCoverageIgnore
     */
    public function createSampleCommand(...$arguments)
    {
        return $this->createBasePssgCmd().' '.join(' ', $arguments);
    }
    /* ----------------------------------------- */

    /**
     * +-- タスクからクラス名を返す
     *
     * @access      protected
     * @param  var_text $option
     * @return string
     */
    protected function getClassName($option)
    {
        $pascal_case = strtolower($option);
        $pascal_case = str_replace('-', ' ', $pascal_case);
        $pascal_case = ucwords($pascal_case);
        $pascal_case = str_replace(' ', "\\", $pascal_case);

        return "\\PSSG\\CLI\\".$pascal_case;
    }
    /* ----------------------------------------- */


    /**
     * +-- OSに準じたPSSGCommand
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

    /**
     * +--
     *
     * @access      protected
     * @param       var_text $os
     * @return      void
     * @codeCoverageIgnore
     */
    protected function setOs($os)
    {
        $this->os = $os;
    }
    /* ----------------------------------------- */


    /**
     * +-- オブジェクトの作成
     *
     * @access      protected
     * @param       var_text $class_name
     * @return PSSG\CLI\Base
     * @codeCoverageIgnore
     */
    protected function build($class_name)
    {
        $obj =  new $class_name;
        return $obj;
    }
    /* ----------------------------------------- */

}

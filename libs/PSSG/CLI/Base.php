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
abstract class Base
{
    const OS_WIN = 1;
    const OS_UNIX = 2;

    protected $os;
    protected $cli;
    protected $argv;

    /**
     * +-- 初期化
     *
     * @access      public
     * @return void
     * @codeCoverageIgnore
     */
    public function initialize()
    {
        global $argv;
        switch (DIRECTORY_SEPARATOR) {
            case '/':
                $this->os = self::OS_UNIX;
            break;
            default:
                $this->os = self::OS_WIN;
            break;
        }
        $this->argv = $argv;
    }
    /* ----------------------------------------- */

    /**
     * +-- CLIオブジェクトのセット
     *
     * @access      public
     * @param       var_text $cli
     * @return      void
     * @codeCoverageIgnore
     */
    public function setCli($cli)
    {
        $this->cli = $cli;
    }
    /* ----------------------------------------- */

    /**
     * +-- 標準エラー出力に書き込み
     *
     * @access      public
     * @param  var_text $err
     * @return void
     * @codeCoverageIgnore
     */
    public function eecho($err)
    {
        fwrite(STDERR, "[ERR] {$err}\n");
    }
    /* ----------------------------------------- */

    /**
     * +-- 標準出力に書き込み
     *
     * @access      public
     * @param  var_text $err
     * @return void
     * @codeCoverageIgnore
     */
    public function secho($err)
    {
        echo "{$err}\n";
    }
    /* ----------------------------------------- */

    /**
     * +-- 引数の取得
     *
     * @access      public
     * @return      array
     * @codeCoverageIgnore
     */
    public function getArgv()
    {
        return $this->argv;
    }
    /* ----------------------------------------- */


    /**
     * +-- オプションのチェック
     *
     * @return void
     */
    abstract public function optionCheck();
    /* ----------------------------------------- */

    /**
     * +-- 処理の実行
     *
     * @return void
     */
    abstract public function execute();
    /* ----------------------------------------- */

}

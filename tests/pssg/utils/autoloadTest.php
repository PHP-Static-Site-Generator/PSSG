<?php
/**
 *
 *
 *
 * PHP versions 5
 *
 *
 *
 * @category   %%project_category%%
 * @package    %%project_name%%
 * @subpackage %%subpackage_name%%
 * @author     %%your_name%% <%%your_email%%>
 * @copyright  %%your_project%%
 * @license    %%your_license%%
 * @version    GIT: $Id$
 * @link       %%your_link%%
 * @see        http://www.enviphp.net/c/man/v3/core/unittest
 * @since      File available since Release 1.0.0
 * @doc_ignore
 */


require_once APP_BASE.'utils/autoload.php';

/**
 *
 *
 *
 *
 * @category   %%project_category%%
 * @package    %%project_name%%
 * @subpackage %%subpackage_name%%
 * @author     %%your_name%% <%%your_email%%>
 * @copyright  %%your_project%%
 * @license    %%your_license%%
 * @version    GIT: $Id$
 * @link       %%your_link%%
 * @see        http://www.enviphp.net/c/man/v3/core/unittest
 * @since      File available since Release 1.0.0
 * @doc_ignore
 */
class autoloadTest extends testCaseBase
{


    /**
     * +-- 初期化
     *
     * @access public
     * @return void
     */
    public function initialize()
    {
        $this->free();
    }
    /* ----------------------------------------- */

    /**
     * +--
     *
     * @access      public
     * @return      void
     */
    public function loadFileTest()
    {
        $AutoLoad = EnviMockLight::mock('\PSSG\AutoLoad', [], false);

        $AutoLoad->shouldReceive('requireFile')
        ->with(APP_BASE.'libs'.DIRECTORY_SEPARATOR.'PSSG'.DIRECTORY_SEPARATOR.'CLI'.DIRECTORY_SEPARATOR.'Base.php')
        ->once()
        ->andReturnAugment();
        $res = $AutoLoad->loadFile('\PSSG\CLI\Base');

    }
    /* ----------------------------------------- */


    /**
     * +--
     *
     * @access      public
     * @return      void
     */
    public function loadFileErrorTest()
    {
        $AutoLoad = EnviMockLight::mock('\PSSG\AutoLoad', [], false);

        $AutoLoad->shouldReceive('requireFile')
        ->with()
        ->never()
        ->andReturnAugment();
        $res = $AutoLoad->loadFile('hogehoge');

    }
    /* ----------------------------------------- */

    /**
     * +-- 終了処理
     *
     * @access public
     * @return void
     */
    public function shutdown()
    {
    }

}

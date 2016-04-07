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


require_once APP_BASE.'/utils/autoload.php';
require_once APP_BASE.'libs/PSSG/CLI/PSSG.php';

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
class CLI_PSSGTest extends testCaseBase
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
    public function helpTest()
    {
        $PSSG = EnviMockLight::mock('\PSSG\CLI\PSSG', [], false);
        $PSSG->shouldReceive('createBasePssgCmd')
        ->with()
        ->andReturn('pssg_tests');
        ob_start();
        $PSSG->help();
        $contents = ob_get_contents();
        ob_end_clean();
        $this->assertNotEmpty($contents);
        $this->assertTrue(strpos($contents, 'pssg_tests') !== false);
    }
    /* ----------------------------------------- */


    /**
     * +--
     *
     * @access      public
     * @return      void
     */
    public function createBasePssgCmdUnixTest()
    {
        $PSSG = new \PSSG\CLI\PSSG;
        $this->call($PSSG, 'setOs', [\PSSG\CLI\PSSG::OS_UNIX]);
        $res = $this->call($PSSG, 'createBasePssgCmd', []);
        $this->assertEquals($res, 'pssg');
    }
    /* ----------------------------------------- */


    /**
     * +--
     *
     * @access      public
     * @return      void
     */
    public function createBasePssgCmdWinTest()
    {
        $PSSG = new \PSSG\CLI\PSSG;
        $this->call($PSSG, 'setOs', [\PSSG\CLI\PSSG::OS_WIN]);
        $res = $this->call($PSSG, 'createBasePssgCmd', []);
        $this->assertEquals($res, 'pssg.bat');
    }
    /* ----------------------------------------- */


    /**
     * +--
     *
     * @access      public
     * @return      void
     */
    public function getClassNameTest()
    {
        $PSSG = new \PSSG\CLI\PSSG;
        $res = $this->call($PSSG, 'getClassName', ['server-start']);
        $this->assertEquals($res, '\PSSG\CLI\Server\Start');
    }
    /* ----------------------------------------- */

    /**
     * +--
     *
     * @access      public
     * @return      void
     */
    public function factoryTest()
    {
        $TestObject = EnviMockLight::mock('MockFactorySample');

        $TestObject->shouldReceive('initialize')
        ->andReturnNull();

        $TestObject->shouldReceive('setCli')
        ->andReturnNull();



        $PSSG = EnviMockLight::mock('\PSSG\CLI\PSSG', [], false);
        $PSSG->shouldReceive('getClassName')
        ->with('server-start')
        ->andReturn('MockFactorySample');

        $PSSG->shouldReceive('build')
        ->with('MockFactorySample')
        ->andReturn($TestObject);


        $res = $PSSG->factory('server-start');

        $this->assertInstanceOf('MockFactorySample', $res);
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

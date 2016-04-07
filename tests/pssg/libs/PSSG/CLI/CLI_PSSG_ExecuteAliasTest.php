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
class CLI_PSSG_ExecuteAliasTest extends testCaseBase
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
    public function executeServerStartAliasTest()
    {
        $PSSG = EnviMockLight::mock('\PSSG\CLI\PSSG', [], false);

        $TestObject = EnviMockLight::mock('\PSSG\CLI\Test\Object', [], false);
        $TestObject->shouldReceive('optionCheck')
        ->with()
        ->once()
        ->andReturn('');
        $TestObject->shouldReceive('execute')
        ->with()
        ->once()
        ->andReturn('');


        $PSSG->shouldReceive('factory')
        ->with('server-start')
        ->once()
        ->andReturn($TestObject);
        $res = $PSSG->execute('s');
    }
    /* ----------------------------------------- */


    /**
     * +--
     *
     * @access      public
     * @return      void
     */
    public function executeCompileProjectAliasTest()
    {
        $PSSG = EnviMockLight::mock('\PSSG\CLI\PSSG', [], false);

        $TestObject = EnviMockLight::mock('\PSSG\CLI\Test\Object', [], false);
        $TestObject->shouldReceive('optionCheck')
        ->with()
        ->once()
        ->andReturn('');
        $TestObject->shouldReceive('execute')
        ->with()
        ->once()
        ->andReturn('');


        $PSSG->shouldReceive('factory')
        ->with('compile-project')
        ->once()
        ->andReturn($TestObject);
        $res = $PSSG->execute('g');
    }
    /* ----------------------------------------- */

    /**
     * +--
     *
     * @access      public
     * @return      void
     */
    public function executeProjectCreateAliasTest()
    {
        $PSSG = EnviMockLight::mock('\PSSG\CLI\PSSG', [], false);

        $TestObject = EnviMockLight::mock('\PSSG\CLI\Test\Object', [], false);
        $TestObject->shouldReceive('optionCheck')
        ->with()
        ->once()
        ->andReturn('');
        $TestObject->shouldReceive('execute')
        ->with()
        ->once()
        ->andReturn('');


        $PSSG->shouldReceive('factory')
        ->with('project-create')
        ->once()
        ->andReturn($TestObject);
        $res = $PSSG->execute('setup');
    }
    /* ----------------------------------------- */

    /**
     * +--
     *
     * @access      public
     * @return      void
     */
    public function executeHelpCallQuestionTest()
    {
        $PSSG = EnviMockLight::mock('\PSSG\CLI\PSSG', [], false);

        $PSSG->shouldReceive('help')
        ->with()
        ->once()
        ->andReturn('');
        $res = $PSSG->execute('-?');
    }
    /* ----------------------------------------- */


    /**
     * +--
     *
     * @access      public
     * @return      void
     */
    public function executeHelpCallManTest()
    {
        $PSSG = EnviMockLight::mock('\PSSG\CLI\PSSG', [], false);

        $PSSG->shouldReceive('help')
        ->with()
        ->once()
        ->andReturn('');
        $res = $PSSG->execute('man');
    }
    /* ----------------------------------------- */

    /**
     * +--
     *
     * @access      public
     * @return      void
     */
    public function executeHelpCallHelpTest()
    {
        $PSSG = EnviMockLight::mock('\PSSG\CLI\PSSG', [], false);

        $PSSG->shouldReceive('help')
        ->with()
        ->once()
        ->andReturn('');
        $res = $PSSG->execute('help');
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

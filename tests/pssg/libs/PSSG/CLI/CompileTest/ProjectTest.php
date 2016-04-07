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
class ProjectTest extends testCaseBase
{

    protected $cwd;
    /**
     * +-- 初期化
     *
     * @access public
     * @return void
     */
    public function initialize()
    {
        $this->cwd = getcwd();
        $this->free();
        if (!defined('PSSG_BASE_DIR')) {
            define('PSSG_BASE_DIR', APP_BASE);
        }
        if (is_dir(TEST_DATA.DIRECTORY_SEPARATOR.'__outfile')) {
            @unlink(TEST_DATA.DIRECTORY_SEPARATOR.'__outfile'.DIRECTORY_SEPARATOR.'index2.html');
            @unlink(TEST_DATA.DIRECTORY_SEPARATOR.'__outfile'.DIRECTORY_SEPARATOR.'index.html');
            @unlink(TEST_DATA.DIRECTORY_SEPARATOR.'__outfile'.DIRECTORY_SEPARATOR.'test.png');
            @unlink(TEST_DATA.DIRECTORY_SEPARATOR.'__outfile'.DIRECTORY_SEPARATOR.'css'.DIRECTORY_SEPARATOR.'main.css');
            @rmdir(TEST_DATA.DIRECTORY_SEPARATOR.'__outfile'.DIRECTORY_SEPARATOR.'css');
            @unlink(TEST_DATA.DIRECTORY_SEPARATOR.'__outfile'.DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'main.js');
            @rmdir(TEST_DATA.DIRECTORY_SEPARATOR.'__outfile'.DIRECTORY_SEPARATOR.'js');
            rmdir(TEST_DATA.DIRECTORY_SEPARATOR.'__outfile');
        }
    }
    /* ----------------------------------------- */

    /**
     * +-- データプロバイダ
     *
     * @access      public
     * @return      array
     */
    public function PSSGDataProvider()
    {
        $CompileProject = EnviMockLight::mock('\PSSG\CLI\Compile\Project', [], true);

        chdir(TEST_DATA);

        $PSSG = EnviMockLight::mock('\PSSG\CLI\PSSG', [], false);
        $PSSG->shouldReceive('getClassName')
        ->with('compile-project')
        ->andReturn('\PSSG\CLI\Compile\Project');

        $PSSG->shouldReceive('build')
        ->with('\PSSG\CLI\Compile\Project')
        ->andReturn($CompileProject);

        return [$PSSG];
    }
    /* ----------------------------------------- */

    /**
     * +--
     *
     * @access      public
     * @return      void
     * @test
     * @cover PSSG\CLI\Compile\Project::optionCheck
     * @dataProvider PSSGDataProvider
     */
    public function optionCheckEmptyArgvTest($PSSG)
    {
        global $argv;
        unset($argv[2]);
        chdir(TEST_DATA);
        $CompileProject = $PSSG->factory('compile-project');
        $CompileProject->optionCheck();
        $_argv = $CompileProject->getArgv();
        $this->assertEquals($_argv[2], realpath(TEST_DATA));

    }
    /* ----------------------------------------- */


    /**
     * +--
     *
     * @access      public
     * @return      void
     * @test
     * @cover PSSG\CLI\Compile\Project::optionCheck
     * @dataProvider PSSGDataProvider
     */
    public function optionCheckFileArgvTest($PSSG)
    {
        global $argv;

        chdir(TEST_DATA);
        $argv[2] = __FILE__;
        $CompileProject = $PSSG->factory('compile-project');
        $CompileProject->optionCheck();
        $_argv = $CompileProject->getArgv();
        $this->assertEquals($_argv[2], realpath(TEST_DATA));
    }
    /* ----------------------------------------- */

    /**
     * +--
     *
     * @access      public
     * @return      void
     * @test
     * @cover PSSG\CLI\Compile\Project::optionCheck
     * @dataProvider PSSGDataProvider
     */
    public function optionCheckErrorTest($PSSG)
    {
        global $argv;

        $argv[2] = __DIR__;


        $PSSG->shouldReceive('createSampleCommand')
        ->once()
        ->andNoBypass();


        $CompileProject = $PSSG->factory('compile-project');

        $CompileProject->shouldReceive('eecho')
        ->once()
        ->with('[ERR] pssg unittest-go {project directory path}')
        ->andReturnNull();
        $e = NULL;
        try {
            ob_start();
            $CompileProject->optionCheck();
            $contents = ob_get_contents();
            ob_end_clean();

        } catch (exception $e) {

        }
        $this->assertInstanceOf('exception', $e);
    }
    /* ----------------------------------------- */


    /**
     * +--
     *
     * @access      public
     * @return      void
     * @test
     * @cover PSSG\CLI\Compile\Project::getFileList
     * @dataProvider PSSGDataProvider
     */
    public function getFileListTest($PSSG)
    {
        mkdir(TEST_DATA.DIRECTORY_SEPARATOR.'__outfile');
        touch(TEST_DATA.DIRECTORY_SEPARATOR.'__outfile'.DIRECTORY_SEPARATOR.'index.html');
        $CompileProject = $PSSG->factory('compile-project');
        $CompileProject->shouldReceive('getProjectDir')
        ->once()
        ->andReturn(TEST_DATA);
        $CompilePSSG = new \PSSG\Compile\PSSG;
        $CompilePSSG->initialize(TEST_DATA);
        $driver_exts = array_keys($CompilePSSG->getDriverConfig());
        $res = [];
        foreach ($CompileProject->getFileList(TEST_DATA, $driver_exts) as list($ok, $row)) {
            if ($ok) {
                $res[] = $row;
                $this->free();
            }
        }

        $this->assertEquals($res, array (
          0 => TEST_DATA.'index.tpl',
          1 => TEST_DATA.'index2.tpl.yml',
          2 => TEST_DATA.'js/main.ts',
          3 => TEST_DATA.'css/main.scss',
        ));

    }
    /* ----------------------------------------- */


    /**
     * +--
     *
     * @access      public
     * @return      void
     * @cover PSSG\CLI\Compile\Project::execute
     * @dataProvider PSSGDataProvider
     * @group medium
     */
    public function executeTest($PSSG)
    {
        global $argv;
        $argv[2] = TEST_DATA;
        chdir(TEST_DATA);
        ob_start();
        $res = $PSSG->execute('compile-project');
        $content = ob_get_contents();
        ob_end_clean();
    }
    /* ----------------------------------------- */



    /**
     * +--
     *
     * @access      public
     * @return      void
     * @cover PSSG\CLI\Compile\Project::execute
     * @dataProvider PSSGDataProvider
     */
    public function executeNoneTest($PSSG)
    {
        global $argv;
        $argv[2] = TEST_DATA;
        chdir(TEST_DATA);

        $CompileProject = $PSSG->factory('compile-project');
        $CompileProject->shouldReceive('getFileList')
        ->once()
        ->andReturn([]);
        ob_start();
        $res = $PSSG->execute('compile-project');
        $content = ob_get_contents();
        ob_end_clean();

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
        chdir($this->cwd);
    }

}

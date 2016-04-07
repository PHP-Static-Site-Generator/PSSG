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
namespace PSSG\Compile\Driver;


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
class TypeScript extends Base
{

    public $tmp_dir = PSSG_BASE_DIR.DIRECTORY_SEPARATOR.'tmp';

    protected $DEFAULT_OPTIONS = array(
    );

    /**
     * +-- コンストラクタ
     *
     * @access      public
     * @param       array $config
     * @return      void
     */
    public function __construct(array $config)
    {

    }
    /* ----------------------------------------- */

    /**
     * +--
     *
     * @access      public
     * @return      void
     */
    public function initialize()
    {

    }
    /* ----------------------------------------- */

    /**
     * +-- Compile
     *
     * @access      public
     * @param       var_text $file_name
     * @return      void
     */
    public function compile($file_name)
    {
        $options = [];
        $error_info = [];
        if (file_exists($file_name)) {
            $file_name = realpath($file_name);
        }
        if (!isset($options['output_file'])) {
            $options['output_file'] = tempnam($this->tmp_dir, 'TS_');
        }
        $options['input_file'] = $file_name;

        if ($this->build($options, $error_info)) {
            $data = file_get_contents($options['output_file']);
            unlink($options['output_file']);
            return $data;
        } else {
            unlink($options['output_file']);
            return false;
        }
    }
    /* ----------------------------------------- */

    protected function buildCommand(array $options) {
        $cmd = 'tsc ';
        if (isset($options['output_file'])) {
            $cmd .= '--out ' . escapeshellarg($options['output_file']) . ' ';
        }
        $cmd .= escapeshellarg($options['input_file']);
        return $cmd;
    }

    protected function build(array $options, &$error_info=array()) {
        $options = array_merge($this->DEFAULT_OPTIONS, $options);
        $descriptorspec = array(
            0 => array("pipe", "r"), // stdin
            1 => array("pipe", "w"), // stdout
            2 => array("pipe", "w")  // stderr
        );
        $process = proc_open($this->buildCommand($options), $descriptorspec, $pipes, dirname(__FILE__), null);
        $stdout = stream_get_contents($pipes[1]);
        fclose($pipes[1]);
        $stderr = stream_get_contents($pipes[2]);
        fclose($pipes[2]);

        proc_close($process);
        if (empty($stderr)) {
            return true;
        } else {
            $error_info = array('stdout' => $stdout, 'stdin' => $stderr);
            return false;
        }
    }


}
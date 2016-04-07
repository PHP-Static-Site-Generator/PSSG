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
namespace {
    define('PSSG_BASE_DIR', dirname(__DIR__));
    require PSSG_BASE_DIR.DIRECTORY_SEPARATOR.'libs/vendor/spyc/spyc.php';
    require PSSG_BASE_DIR.'/utils/autoload.php';
}

namespace PSSG\Compile{
    function execute()
    {
        $PSSG = new PSSG;
        $PSSG->initialize($_SERVER['DOCUMENT_ROOT']);
        $setting = $PSSG->getSetting();

        ob_start();
        include $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'__config'.DIRECTORY_SEPARATOR.'mime.yml';
        $mime = ob_get_contents();
        ob_end_clean();
        $mime =  spyc_load($mime);

        if ($_SERVER['PHP_SELF'] === '/') {
            $_SERVER['PHP_SELF'] .= $setting['index_file'];
        }

        // コンパイルするファイル
        $source = realpath($PSSG->getSource($_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF']));
        if ($source && is_file($source)) {
            foreach ($mime as $ext => $content_type) {
                if (mb_ereg($ext.'$', $_SERVER['PHP_SELF'])) {
                    header('content-type:'.$content_type);
                }
            }
            $PSSG->display($source);

            return;
        }

        // そのまま表示するファイル
        $source = realpath($_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF']);
        if ($source && is_file($source)) {
            header('content-type:'.mime_content_type($source));
            echo file_get_contents($source);

            return;
        }
        header("HTTP/1.0 404 Not Found");
    }
    execute();
}

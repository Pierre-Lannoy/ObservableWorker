<?php
/**
 * This file is part of ObservableWorker.
 *
 * Licensed under The MIT License.
 * For full copyright and license information, please see the LICENSE.txt file.
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net> *
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace ObservableWorker\Events\React;

/**
 * Class ExtEventLoop
 * @package ObservableWorker\Events\React
 */
class ExtEventLoop extends Base
{

    public function __construct()
    {
        $this->_eventLoop = new \React\EventLoop\ExtEventLoop();
    }
}

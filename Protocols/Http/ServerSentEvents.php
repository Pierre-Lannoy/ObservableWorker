<?php
/**
 * This file is part of ObservableWorker.
 *
 * Licensed under The MIT License.
 * For full copyright and license information, please see the LICENSE.txt file.
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 *
 * @author    Pierre Lannoy <https://pierre.lannoy.fr/>
 * @copyright Pierre Lannoy <https://pierre.lannoy.fr/>
 * @link      https://github.com/Pierre-Lannoy/ObservableWorker
 *
 */
namespace ObservableWorker\Protocols\Http;

/**
 * Class ServerSentEvents
 * @package ObservableWorker\Protocols\Http
 */
class ServerSentEvents
{
    /**
     * Data.
     * @var array
     */
    protected $_data = null;

    /**
     * ServerSentEvents constructor.
     * $data for example ['event'=>'ping', 'data' => 'some thing', 'id' => 1000, 'retry' => 5000]
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->_data = $data;
    }

    /**
     * __toString.
     *
     * @return string
     */
    public function __toString()
    {
        $buffer = '';
        $data = $this->_data;
        if (isset($data[''])) {
            $buffer = ": {$data['']}\n";
        }
        if (isset($data['event'])) {
            $buffer .= "event: {$data['event']}\n";
        }
        if (isset($data['data'])) {
            $buffer .= 'data: ' . \str_replace("\n", "\ndata: ", $data['data']) . "\n\n";
        }
        if (isset($data['id'])) {
            $buffer .= "id: {$data['id']}\n";
        }
        if (isset($data['retry'])) {
            $buffer .= "retry: {$data['retry']}\n";
        }
        return $buffer;
    }
}
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
namespace ObservableWorker\Protocols;

use ObservableWorker\Connection\TcpConnection;

/**
 * Frame Protocol.
 */
class Frame
{
    /**
     * Check the integrity of the package.
     *
     * @param string        $buffer
     * @param TcpConnection $connection
     * @return int
     */
    public static function input($buffer, TcpConnection $connection)
    {
        if (\strlen($buffer) < 4) {
            return 0;
        }
        $unpack_data = \unpack('Ntotal_length', $buffer);
        return $unpack_data['total_length'];
    }

    /**
     * Decode.
     *
     * @param string $buffer
     * @return string
     */
    public static function decode($buffer)
    {
        return \substr($buffer, 4);
    }

    /**
     * Encode.
     *
     * @param string $buffer
     * @return string
     */
    public static function encode($buffer)
    {
        $total_length = 4 + \strlen($buffer);
        return \pack('N', $total_length) . $buffer;
    }
}

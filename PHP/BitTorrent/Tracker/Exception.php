<?php
/**
 * PHP BitTorrent
 *
 * Copyright (c) 2011-2012 Christer Edvartsen <cogo@starzinger.net>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to
 * deal in the Software without restriction, including without limitation the
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or
 * sell copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * * The above copyright notice and this permission notice shall be included in
 *   all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 *
 * @package Tracker
 * @subpackage Exceptions
 * @author Christer Edvartsen <cogo@starzinger.net>
 * @copyright Copyright (c) 2011-2012, Christer Edvartsen
 * @license http://www.opensource.org/licenses/mit-license MIT License
 */

namespace PHP\BitTorrent\Tracker;

use PHP\BitTorrent\Encoder,
    RuntimeException;

/**
 * Exception class for the tracker
 *
 * @package Tracker
 * @subpackage Exceptions
 * @author Christer Edvartsen <cogo@starzinger.net>
 * @copyright Copyright (c) 2011-2012, Christer Edvartsen
 * @license http://www.opensource.org/licenses/mit-license MIT License
 */
class Exception extends RuntimeException {
    /**
     * Encode the error message so it can be sent to a BitTorrent client
     *
     * This function will send a bencoded message to a BitTorrent client telling it that an error
     * has occured. When the client receives a dictionary with the key "failure reason" it knows
     * something is wrong.
     *
     * @param PHP\BitTorrent\Encoder $encoder The encoder to use to encode the error message
     * @return string
     */
    public function getMessageEncoded(Encoder $encoder = null) {
        if ($encoder === null) {
            $encoder = new Encoder();
        }

        return $encoder->encodeDictionary(array('failure reason' => $this->getMessage()));
    }
}

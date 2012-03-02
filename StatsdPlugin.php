<?php

# Copyright (c)  2012 - <mlunzena@uos.de>
#
# Permission is hereby granted, free of charge, to any person obtaining a copy
# of this software and associated documentation files (the "Software"), to deal
# in the Software without restriction, including without limitation the rights
# to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
# copies of the Software, and to permit persons to whom the Software is
# furnished to do so, subject to the following conditions:
#
# The above copyright notice and this permission notice shall be included in all
# copies or substantial portions of the Software.
#
# THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
# IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
# FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
# AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
# LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
# OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
# SOFTWARE.

class StatsdPlugin extends StudipPlugin implements SystemPlugin
{
    function __construct()
    {
        parent::__construct();

        $this->observe();

    }

    function observe()
    {
        require_once 'vendor/statsd/client.php';
        NotificationCenter::addObserver($this, 'update', NULL);
    }

    function update($event) {
        #$start = microtime(true);
        @etsy\Statsd::increment(strtolower($event));
        #var_dump(func_get_args(), microtime(true) - $start);
    }

    static function onEnable($id)
    {
        RolePersistence::assignPluginRoles($id, array(7));
    }
}

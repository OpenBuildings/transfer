<?php

namespace CL\Transfer\Test;

use Harp\Query\DB;
use Harp\Harp\Repo\Container;
use PHPUnit_Framework_TestCase;
use CL\CurrencyConvert\Converter;
use CL\CurrencyConvert\NullSource;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
abstract class AbstractTestCase extends PHPUnit_Framework_TestCase {

    /**
     * @var TestLogger
     */
    protected $logger;

    /**
     * @return TestLogger
     */
    public function getLogger()
    {
        return $this->logger;
    }

    public function setUp()
    {
        parent::setUp();

        $this->logger = new TestLogger();

        Converter::initialize(new NullSource());

        DB::setConfig([
            'dsn' => 'mysql:dbname=clippings/transfer;host=127.0.0.1',
            'username' => 'root',
        ]);

        DB::get()->execute('ALTER TABLE Basket AUTO_INCREMENT = 1');
        DB::get()->execute('ALTER TABLE ProductItem AUTO_INCREMENT = 1');

        DB::get()->setLogger($this->logger);
        DB::get()->beginTransaction();

        Container::clear();
    }

    public function tearDown()
    {
        DB::get()->rollback();

        parent::tearDown();
    }

    public function assertQueries(array $query)
    {
        $this->assertEquals($query, $this->getLogger()->getEntries());
    }
}

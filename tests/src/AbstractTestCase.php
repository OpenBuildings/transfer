<?php

namespace Harp\Transfer\Test;

use Harp\Query\DB;
use PHPUnit_Framework_TestCase;
use Harp\Transfer\Test\Repo;
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



        DB::setConfig('default', array(
            'dsn' => 'mysql:dbname=harp-orm/transfer;host=127.0.0.1',
            'username' => 'root',
        ));

        DB::get()->execute('ALTER TABLE Basket AUTO_INCREMENT = 1', array());
        DB::get()->execute('ALTER TABLE Item AUTO_INCREMENT = 1', array());

        DB::get()->setLogger($this->logger);
        DB::get()->beginTransaction();

        Repo\Basket::get()->clear();
        Repo\Product::get()->clear();
        Repo\ProductItem::get()->clear();
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

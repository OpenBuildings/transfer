Transfer
========

[![Build Status](https://travis-ci.org/clippings/transfer.png?branch=master)](https://travis-ci.org/clippings/transfer)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/clippings/transfer/badges/quality-score.png)](https://scrutinizer-ci.com/g/clippings/transfer/)
[![Code Coverage](https://scrutinizer-ci.com/g/clippings/transfer/badges/coverage.png)](https://scrutinizer-ci.com/g/clippings/transfer/)
[![Latest Stable Version](https://poser.pugx.org/clippings/transfer/v/stable.png)](https://packagist.org/packages/clippings/transfer)

This is a general foundation to implement all sorts of monetary transactions and persist them in the database.
Uses Omnipay for performing the transactions themselves.

Usage
-----

There are 3 main traits to assign to your models:

__Item Group Trait__

This is just a group of multiple __Item Trait__. Adds freezable and soft delete trait. and allows freezing / unfreezing all the items, associated with it.

__Item Trait__

This is a single monetary "item". Adds freezable and soft delete.

__Transfer Trait__

This initiates request to payment processors and stores the responses in the database. Requires "getValue()" to return a Money Object.

License
-------

Copyright (c) 2014, Clippings Ltd. Developed by Ivan Kerin

Under BSD-3-Clause license, read LICENSE file.

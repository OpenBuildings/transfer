Transfer
========

[![Build Status](https://travis-ci.org/clippings/transfer.png?branch=master)](https://travis-ci.org/clippings/transfer)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/clippings/transfer/badges/quality-score.png)](https://scrutinizer-ci.com/g/clippings/transfer/)
[![Code Coverage](https://scrutinizer-ci.com/g/clippings/transfer/badges/coverage.png)](https://scrutinizer-ci.com/g/clippings/transfer/)
[![Latest Stable Version](https://poser.pugx.org/clippings/transfer/v/stable.png)](https://packagist.org/packages/clippings/transfer)

This is a solid foundation to implement all sorts of monetary transactions and persist them in the database.
Uses Omnipay for performing the transactions themselves.
All the Model / Repo classes are abstract so you'll need to implement them in your own code.

Usage
-----

There are 3 main abstract models:

- __AbstractItem__ - Model that can be inherited, providing the basic "item" of a transaction. It can will be "frozen" so the price cannot be changed after the transaction is complete.
- __AbstractItemGroup__ - Groups several items together with ability to get total price, and freeze / unfreeze all items
- __AbstractTransfer__ - Extends AbstractItemGroup, adding omnipay support so that all the items can be actaully purchased.

AbstractTransfer and AbstractItemGroup are not set to be inherited, so that you can have different tables for each of your own Transfer / ItemGroup Models.

License
-------

Copyright (c) 2014, Clippings Ltd. Developed by Ivan Kerin

Under BSD-3-Clause license, read LICENSE file.

.. include:: Includes.txt

.. _configuration:

Configuration
=============

The extension provides two different post processors which can be configured.

.. note:: Post processors are executed in order.

  It's importent to use ``HashInput`` before ``DbInsert`` if you want to insert hashed values like
  passwords!

.. _db-insert:

DbInsert
--------

This post processor will insert the data as is into the database.

You have to configure the ``tableName``. That's the name of the table, as used in
TCA, where data should be written to.

In addition, you can define multiple ``columns`` as key-value pairs that will be added to the form
input. This allows you to define the storage ``pid`` or hide new records.

Both, table and columns, have to exist in the actual database and TCA. Otherwise they will not be
inserted and no error is raised. If you need to insert "hidden" fields not visible inside of the
backend, don't add them to ``showitem`` list.

Example:

.. literalinclude:: Examples/full.ts
   :language: typoscript
   :lines: 10-17
   :dedent: 4

.. _hash-input:

HashInput
---------

This post processor will hash configured input by using TYPO3 Core API.

The only possible configuration is ``fields``, which is a comma separated list of field names which
should be hashed.

The TYPO3 Core API
:ref:`t3api:TYPO3\\CMS\\Saltedpasswords\\Utility\\SaltedPasswordsUtility::getDefaultSaltingHashingMethod`
is used.

Example:

.. literalinclude:: Examples/full.ts
   :language: typoscript
   :lines: 5-8
   :dedent: 4

.. _full-example:

Full example
------------

A full example for user registration might look like:

.. literalinclude:: Examples/full.ts
   :language: typoscript

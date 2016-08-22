.. include:: Includes.txt

.. _start:

=================================
Form PostProcessor for DB Inserts
=================================

:Author:    Daniel Siepmann <coding@daniel-siepmann.de>
:License:   GPL-2.0+
:Rendered:  |today|
:Description:
      Allow inserts of data via core Form extension. E.g. for registrations of fe_users.

.. _introduction:

Introduction
============

This extension provides an Post Processor for EXT:form to allow insertion of
form input into the database.

This allows you to provide e.g. registration via core extension without need of
a heavy extension.

.. _examples:

Examples
========

Some examples what you can use this extension for:

Frontend user registration
    Provide the form with necessary validation rules. Afterwards the new user will be added to the
    database.
    If you need some further processing, like checking and activating, just add a email post
    processor to inform about the new user, and disable the user by default., see :ref:`usage`.

Logging of form submits
    Provide a database table with the necessary fields and add the post processor. All submitted
    input will be persisted into the table.

The first example will look like:

.. image:: Images/example.png

.. toctree::

    Installation
    Usage
    Configuration
    Changelog
    Contribution

.. _usage:

Usage
=====

As this is just a post processor for the TYPO3 native Form element, all you have to do is to add the
necessary configuration to the form configuration. Open the content element containing the form, and
add the post processor.

Currently the wizard is not supported, so you have to write the configuration
yourself. E.g.::

    postProcessor {
        1 = WebVision\WvFormDbInsert\Form\PostProcessor\DbInsert
        1 {
            tableName = fe_users
            columns {
                disable = 1
                pid = 53
            }
        }
    }

The configuration will not be removed while using the wizard.

To allow the post processor to insert values, the field names of form and database table have to
match. There is no option to define a mapping.

## Introduction

This extension provides an Post Processor for EXT:form to allow insertion of
form input into the database and for hashing.

This allows you to provide e.g. registration via core extension without need of
a heavy extension.

## Usage

Currently the wizard is not supported, so you have to write the configuration
yourself. E.g.:

    postProcessor {
        1 = WebVision\WvFormDbInsert\Form\PostProcessor\HashInput
        1 {
            fields = password
        }

        2 = WebVision\WvFormDbInsert\Form\PostProcessor\DbInsert
        2 {
            tableName = fe_users
            columns {
                disable = 1
                pid = 53
            }
        }
    }

The configuration will not be removed while using the wizard.

### Configuration

For ``HashInput``:

The only option available is ``fields`` and this option has to be provided. It's
a comma separated list of field names that should be hashed.
TYPO3 Core API will be used to determine hashing method and salt.

For ``DbInsert``:

You have to configure the `tableName`. That's the name of the table, as used in
TCA, where data should be written to.

You can define multiple columns as key-value pairs that will be added to the
form input. This allows you to define the storage pid or hide new records.

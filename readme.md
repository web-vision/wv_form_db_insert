## Introduction

This extension provides an Post Processor for EXT:form to allow insertion of
form input into the database.

This allows you to provide e.g. registration via core extension without need of
a heavy extension.

## Usage

Currently the wizard is not supported, so you have to write the configuration
yourself. E.g.:

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

### Configuration

You have to configure the `tableName`. That's the name of the table, as used in
TCA, where data should be written to.

You can define multiple columns as key-value pairs that will be added to the
form input. This allows you to define the storage pid or hide new records.

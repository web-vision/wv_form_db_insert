<?php
namespace WebVision\WvFormDbInsert\Service\Form;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * Contains the settings.
 *
 * @author Daniel Siepmann <d.siepmann@web-vision.de>
 */
class Settings
{
    /**
     * @var array
     */
    protected $settings = [];

    /**
     * @param array $settings
     */
    public function __construct(array $settings)
    {
        $this->settings = $settings;

        if (!isset($GLOBALS['TCA'][$this->getTableName()])) {
            throw new \InvalidArgumentException(
                'The configured table "' . $this->getTableName() . '" is configured for insertion, but does not exist.',
                1460553706
            );
        }
    }

    /**
     * Get values that were configured in Backend.
     *
     * @return array
     */
    public function getConfiguredValues()
    {
        $configuredInputs = [];
        if (isset($this->settings['columns'])) {
            $configuredInputs = $this->settings['columns'];
        }

        return $configuredInputs;
    }
    /**
     * Get all allowed columns.
     *
     * @return array
     */
    public function getAllowedColumnNames()
    {
        return array_merge(
            // Columns that will never exist in TCA but are allowed.
            [
                'pid',
            ],
            array_keys($GLOBALS['TCA'][$this->getTableName()]['columns'])
        );
    }

    /**
     * Get the name of the table to use.
     *
     * @return string
     */
    public function getTableName()
    {
        return $this->settings['tableName'];
    }
}

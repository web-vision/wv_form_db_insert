<?php
namespace WebVision\WvFormDbInsert\Form\PostProcessor;

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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Service\TypoScriptService;
use TYPO3\CMS\Extbase\Utility\ArrayUtility;
use TYPO3\CMS\Form\PostProcess as Form;
use WebVision\WvFormDbInsert\Service\Form\Input;
use WebVision\WvFormDbInsert\Service\Form\Settings;

/**
 * PostProcessor for Form-Extension to insert user input into Database.
 *
 * @author Daniel Siepmann <d.siepmann@web-vision.de>
 */
class DbInsert extends Form\AbstractPostProcessor implements Form\PostProcessorInterface
{
    /**
     * Settings from Form-Configuration for this processor.
     *
     * @var Settings
     */
    protected $settings;

    /**
     * Input from form.
     *
     * @var Input
     */
    protected $input;

    /**
     * Process input of Form-Extension.
     *
     * @param \TYPO3\CMS\Form\Domain\Model\Element $form Form domain model
     * @param array $typoScript Post processor TypoScript settings
     */
    public function __construct(\TYPO3\CMS\Form\Domain\Model\Element $form, array $typoScript)
    {
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $this->settings = new Settings(
            $objectManager->get(TypoScriptService::class)
                ->convertTypoScriptArrayToPlainArray($typoScript)
        );
        $this->input = new Input($form->getChildElements());
    }

    /**
     * The main method called by the post processor.
     *
     * @return string The post processing HTML
     */
    public function process()
    {
        $this->insertDataIntoDb($this->buildDbInsert());

        return '';
    }

    /**
     * Insert the given data into DB.
     *
     * @param array $dataToInsert
     *
     * @return void
     */
    protected function insertDataIntoDb(array $dataToInsert)
    {
        // No use of DataHandler, as we are in FE.
        $GLOBALS['TYPO3_DB']->exec_INSERTquery(
            $this->settings->getTableName(),
            $dataToInsert
        );
    }

    /**
     * Generate array with key value for insert into DB.
     *
     * Build from user input in form and settings.
     *
     * @return array
     */
    protected function buildDbInsert()
    {
        return array_filter(
            $this->getMergedInputs(),
            function ($inputName) {
                if (!in_array($inputName, $this->settings->getAllowedColumnNames())) {
                    return false;
                }

                return true;
            },
            ARRAY_FILTER_USE_KEY
        );
    }

    /**
     * Get input for insertion into DB.
     *
     * This is the raw input not validated.
     * Array is key-value paired with column name => value.
     *
     * @return array
     */
    protected function getMergedInputs()
    {
        return ArrayUtility::arrayMergeRecursiveOverrule(
            $this->settings->getConfiguredValues(),
            $this->input->getFormInput()
        );
    }
}

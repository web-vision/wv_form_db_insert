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
use TYPO3\CMS\Form\Domain\Model\Element;
use TYPO3\CMS\Form\PostProcess as Form;
use WebVision\WvFormDbInsert\Service\Form\Input;

/**
 * Hash given inputs.
 *
 * E.g. for passwords.
 *
 * @author Daniel Siepmann <d.siepmann@web-vision.de>
 */
class HashInput extends Form\AbstractPostProcessor implements Form\PostProcessorInterface
{
    /**
     * Settings from Form-Configuration for this processor.
     *
     * @var array
     */
    protected $settings;

    /**
     * Input from form.
     *
     * @var Input
     */
    protected $input;

    /**
     * @var Element
     */
    protected $form;

    /**
     * Process input of Form-Extension.
     *
     * @param Element $form Form domain model
     * @param array $typoScript Post processor TypoScript settings
     */
    public function __construct(Element $form, array $typoScript)
    {
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $this->settings = $objectManager->get(TypoScriptService::class)
            ->convertTypoScriptArrayToPlainArray($typoScript);
        if (!isset($this->settings['fields'])) {
            throw new \InvalidArgumentException('');
        }

        $this->settings['fields'] = GeneralUtility::trimExplode(',', $this->settings['fields']);
        $this->input = new Input($form->getChildElements());
        $this->form = $form;
    }

    /**
     * The main method called by the post processor.
     *
     * @return string The post processing HTML
     */
    public function process()
    {
        $inputs = $this->input->getFormInput();
        foreach ($this->settings['fields'] as $field) {
            if (!isset($inputs[$field])) {
                continue;
            }

            $this->updateInput(
                $field,
                $this->hash($inputs[$field])
            );
        }

        return '';
    }

    /**
     * Hash the given value.
     *
     * @param string $value The value to hash.
     *
     * @return string
     */
    protected function hash($value)
    {
        $hasher = GeneralUtility::makeInstance(
            \TYPO3\CMS\Saltedpasswords\Utility\SaltedPasswordsUtility::getDefaultSaltingHashingMethod()
        );

        return $hasher->getHashedPassword($value);
    }

    /**
     * Update the given input with the new value.
     *
     * @param string $fieldName The name of the field to update.
     * @param mixed $newValue The new value to set for the field.
     *
     * @return void
     */
    protected function updateInput($fieldName, $newValue)
    {
        foreach ($this->form->getChildElements() as $formInput) {
            if ($formInput->getName() === $fieldName) {
                $formInput->setAdditionalArgument('value', $newValue);
                break;
            }
        }
    }
}

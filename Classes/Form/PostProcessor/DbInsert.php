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

use TYPO3\CMS\Form\PostProcess as Form;

/**
 *
 * @author Daniel Siepmann <d.siepmann@web-vision.de>
 */
class DbInsert extends Form\AbstractPostProcessor implements Form\PostProcessorInterface
{
    /**
     * @param \TYPO3\CMS\Form\Domain\Model\Element $form Form domain model
     * @param array $typoScript Post processor TypoScript settings
     */
    public function __construct(\TYPO3\CMS\Form\Domain\Model\Element $form, array $typoScript)
    {
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( func_get_args(), 'func_get_args()', 8, false );die;
    }

    /**
     * The main method called by the post processor
     *
     * @return string The post processing HTML
     */
    public function process()
    {
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( "process", '"process"', 8, false );die;
    }
}

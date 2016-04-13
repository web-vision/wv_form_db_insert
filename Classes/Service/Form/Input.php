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

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Contains the whole input.
 *
 * @author Daniel Siepmann <d.siepmann@web-vision.de>
 */
class Input
{
    /**
     * Contains the key-value pair of user input.
     * @var array
     */
    protected $rawFormInputs = [];

    /**
     * @param ObjectStorage $inputs
     */
    public function __construct(ObjectStorage $inputs)
    {
        foreach ($inputs as $input) {
            $inputInformation = $input->getAdditionalArguments();
            $this->rawFormInputs[$inputInformation['name']] = $inputInformation['value'];
        }
    }

    public function getFormInput()
    {
        return $this->rawFormInputs;
    }
}

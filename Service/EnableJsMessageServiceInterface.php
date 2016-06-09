<?php

/**
 * This file is part of the NepohEnableJsMessageBundle package.
 *
 * @author Nepoh <nepoh@outlook.de>
 */

namespace Nepoh\EnableJsMessageBundle\Service;

interface EnableJsMessageServiceInterface
{
	public function renderMessage($locale = null, $format = null);
	
	public function setTemplating($templating);
}
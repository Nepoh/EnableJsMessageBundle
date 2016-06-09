<?php

/**
 * This file is part of the NepohEnableJsMessageBundle package.
 *
 * @author Nepoh <nepoh@outlook.de>
 */

namespace Nepoh\EnableJsMessageBundle\Twig\Extension;

use Nepoh\EnableJsMessageBundle\Service\EnableJsMessageServiceInterface;

class EnableJsMessageExtension extends \Twig_Extension
{
	protected $enableJsMessageService;
	
	public function __construct(EnableJsMessageServiceInterface $enableJsMessageService)
	{
		$this->enableJsMessageService = $enableJsMessageService;
	}
	
	public function getFunctions()
	{
		return array(
			new \Twig_SimpleFunction('nepoh_enable_js_message', array($this, 'getEnableJsMessage'), array(
				'needs_environment' => true,
				'is_safe' => array('html'),
			)),
		);
	}
	
	public function getEnableJsMessage(\Twig_Environment $twig, $locale = null, $format = null)
	{
		$this->enableJsMessageService->setTemplating($twig);
		
		return $this->enableJsMessageService->renderMessage($locale, $format);
	}
	
	public function getName()
	{
		return 'nepoh_enable_js_message';
	}
}

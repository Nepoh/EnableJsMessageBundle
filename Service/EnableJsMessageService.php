<?php

/**
 * This file is part of the NepohEnableJsMessageBundle package.
 *
 * @author Nepoh <nepoh@outlook.de>
 */

namespace Nepoh\EnableJsMessageBundle\Service;

use Symfony\Component\Templating\EngineInterface;
use Twig_Environment;

class EnableJsMessageService implements EnableJsMessageServiceInterface
{
	protected $config;
	protected $templating;
	
	public function __construct(array $config)
	{
		$this->config = $config;
	}
	
	public function setTemplating($templating)
	{
		if (!($templating instanceof EngineInterface || $templating instanceof Twig_Environment))
		{
			throw new \InvalidArgumentException(sprintf(
				'The second argument passed to %s::__construct must be an instance of %s or %s. $s given.',
				static::class,
				Twig_Environment::class,
				EngineInterface::class,
				is_object($templating) ? get_class($templating) : gettype($templating)
			));
		}
		
		$this->templating = $templating;
	}
	
	public function renderMessage($locale = null, $format = null)
	{
		if (empty($locale))
		{
			$locale = $this->config['locale'];
		}
		
		if (empty($format))
		{
			$format = 'html';
		}
		
		if (!in_array($locale, $this->config['locales']))
		{
			$locale = $this->config['fallback_locale'];
			
			if (!in_array($locale, $this->config['locales']))
			{
				$locale = 'en';
			}
		}
		
		$template = $this->getTemplate($format);
		$url = $this->getUrl($locale);
		
		if ($this->templating && $template)
		{
			return $this->templating->render($template, array(
				'url' => $url,
			));
		}
		else
		{
			$linkText = $this->translator->trans('link_text', [], 'nepoh_enable_js_message');
			$message = $this->translator->trans('message', ['%link%' => $linkText], 'nepoh_enable_js_message');
			$message .= ':' . $url;
			
			return $message;
		}
	}
	
	protected function getUrl($locale)
	{
		$pattern = str_replace(array(
			'%locale%'
		), array(
			$locale
		), $this->config['url']);
		
		return $pattern;
	}
	
	protected function getTemplate($format)
	{
		if ($format == 'txt')
		{
			return null; //'@NepohEnableJsMessage/message/default.txt.twig';
		}
		
		if ($format !== 'html')
		{
			throw new \InvalidArgumentException(sprintf('The format "%s" is unknown.', $format));
		}
		
		$template = $this->config['template'];
		
		if (empty($template) || $template == 'default')
		{
			return '@NepohEnableJsMessage/message/default.html.twig';
		}
		elseif ($template == 'bootstrap')
		{
			return '@NepohEnableJsMessage/message/bootstrap.html.twig';
		}
		
		return $template;
	}
}

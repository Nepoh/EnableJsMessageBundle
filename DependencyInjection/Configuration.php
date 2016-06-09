<?php

/**
 * This file is part of the NepohEnableJsMessageBundle package.
 *
 * @author Nepoh <nepoh@outlook.de>
 */

namespace Nepoh\EnableJsMessageBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration implements ConfigurationInterface
{
	/**
	 * {@inheritDoc}
	 */
	public function getConfigTreeBuilder()
	{
		$treeBuilder = new TreeBuilder();
		$rootNode = $treeBuilder->root('nepoh_enable_js_message');
	
		$rootNode
			->children()
				->scalarNode('url')
					->defaultValue('http://enable-javascript.com/%locale%/')
				->end()
				->scalarNode('locale')
					->defaultValue('%locale%')
				->end()
				->arrayNode('locales')
					->treatNullLike(array())
					->prototype('scalar')->end()
					->defaultValue(['en', 'hr', 'de', 'nl', 'es', 'pt', 'it', 'no', 'ru', 'fr', 'cz', 'ja', 'ko', 'hu', 'th', 'ph', 'tr', 'id', 'sk', 'pl', 'ar', 'ur'])
				->end()
				->scalarNode('fallback_locale')
					->defaultValue('en')
				->end()
				->scalarNode('template')
					->defaultNull()
				->end()
			->end()
		;
		
		return $treeBuilder;
	}
}

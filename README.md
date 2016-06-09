Enable JavaScript Message Bundle
================================

This bundle allows to easily display a message if javascript is not available in the user's browser. A link to http://enable-javascript.com is added where users can find instructions on how to enable javascript in their browsers.


Installation
------------

Install via composer:

    # composer require nepoh/enable-js-message-bundle

Enable the bundle:

    // app/AppKernel.php
	
	// ...
	new \Nepoh\EnableJsMessageBundle(),
	// ...


Usage
-----

The bundle registers the Twig function ``nepoh_enable_js_message`` to display the message.

Examples:

    {{ nepoh_enable_js_message() }}
    
    {# set the locale to be used #}
    {{ nepoh_enable_js_message('it') }}
    
    {# set the format (e.g. plaintext) #}
    {{ nepoh_enable_js_message(null, 'txt') }}

Or you can use the service ``nepoh_enable_js_message`` (in your controller or elsewere):

    // Nepoh\EnableJsMessageBundle\Service\EnableJsMessageServiceInterface
    $service = $this->get('nepoh_enable_js_message');
	
	$messageHtml = $service->renderMessage();
    
	// or with optional parameters
	$italianMessagePlaintext = $service->renderMessage('it', 'txt');

If you don't have TWIG installed, the message will allways be plain text.


Configuration
-------------

    // app/config.yml
    
    nepoh_enable_js_message:
        url: http://enable-javascript.com/%locale%/
		# the default locale
        locale: %locale%
		# all supported locales
        locales: ['en', 'hr', 'de', 'nl', 'es', 'pt', 'it', 'no', 'ru', 'fr', 'cz', 'ja', 'ko', 'hu', 'th', 'ph', 'tr', 'id', 'sk', 'pl', 'ar', 'ur']
        fallback_locale: en
        # set your own template or use one of this bundle's TWIG templates: "default" or "bootstrap" (renders a Twitter Boostrap alert)
		template: ~


Credits
-------

I used the translated messages from [http://enable-javascript.com] - see their website for a list of contributors.

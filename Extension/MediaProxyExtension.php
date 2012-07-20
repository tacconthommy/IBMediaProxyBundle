<?php

namespace IB\MediaProxyBundle\Extension;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Itembase MediaProxyExtension
 *
 * A twig extension to generate and use a proxy path
 *
 * @package default
 * @author Thomas Bretzke, Itembase GmbH
 **/
class MediaProxyExtension extends \Twig_Extension {

	private $router;
	private $container;

	public function __construct(UrlGeneratorInterface $router, $container)
	{
		$this->router = $router;
		$this->container = $container;
	}

	public function getFilters() {
		return array(
			'ib_proxy_url'  => new \Twig_Filter_Method($this, 'proxyUrl'),
		);
	}

	public function proxyUrl($url) {
		$parsedUrl = parse_url($url);
		// Has scheme
		if (array_key_exists('scheme', $parsedUrl)) {
			// If we have to ignore https, we have to pre check the protocol
			if ($this->container->getParameter('ib_media_proxy.ignore_https')) {
				if ($parsedUrl['scheme'] == 'https') {
					return $url;
				}
			}
		} else {
			// If there's no scheme then add prefix
			$prefixPath = $this->container->getParameter('ib_media_proxy.prefix_path');
			return $this->container->getParameter('ib_media_proxy.prefix_path').$url;
		}
		// Generate proxy path
		$hash = hash_hmac($this->container->getParameter('ib_media_proxy.algorithm'), $url, $this->container->getParameter('ib_media_proxy.secret'));
		return $this->router->generate('IBMediaProxyBundle_proxy', array('hash' => urlencode($hash))).'?path='.rawurlencode($url);
	}

	public function getName()
	{
		return 'ib_media_proxy';
	}

}
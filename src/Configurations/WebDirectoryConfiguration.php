<?php declare( strict_types = 1 );
namespace CodeKandis\GrabDaTapes\Configurations;

use CodeKandis\Tiphy\Configurations\AbstractConfiguration;

class WebDirectoryConfiguration extends AbstractConfiguration implements WebDirectoryConfigurationInterface
{
	public function getUri(): string
	{
		return $this->data[ 'uri' ];
	}
}

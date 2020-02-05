<?php declare( strict_types = 1 );
namespace CodeKandis\GrabDaTapes\Configurations;

use CodeKandis\Tiphy\Configurations\AbstractConfigurationRegistry;
use function dirname;

class ConfigurationRegistry extends AbstractConfigurationRegistry
{
	/** @var string */
	private $webDirectoryConfigurationPath = '';

	/** @var WebDirectoryConfigurationInterface */
	private $webDirectoryConfiguration;

	protected function initialize(): void
	{
		$this->setRoutesConfigurationPath( dirname( __DIR__, 2 ) . '/config/routes.php' );
		$this->setPersistenceConfigurationPath( dirname( __DIR__, 2 ) . '/config/persistence.php' );
		$this->setTemplateRendererConfigurationPath( dirname( __DIR__, 2 ) . '/config/templateRenderer.php' );
		$this->setWebDirectoryConfigurationPath( dirname( __DIR__, 2 ) . '/config/webDirectory.php' );
	}

	public function setWebDirectoryConfigurationPath( string $path ): void
	{
		$this->webDirectoryConfigurationPath = $path;
	}

	public function getWebDirectoryConfiguration(): WebDirectoryConfigurationInterface
	{
		return $this->webDirectoryConfiguration
		       ?? $this->webDirectoryConfiguration = new WebDirectoryConfiguration( $this->webDirectoryConfigurationPath );
	}
}

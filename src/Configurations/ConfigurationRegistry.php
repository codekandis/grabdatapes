<?php declare( strict_types = 1 );
namespace CodeKandis\GrabDaTapes\Configurations;

use CodeKandis\TiphySentryClientIntegration\Configurations\AbstractConfigurationRegistry;
use function dirname;

class ConfigurationRegistry extends AbstractConfigurationRegistry
{
	/** @var ?WebDirectoryConfigurationInterface */
	private ?WebDirectoryConfigurationInterface $webDirectoryConfiguration = null;

	protected function initialize(): void
	{
		$this->setPlainSentryClientConfiguration(
			require dirname( __DIR__, 2 ) . '/config/sentryClient.php'
		);
		$this->setPlainRoutesConfiguration(
			( require dirname( __DIR__, 2 ) . '/config/routes.php' )
			+ ( require __DIR__ . '/Plain/routes.php' )
		);
		$this->setPlainTemplateRendererConfiguration(
			require __DIR__ . '/Plain/templateRenderer.php'
		);
		$this->setPlainWebDirectoryConfiguration(
			require dirname( __DIR__, 2 ) . '/config/webDirectory.php'
		);
	}

	public function getWebDirectoryConfiguration(): WebDirectoryConfigurationInterface
	{
		return $this->webDirectoryConfiguration;
	}

	public function setPlainWebDirectoryConfiguration( array $plainWebDirectoryConfiguration ): void
	{
		$this->webDirectoryConfiguration = new WebDirectoryConfiguration( $plainWebDirectoryConfiguration );
	}
}

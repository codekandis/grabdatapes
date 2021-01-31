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
		$this->initializeSentryClientConfiguration();
		$this->initializeRoutesConfiguration();
		$this->initializeTemplateRendererConfiguration();
		$this->initializeWebDirectoryConfiguration();
	}

	public function getWebDirectoryConfiguration(): WebDirectoryConfigurationInterface
	{
		return $this->webDirectoryConfiguration;
	}

	public function setPlainWebDirectoryConfiguration( array $plainWebDirectoryConfiguration ): void
	{
		$this->webDirectoryConfiguration = new WebDirectoryConfiguration( $plainWebDirectoryConfiguration );
	}

	private function initializeSentryClientConfiguration()
	{
		$this->setPlainSentryClientConfiguration(
			( require __DIR__ . '/Plain/sentryClient.php' )
			+ ( require dirname( __DIR__, 2 ) . '/config/sentryClient.php' )
		);
	}

	private function initializeRoutesConfiguration()
	{
		$this->setPlainRoutesConfiguration(
			( require __DIR__ . '/Plain/routes.php' )
			+ ( require dirname( __DIR__, 2 ) . '/config/routes.php' )
		);
	}

	private function initializeTemplateRendererConfiguration()
	{
		$this->setPlainTemplateRendererConfiguration(
			require __DIR__ . '/Plain/templateRenderer.php'
		);
	}

	private function initializeWebDirectoryConfiguration()
	{
		$this->setPlainWebDirectoryConfiguration(
			require dirname( __DIR__, 2 ) . '/config/webDirectory.php'
		);
	}
}

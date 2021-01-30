<?php declare( strict_types = 1 );
namespace CodeKandis\GrabDaTapes\Actions\Web\Get;

use CodeKandis\GrabDaTapes\Configurations\ConfigurationRegistry;
use CodeKandis\GrabDaTapes\Readers\WebDirectoryReader;
use CodeKandis\Tiphy\Actions\AbstractAction;
use CodeKandis\Tiphy\Http\Responses\HtmlTemplateResponder;
use CodeKandis\Tiphy\Http\Responses\StatusCodes;
use ReflectionException;
use Traversable;
use function set_time_limit;
use function strlen;

class IndexAction extends AbstractAction
{
	/**
	 * @throws ReflectionException
	 */
	public function execute(): void
	{
		set_time_limit( 0 );

		/** @var ConfigurationRegistry $configurationRegistry */
		$configurationRegistry = ConfigurationRegistry::_();
		$directoryUri          = $configurationRegistry
			->getWebDirectoryConfiguration()
			->getUri();
		$links                 = $this->readWebDirectory( $directoryUri );

		$responderData          = [
			'links' => $links
		];
		$templateRendererConfig = ConfigurationRegistry::_()->getTemplateRendererConfiguration();
		$responder              = new HtmlTemplateResponder( $templateRendererConfig, StatusCodes::OK, $responderData, null, 'index.phtml' );
		$responder->respond();
	}

	/**
	 * @return string[]
	 */
	private function readWebDirectory( string $directoryUri ): Traversable
	{
		$entries = ( new WebDirectoryReader( $directoryUri ) )
			->fetchEntries();
		foreach ( $entries as $entryFetched )
		{
			if ( '/' === $entryFetched[ strlen( $entryFetched ) - 1 ] )
			{
				yield from $this->readWebDirectory( $entryFetched );
				continue;
			}
			yield $entryFetched;
		}
	}
}

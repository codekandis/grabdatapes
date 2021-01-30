<?php declare( strict_types = 1 );
namespace CodeKandis\GrabDaTapes\Throwables\Handlers;

use CodeKandis\GrabDaTapes\Actions\Web\InternalServerErrorAction;
use CodeKandis\SentryClient\SentryClientInterface;
use CodeKandis\Tiphy\Throwables\Handlers\ThrowableHandlerInterface;
use Throwable;

/**
 * Represents a throwable handler using the `SentryClient` and `InternalServerErrorAction`.
 * @package codekandis/tiphy-sentry-client-integration
 * @author Christian Ramelow <info@codekandis.net>
 */
class InternalServerErrorThrowableHandler implements ThrowableHandlerInterface
{
	/**
	 * Stores the `SentryClient`.
	 * @var SentryClientInterface
	 */
	private SentryClientInterface $sentryClient;

	/**
	 * Constructor method.
	 * @param SentryClientInterface $sentryClient The `SentryClient`.
	 */
	public function __construct( SentryClientInterface $sentryClient )
	{
		$this->sentryClient = $sentryClient;
	}

	/**
	 * Executes the throwable handler.
	 */
	public function execute( Throwable $throwable ): void
	{
		$this->sentryClient->captureThrowable( $throwable );
		( new InternalServerErrorAction( $throwable ) )
			->execute();
	}
}

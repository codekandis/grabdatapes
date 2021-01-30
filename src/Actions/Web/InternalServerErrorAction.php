<?php declare( strict_types = 1 );
namespace CodeKandis\GrabDaTapes\Actions\Web;

use CodeKandis\GrabDaTapes\Configurations\ConfigurationRegistry;
use CodeKandis\Tiphy\Actions\ActionInterface;
use CodeKandis\Tiphy\Http\Responses\HtmlTemplateResponder;
use CodeKandis\Tiphy\Http\Responses\StatusCodes;
use CodeKandis\Tiphy\Http\Responses\StatusMessages;
use CodeKandis\Tiphy\Throwables\ErrorInformation;
use Throwable;
use function var_dump;

/**
 * Represents the default action if an unhandled error occurred during processing the request.
 * @package codekandis/tiphy
 * @author Christian Ramelow <info@codekandis.net>
 */
class InternalServerErrorAction implements ActionInterface
{
	private Throwable $throwable;

	public function __construct( Throwable $throwable )
	{
		$this->throwable = $throwable;
	}

	/**
	 * @inheritDoc
	 */
	public function execute(): void
	{
		$errorInformation = new ErrorInformation( StatusCodes::INTERNAL_SERVER_ERROR, StatusMessages::INTERNAL_SERVER_ERROR, $this->throwable );
		( new HtmlTemplateResponder(
			ConfigurationRegistry::_()->getTemplateRendererConfiguration(),
			StatusCodes::INTERNAL_SERVER_ERROR,
			null,
			$errorInformation,
			'internalServerError.phtml'
		) )
			->respond();
	}
}

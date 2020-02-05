<?php declare( strict_types = 1 );
namespace CodeKandis\GrabDaTapes\Readers;

use DOMDocument;
use DOMElement;
use DOMXPath;
use Traversable;

class WebDirectoryReader implements WebDirectoryReaderInterface
{
	/** @var string */
	private $url;

	public function __construct( string $url )
	{
		$this->url = $url;
	}

	/**
	 * @return string[]
	 */
	public function fetchEntries(): Traversable
	{
		$entriesHtml     = file_get_contents( $this->url );
		$entriesDocument = new DOMDocument();

		$entriesDocument->loadHTML( $entriesHtml );

		$entriesXPath = ( new DOMXPath( $entriesDocument ) )
			->evaluate( '/html/body/pre/a[position( ) > 6]' );
		/** @var DOMElement $entryXPathFetched */
		foreach ( $entriesXPath as $entryXPathFetched )
		{
			yield $this->url . $entryXPathFetched->getAttribute( 'href' );
		}
	}
}

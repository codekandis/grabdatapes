<?php declare( strict_types = 1 );
namespace CodeKandis\GrabDaTapes\Readers;

use Traversable;

interface WebDirectoryReaderInterface
{
	/**
	 * @return string[]
	 */
	public function fetchEntries(): Traversable;
}

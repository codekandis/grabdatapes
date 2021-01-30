<?php declare( strict_types = 1 );
namespace CodeKandis\GrabDaTapes\Configurations;

use CodeKandis\GrabDaTapes\Actions\Web;
use CodeKandis\Tiphy\Http\Requests\Methods;

return [
	'routes' => [
		'/' => [
			Methods::GET => Web\Get\IndexAction::class
		]
	]
];

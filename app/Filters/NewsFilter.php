<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 16-Jul-18
 * Time: 9:46 PM
 */

namespace App\Filters;


class NewsFilter {

	use FilterTrait;

	public $filterFields = [ 'date', 'title' ];

	public $dateAvailableSigns = [ '=', '<', '>', '<=', '>=' ];

	public $titleAvailableSigns = [ 'LIKE' ];

	public $sort = [ 'asc', 'desc' ];

	public $parentSigns = [];

	public function __construct() {
		$this->parentSigns = [
			'date'  => $this->dateAvailableSigns,
			'title' => $this->titleAvailableSigns
		];
	}


}
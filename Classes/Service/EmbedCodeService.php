<?php
namespace Ipf\IpIssuu\Service;

	/* * *************************************************************
	 *  Copyright notice
	 *
	 *  (c) 2013 Ingo Pfennigstorf <i.pfennigstorf@gmail.com>
	 *
	 *  All rights reserved
	 *
	 *  This script is part of the TYPO3 project. The TYPO3 project is
	 *  free software; you can redistribute it and/or modify
	 *  it under the terms of the GNU General Public License as published by
	 *  the Free Software Foundation; either version 3 of the License, or
	 *  (at your option) any later version.
	 *
	 *  The GNU General Public License can be found at
	 *  http://www.gnu.org/copyleft/gpl.html.
	 *
	 *  This script is distributed in the hope that it will be useful,
	 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
	 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 *  GNU General Public License for more details.
	 *
	 *  This copyright notice MUST APPEAR in all copies of the script!
	 * ************************************************************* */

/**
 * Parses abd optimizes the configuration
 */
class EmbedCodeService {

	/**
	 * @param array $settings
	 * @return array
	 */
	public function parseConfiguration($settings) {
		$configuration = array();

		if ($settings['jCode']) {
			$configuration['documentCode'] = $this->parseLink($settings['jCode']);
		}
		$configuration['dimensions'] = $this->parseDimensions($settings);

		return $configuration;
	}

	/**
	 * @param $link
	 * @return string
	 * @throws \Exception
	 */
	public function parseLink($link) {

		//example issuu.com/theflymagazine/docs/the_fly_november_2013?e=9908964/5633389
		$matcher = '|issuu\.com.*?\?e=([0-9]*\/[0-9]*)|';

		if (preg_match($matcher, $link, $code)) {
			return $code[1];
		} else {
			throw new \Exception ('Not a valid issuu link', 1384504350);
		}
	}

	/**
	 * @param array $settings
	 * @return array
	 */
	public function parseDimensions($settings) {

		$dimensions = array(
			'width' => '',
			'height' => ''
		);

		foreach (array_keys($dimensions) as $parameter) {
			if ($settings[$parameter] != 0) {
				$dimensions[$parameter] = $settings[$parameter];
			} else {
				$dimensions[$parameter] = $settings['appearance'][$parameter];
			}
		}

		return $dimensions;
	}

}
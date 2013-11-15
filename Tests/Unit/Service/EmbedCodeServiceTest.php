<?php
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
 * Unit tests for EmbedCodeService
 */
class EmbedCodeServiceTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var Ipf\Issuu\Service\EmbedCodeService
	 */
	protected $fixture;

	/**
	 * @var string
	 */
	protected $exampleLink = 'issuu.com/theflymagazine/docs/the_fly_november_2013?e=9908964/5633389';

	public function settingsProvider() {
		return array(
			array(
				'appearance' => array(
					'height' => 444,
					'width' => 333
				),
				'height' => 555,
				'width' => 666
			),
		);
	}

	public function setUp() {
		$this->fixture = $this->getAccessibleMock('Ipf\\Issuu\\Service\\EmbedCodeService', array('dummy'));
	}

	/**
	 * @test
	 * @expectedException \Exception
	 */
	public function exceptionIsThrownOnInvalidLink() {
		$this->fixture->parseLink('Schnippeldiwippel');
	}

	/**
	 * @test
	 */
	public function documentIdIsCorrectlyStrippedFromLinkCode() {
		$actual = $this->fixture->parseLink($this->exampleLink);
		$expected = '9908964/5633389';
		$this->assertSame($expected, $actual);
	}

	/**
	 * @test
	 */
	public function configurationParserReturnsAnArrayWithDocumentCode() {
		$actual = $this->fixture->parseConfiguration(array('jCode' => $this->exampleLink));
		$this->assertArrayHasKey('documentCode', $actual);
	}

	/**
	 * @test
	 * @expectedException \Exception
	 */
	public function exceptionIsThrownOnInvalidLinkInConfigurationParser() {
		$this->fixture->parseConfiguration(array('jCode' => 'Schnippeldiwippel'));
	}

	/**
	 * @test
	 * @dataProvider settingsProvider
	 */
	public function dimensionsFromFlexFormAreHandledPriorToTypoScriptDefaults() {
		$settings = func_get_args();
		$expected = array('width' => $settings['width'], 'height' => $settings['height']);
		$actual = $this->fixture->parseDimensions($settings);
		$this->assertSame($expected, $actual);
	}

	/**
	 * @test
	 * @dataProvider settingsProvider
	 */
	public function ifNoDimensionsAreProvidedInFlexFormTypoScriptValuesAreTaken() {
		$settings = func_get_args();
		$settings['width'] = '0';
		$settings['height'] = '0';
		$expected = array('width' => $settings['appearance']['width'], 'height' => $settings['appearance']['height']);
		$actual = $this->fixture->parseDimensions($settings);
		$this->assertSame($expected, $actual);
	}

	/**
	 * @test
	 * @dataProvider settingsProvider
	 */
	public function configurationParserContainsDimensions() {
		$actual = $this->fixture->parseConfiguration(func_get_args());
		$this->assertArrayHasKey('dimensions', $actual);
	}
}
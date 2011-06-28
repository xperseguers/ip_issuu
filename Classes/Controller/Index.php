<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Ingo Pfennigstorf <i.pfennigstorf@gmail.com>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 ***************************************************************/

class Tx_IpIssuu_Controller_IndexController extends Tx_Extbase_MVC_Controller_ActionController{

	/**
	 * current hostname
	 *
	 * @var string
	 */
	protected $hostname;

	/**
	 * @var Tx_IpIssuu_Domain_Model_Flip
	 */
	protected $flip;

	public function initializeAction(){
		$this->hostname = t3lib_div::getIndpEnv('TYPO3_HOST_ONLY');
	}

	/**
	 * DI method to gain access to a flip model and its methods
	 *
	 * @param Tx_IpIssuu_Domain_Model_Flip $flip
	 * @return void
	 */
	public function injectFlip(Tx_IpIssuu_Domain_Model_Flip $flip){
		$this->flip = $flip;
	}

	/**
	 * Index Action that reads the settings and generates Javascript data to put it into the header of the site
	 *
	 * @return void
	 */
	public function indexAction(){

			// Code from Flexform
		$embedCode = $this->settings['jCode'];

		$this->parseJoomlaCode($embedCode);

			// transparent Flash to be properly displayed
		$this->flip->setFlashTransparent = $this->settings['flashTrans'];

			// Add Data to header fpr Javascript and Flash incusion
		$this->response->addAdditionalHeaderData(
			'<script type="text/javascript" src="http://www.google.com/jsapi"></script>
			<script type="text/javascript">google.load("swfobject", 2.2);</script>
			<script type="text/javascript">
			 	var attributes = { id: \''.$this->flip->getDocumentid().'\' };
				var params = { '.$this->getTransparentMode().' allowfullscreen: \'true\', menu: \'false\' };
				var flashvars = {
					jsAPIClientDomain: \''.$this->hostname.'\',
					mode: \'embed\',
					backgroundColor:\''.$this->flip->getBackgroundcolor().'\',
					layout: \''.$this->flip->getLayout().'\',
					showFlipBtn: \''.$this->flip->getShowflipbtn().'\',
					documentId: \''.$this->flip->getDocumentid().'\',
					docName: \''.$this->flip->getDocname().'\',
					username: \''.$this->flip->getUsername().'\',
					loadingInfoText: \''.$this->flip->getLoadinginfotext().'\',
					et: \''.time().'\',
					er: \'71\'
				};
				swfobject.embedSWF(
					"http://static.issuu.com/webembed/viewers/style1/v1/IssuuViewer.swf",
					"'.$this->flip->getDocumentid().'",
					"'.$this->flip->getWidth().'",
					"'.$this->flip->getHeight().'",
					"9.0.0","swfobject/expressInstall.swf",
					flashvars,
					params,
					attributes
				);
			</script>'
		);

		$viewVars = array(
			'issuuWidth' => $this->flip->getWidth().$this->flip->getUnit(),
			'issuuHeight' => $this->flip->getHeight().$this->flip->getUnit(),
			'issuId' => $this->flip->getDocumentid()
		);
			// assign to fluid template
		$this->view->assignMultiple($viewVars);
	}

	/**
	 * Parsing the provided Joomla Code and writes the excerpts to local variables
	 *
	 * @throws Exception
	 * @param  string $embedCode
	 * @return void
	 */
	protected function parseJoomlaCode($embedCode){

				// this expression should be matched as of today (2011-06-26)
			$regex = "/\[issuu layout=(.*) showflipbtn=(true|false) documentid=([a-f0-9-]*) docname=(.*) loadinginfotext=(.*) showhtmllink=(true|false) tag=(.*) width=([0-9]*) height=([0-9]*) unit=(.*)\]/";

		if (preg_match($regex, $embedCode, $results)){

				// Putting results into Class variables
			$this->flip->setLayout($results[1]);

			$this->flip->setShowflipbtn($results[2]);

			$this->flip->setDocumentid($results[3]);

			$this->flip->setDocname($results[4]);

			$this->flip->setLoadinginfotext($results[5]);

			$this->flip->setShowhtmllink($results[6]);

			$this->flip->setWidth($results[8]);

			$this->flip->setHeight($results[9]);

			$this->flip->setUnit($results[10]);

		} else {
			throw new Exception("Wrong embeddingcode. Please visit www.issuu.com for details on the code", 1309094974);
		}

	}
	/**
	 * Experimental Use of wmode = transparent
	 * 
	 * @return string
	 */
	protected function getTransparentMode(){

		$this->flip->getFlashTransparent === 1 ? $wmode = 'wmode: \'transparent\',' : $wmode = '';

		return $wmode;
	}
}

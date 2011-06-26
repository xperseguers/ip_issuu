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

		// SWFObject Version to fetch
	protected $swfObjectVersion = '2.2';

		// div id for the playeer
	protected $contentId = null;

		// flashvars
	protected $layout;
	protected $backgroundcolor ='FFFFFF';
	protected $showflipbtn = TRUE;
	protected $documentid = NULL;
	protected $docname;
	protected $username;
	protected $loadinginfotext;
	protected $width;
	protected $height;
	protected $unit = 'px';
	protected $hostname;

	/**
	 * @var boolean
	 */
	protected $showhtmllink;

		// experimental
	protected $flashTransparent;

	public function initializeAction(){

		$this->hostname = t3lib_div::getIndpEnv('TYPO3_HOST_ONLY');

	}


	public function indexAction(){


			// div id of the player
		$this->contentId = 'issuuViewer-'.$GLOBALS['TSFE']->id;

			// Code from Flexform
		$embedCode = $this->settings['jCode'];

		$this->parseJoomlaCode($embedCode);

			// transparent Flash to be properly displayed
		$this->flashTransparent = $this->settings['flashTrans'];

			// Add Data to header fpr Javascript and Flash incusion
		$this->response->addAdditionalHeaderData(
			'<script type="text/javascript" src="http://www.google.com/jsapi"></script><script type="text/javascript">google.load("swfobject", 2.2);</script>
			<script type="text/javascript">
			 	var attributes = { id: \''.$this->contentId.'\' };
				var params = { '.$this->getTransparentMode().' allowfullscreen: \'true\', menu: \'false\' };
				var flashvars = {
					jsAPIClientDomain: \''.$this->hostname.'\',
					mode: \'embed\',
					backgroundColor:\''.$this->backgroundcolor.'\',
					layout: \''.$this->layout.'\',
					showFlipBtn: \''.$this->showflipbtn.'\',
					documentId: \''.$this->documentid.'\',
					docName: \''.$this->docname.'\',
					username: \''.$this->username.'\',
					loadingInfoText: \''.$this->loadinginfotext.'\',
					et: \''.time().'\',
					er: \'71\'
				};
				swfobject.embedSWF(
					"http://static.issuu.com/webembed/viewers/style1/v1/IssuuViewer.swf",
					"'.$this->documentid.'",
					"'.$this->width.'",
					"'.$this->height.'",
					"9.0.0","swfobject/expressInstall.swf",
					flashvars,
					params,
					attributes
				);
			</script>'
		);

		$this->view->assign("issuuWidth", $this->width.$this->unit);
		$this->view->assign("issuuHeight", $this->height.$this->unit);
		$this->view->assign("issuId", $this->documentid);
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
			$this->layout = $results[1];

			$this->showflipbtn = $results[2];

			$this->documentid = $results[3];

			$this->docname = $results[4];

			$this->loadinginfotext = $results[5];

			$this->showhtmllink = $results[6];

			$this->width = $results[8];

			$this->height = $results[9];

			$this->unit = $results[10];

		} else {
			throw new Exception("Wrong embeddingcode. Please visit www.issuu.com for details on the code", 1309094974);
		}

	}
	/**
	 * Experimental Use of wmode = transparent
	 * 
	 * @TODO Testing
	 * @return string
	 */
	private function getTransparentMode(){

		$this->flashTransparent === 1 ? $wmode = 'wmode: \'transparent\',' : $wmode = '';

		return $wmode;
	}
}

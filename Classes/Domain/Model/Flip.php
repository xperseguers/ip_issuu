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

/**
 * Model for a Flip Catalogue
 *
 * @author Ingo Pfennigstorf <i.ofennigstorf@gmail.com>
 * @date 27.06.11
 **/
class Tx_IpIssuu_Domain_Model_Flip extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * SWFObject Version to fetch
	 * 
	 * @var string
	 */
	protected $swfObjectVersion = '2.2';

	/**
	 * div id for the player
	 *
	 * @var string
	 */
	protected $contentId = null;

	/**
	 * url to the layout
	 *
	 * @var string
	 */
	protected $layout;

	/**
	 * @var string
	 */
	protected $backgroundcolor ='FFFFFF';

	/**
	 * @var bool
	 */
	protected $showflipbtn = TRUE;

	/**
	 * @var string
	 */
	protected $documentid = NULL;

	/**
	 * @var string
	 */
	protected $docname;

	/**
	 * @var string
	 * @deprecated
	 */
	protected $username;

	/**
	 * @var string
	 */
	protected $loadinginfotext;

	/**
	 * @var int
	 */
	protected $width;

	/**
	 * @var height
	 */
	protected $height;

	/**
	 * @var string
	 */
	protected $unit = 'px';

	/**
	 * @var string
	 */
	protected $hostname;

	/**
	 * @var bool
	 */
	protected $showhtmllink;

	/**
	 * If the flash shall be transparent
	 *
	 * @var string
	 */
	protected $flashTransparent;

	/**
	 * @param string $backgroundcolor
	 */
	public function setBackgroundcolor($backgroundcolor)
	{
		$this->backgroundcolor = $backgroundcolor;
	}

	/**
	 * @return string
	 */
	public function getBackgroundcolor()
	{
		return $this->backgroundcolor;
	}

	/**
	 * @param string $contentId
	 */
	public function setContentId($contentId)
	{
		$this->contentId = $contentId;
	}

	/**
	 * @return string
	 */
	public function getContentId()
	{
		return $this->contentId;
	}

	/**
	 * @param string $docname
	 */
	public function setDocname($docname)
	{
		$this->docname = $docname;
	}

	/**
	 * @return string
	 */
	public function getDocname()
	{
		return $this->docname;
	}

	/**
	 * @param string $documentid
	 */
	public function setDocumentid($documentid)
	{
		$this->documentid = $documentid;
	}

	/**
	 * @return string
	 */
	public function getDocumentid()
	{
		return $this->documentid;
	}

	/**
	 * @param string $flashTransparent
	 */
	public function setFlashTransparent($flashTransparent)
	{
		$this->flashTransparent = $flashTransparent;
	}

	/**
	 * @return string
	 */
	public function getFlashTransparent()
	{
		return $this->flashTransparent;
	}

	/**
	 * @param \height $height
	 */
	public function setHeight($height)
	{
		$this->height = $height;
	}

	/**
	 * @return \height
	 */
	public function getHeight()
	{
		return $this->height;
	}

	/**
	 * @param string $hostname
	 */
	public function setHostname($hostname)
	{
		$this->hostname = $hostname;
	}

	/**
	 * @return string
	 */
	public function getHostname()
	{
		return $this->hostname;
	}

	/**
	 * @param string $layout
	 */
	public function setLayout($layout)
	{
		$this->layout = $layout;
	}

	/**
	 * @return string
	 */
	public function getLayout()
	{
		return $this->layout;
	}

	/**
	 * @param string $loadinginfotext
	 */
	public function setLoadinginfotext($loadinginfotext)
	{
		$this->loadinginfotext = $loadinginfotext;
	}

	/**
	 * @return string
	 */
	public function getLoadinginfotext()
	{
		return $this->loadinginfotext;
	}

	/**
	 * @param bool $showflipbtn
	 */
	public function setShowflipbtn($showflipbtn)
	{
		$this->showflipbtn = $showflipbtn;
	}

	/**
	 * @return bool
	 */
	public function getShowflipbtn()
	{
		return $this->showflipbtn;
	}

	/**
	 * @param bool $showhtmllink
	 */
	public function setShowhtmllink($showhtmllink)
	{
		$this->showhtmllink = $showhtmllink;
	}

	/**
	 * @return bool
	 */
	public function getShowhtmllink()
	{
		return $this->showhtmllink;
	}

	/**
	 * @param string $swfObjectVersion
	 */
	public function setSwfObjectVersion($swfObjectVersion)
	{
		$this->swfObjectVersion = $swfObjectVersion;
	}

	/**
	 * @return string
	 */
	public function getSwfObjectVersion()
	{
		return $this->swfObjectVersion;
	}

	/**
	 * @param string $unit
	 */
	public function setUnit($unit)
	{
		$this->unit = $unit;
	}

	/**
	 * @return string
	 */
	public function getUnit()
	{
		return $this->unit;
	}

	/**
	 * @param string $username
	 */
	public function setUsername($username)
	{
		$this->username = $username;
	}

	/**
	 * @return string
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * @param int $width
	 */
	public function setWidth($width)
	{
		$this->width = $width;
	}

	/**
	 * @return int
	 */
	public function getWidth()
	{
		return $this->width;
	}
}
?>
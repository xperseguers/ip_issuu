<?php
namespace Ipf\IpIssuu\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011-2016 Ingo Pfennigstorf <i.pfennigstorf@gmail.com>
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
 ***************************************************************/

class IndexController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * @var \Ipf\IpIssuu\Service\EmbedCodeService
     * @inject
     */
    protected $embedCodeService;

    /**
     * Index Action that reads the settings and generates Javascript data to put it into the header of the site
     *
     * @return void
     */
    public function indexAction()
    {

        try {
            $configuration = $this->embedCodeService->parseConfiguration($this->settings);

            $this->view->assign('embedCode', $configuration);
        } catch (\Exception $e) {
            /** @var $flashMessage \TYPO3\CMS\Core\Messaging\FlashMessage */
            $flashMessage = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
                'TYPO3\\CMS\\Core\\Messaging\\FlashMessage', $e->getMessage(), $e->getCode(), \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR, true
            );
            $this->controllerContext->getFlashMessageQueue()->enqueue($flashMessage);
        }
    }

}

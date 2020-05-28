<?php
namespace ValueSuggest\Controller\Site;

use ValueSuggest\Controller\AbstractIndexController;

class IndexController extends AbstractIndexController
{
    public function proxyAction()
    {
        // Check rights.
        // Normally, the form is not displayed if the user is not allowed, but
        // check is needed  for a direct query.
        $allowedRoles = $this->siteSettings()->get('collecting_roles', []);
        if ($allowedRoles) {
            $user = $this->identity();
            if (!$user) {
                return $this->getResponse()
                    ->setStatusCode(\Zend\Http\Response::STATUS_CODE_403)
                    ->setContent('Unauthorized access.');
            }

            // Check role and acl for items (allow standard roles).
            $userRole = $user->getRole();
            if (!in_array($userRole, $allowedRoles)) {
                if (!$this->userIsAllowed(\Omeka\Entity\Item::class, 'create')) {
                    return $this->getResponse()
                        ->setStatusCode(\Zend\Http\Response::STATUS_CODE_403)
                        ->setContent('Unauthorized access.');
                }
            }
        }

        // TODO Check the current prompt too.

        return parent::proxyAction();
    }
}

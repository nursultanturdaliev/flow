<?php
namespace TYPO3\Flow\Tests\Functional\Security;

/*                                                                        *
 * This script belongs to the Flow framework.                             *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the MIT license.                                          *
 *                                                                        */

/**
 * Testcase for method security
 *
 */
class MethodSecurityTest extends \TYPO3\Flow\Tests\FunctionalTestCase
{
    /**
     * @var boolean
     */
    protected $testableSecurityEnabled = true;

    /**
     * @var \TYPO3\Flow\Tests\Functional\Security\Fixtures\Controller\RestrictedController
     */
    protected $restrictedController;

    /**
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->restrictedController = $this->objectManager->get('TYPO3\Flow\Tests\Functional\Security\Fixtures\Controller\RestrictedController');
    }

    /**
     * @test
     */
    public function publicActionIsGrantedForEverybody()
    {
        $this->restrictedController->publicAction();
        // dummy assertion to avoid PHPUnit warning
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function publicActionIsGrantedForCustomer()
    {
        $this->authenticateRoles(array('TYPO3.Flow:Customer'));
        $this->restrictedController->publicAction();
        // dummy assertion to avoid PHPUnit warning
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function publicActionIsGrantedForAdministrator()
    {
        $this->authenticateRoles(array('TYPO3.Flow:Administrator'));
        $this->restrictedController->publicAction();
        // dummy assertion to avoid PHPUnit warning
        $this->assertTrue(true);
    }

    /**
     * @test
     * @expectedException \TYPO3\Flow\Security\Exception\AccessDeniedException
     */
    public function customerActionIsDeniedForEverybody()
    {
        $this->restrictedController->customerAction();
    }

    /**
     * @test
     */
    public function customerActionIsGrantedForCustomer()
    {
        $this->authenticateRoles(array('TYPO3.Flow:Customer'));
        $this->restrictedController->customerAction();
        // dummy assertion to avoid PHPUnit warning
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function customerActionIsGrantedForAdministrator()
    {
        $this->authenticateRoles(array('TYPO3.Flow:Administrator'));
        $this->restrictedController->customerAction();
        // dummy assertion to avoid PHPUnit warning
        $this->assertTrue(true);
    }

    /**
     * @test
     * @expectedException \TYPO3\Flow\Security\Exception\AccessDeniedException
     */
    public function adminActionIsDeniedForEverybody()
    {
        $this->restrictedController->adminAction();
    }

    /**
     * @test
     * @expectedException \TYPO3\Flow\Security\Exception\AccessDeniedException
     */
    public function adminActionIsDeniedForCustomer()
    {
        $this->authenticateRoles(array('TYPO3.Flow:Customer'));
        $this->restrictedController->adminAction();
    }

    /**
     * @test
     */
    public function adminActionIsGrantedForAdministrator()
    {
        $this->authenticateRoles(array('TYPO3.Flow:Administrator'));
        $this->restrictedController->adminAction();
        // dummy assertion to avoid PHPUnit warning
        $this->assertTrue(true);
    }
}
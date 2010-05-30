<?php
declare(ENCODING = 'utf-8');
namespace F3\FLOW3\Locale\CLDR;

/*                                                                        *
 * This script belongs to the FLOW3 framework.                            *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License as published by the *
 * Free Software Foundation, either version 3 of the License, or (at your *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
 * General Public License for more details.                               *
 *                                                                        *
 * You should have received a copy of the GNU Lesser General Public       *
 * License along with the script.                                         *
 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * Testcase for the HierarchicalCLDRModel
 *
 * @version $Id$
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 */
class HierarchicalCLDRModelTest extends \F3\Testing\BaseTestCase {

	/**
	 * @var \F3\FLOW3\Locale\CLDR\HierarchicalCLDRModel
	 */
	protected $model;

	/**
	 * @return void
	 * @author Karol Gusak <firstname@lastname.eu>
	 */
	public function setUp() {
		$mockCLDRModelChild = $this->getMock('F3\FLOW3\Locale\CLDR\CLDRModel');
		$mockCLDRModelChild->expects($this->at(0))->method('get')->with('foo')->will($this->returnValue('child_has_foo'));
		$mockCLDRModelChild->expects($this->at(1))->method('get')->with('bar')->will($this->returnValue(FALSE));
		$mockCLDRModelChild->expects($this->at(2))->method('get')->with('baz')->will($this->returnValue(FALSE));

		$mockCLDRModelParent = $this->getMock('F3\FLOW3\Locale\CLDR\CLDRModel');
		$mockCLDRModelParent->expects($this->at(0))->method('get')->with('bar')->will($this->returnValue('parent_has_bar'));
		$mockCLDRModelParent->expects($this->at(1))->method('get')->with('baz')->will($this->returnValue(FALSE));


		$this->model = new \F3\FLOW3\Locale\CLDR\HierarchicalCLDRModel();
		$this->model->initializeObject(array($mockCLDRModelChild, $mockCLDRModelParent));
	}

	/**
	 * @test
	 * @author Karol Gusak <firstname@lastname.eu>
	 */
	public function getWorks() {
		$result = $this->model->get('foo');
		$this->assertEquals('child_has_foo', $result);

		$result = $this->model->get('bar');
		$this->assertEquals('parent_has_bar', $result);

		$result = $this->model->get('baz');
		$this->assertEquals(FALSE, $result);
	}
}

?>
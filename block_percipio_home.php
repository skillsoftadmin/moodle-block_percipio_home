<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Form for editing HTML block instances.
 *
 * @package   block_percipio_home
 * @copyright  2022 Skillsoft Ireland Limited - All rights reserved.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $USER, $CFG, $DB, $OUTPUT;

/**
 * block_percipio_home external functions
 *
 * @package    block_percipio_home
 * @category   external
 * @copyright  2022 Skillsoft Ireland Limited - All rights reserved.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_percipio_home extends block_base {


    /**
     * Init Function
     *
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_percipio_home');
    }
    /**
     * Init Function
     *
     * @return true
     */
    public function has_config() {
        return true;
    }
    /**
     * applicable_formats Function
     *
     * @return array true
     */
    public function applicable_formats() {
        return array('all' => true);
    }
    /**
     * specialization Function
     *
     * @return string title
     */
    public function specialization() {
        if (isset($this->config->title)) {
            $this->title = $this->title = format_string($this->config->title, true, ['context' => $this->context]);
        } else {
            $this->title = '';
        }
    }
    /**
     * instance_allow_multiple Function
     *
     * @return true
     */
    public function instance_allow_multiple() {
        return true;
    }


    /**
     * get_content Function
     *
     * @return content
     */
    public function get_content() {

        global $CFG;

        if ($this->content !== null) {
            return $this->content;
        }
        $param = ['launchurl' => 'https://xapi.percipio.com/xapi/percipio/', 'sesskey' => sesskey(), 'cfgwwwroot' => $CFG->wwwroot];
        $this->page->requires->jquery();
        $this->page->requires->js('/blocks/percipio_home/js/launch.js');
        $this->page->requires->js_init_call('callajax', [$param]);

        $html = '';
        $html .= html_writer::empty_tag('input', ['type' => 'image', 'class' => 'launch_course',
        'src' => $CFG->wwwroot.'/mod/percipio/pix/percipiologo.png', 'alt' => 'SkillSoft', 'height' => '50', 'width' => '150']);
        $this->content = new stdClass;
        $this->content->text = $html;
        return $this->content;
    }

}

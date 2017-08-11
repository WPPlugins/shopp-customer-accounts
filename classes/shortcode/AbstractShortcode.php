<?php

/**
 * Generic shortcode handler.
 *
 * @author Tyson
 */
abstract class AbstractShortcode {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->register();
	}

	/**
	 * The actual shortcode string.
	 *
	 * Can return an array of shortcodes, they will all be mapped.
	 */
	protected abstract function getShortcode();

	/**
	 * The default attributes.
	 */
	protected abstract function getDefaultAttributes();
	
	/**
	 * Handle the shortcode call.
	 *
	 * @param array $input The shortcode attributes, with defaults added.
	 */
	protected abstract function handle(array $input);
	
	/**
	 * Registers the shorcode.
	 */
	protected function register() {
		$codes = $this->getShortcode();
		if (!is_array($codes)) {
			$codes = array($codes);
		}
		foreach ($codes as $code) {
			add_shortcode($code, array($this, 'process'));
		}

	}

	/**
	 * Get title of this shortcode.
	 * 
	 * Default returns the class name with spaces before each capital letter.
	 * @see http://bytes.com/topic/php/answers/744705-splitting-name-based-capital-letters
	 */
	public function getTitle() {
		return preg_replace('/[A-Z]/', ' $0', get_class($this));
	}
	
	/**
	 * Get HTML help describing this shortcode.
	 */
	public function getHelp() {
		
		$s = '';
		$atts = $this->getDefaultAttributes();
		$codes = $this->getShortcode();
		$codes_by_size = array();
		$i = 0;
		
		//sort codes by length
		foreach ($codes as $code) {
			$codes_by_size[strlen($code)] = $code;
		}
		ksort($codes_by_size);
		
		foreach ($codes_by_size as $sc) {
			$s .= "<b>[$sc</b>";
			if (!empty($atts)) {
				if (++$i == count($atts)) {
					foreach ($atts as $name => $value) {
						$s .= " [<i><b>$name</b></i>='<i>&lt;$value&gt;</i>'";
					}
					for ($j=0; $j<count($atts); $j++) {
						$s .= ']';
					}
				} else {
					$s .= " ...";
				}
			}
			$s .= "<b>]</b><br/>\n";
		}

		$desc = $this->getAttributeDescriptions();
		if (!empty($desc)) {
			$s .= "<br/>";
			$s .= "<h3>Attribute descriptions:</h3>";
			$s .= "<ul>";
			foreach ($desc as $k => $v) {
				$s .= "<li><b>$k:</b> $v</li>";
			}
			$s .= "</ul>";
		}
		
		return $s;
		
	}

	/**
	 * Return help for each attribute.
	 * 
	 * Default returns an empty array.
	 */
	public function getAttributeDescriptions() {
		return array();
	}
	
	/**
	 * Processes the shortcode call.
	 *
	 * @param $atts
	 */
	public function process($atts) {

		//get input and defaults
		$input = shortcode_atts($this->getDefaultAttributes(), $atts);

		//call concrete method
		return $this->handle($input);

	}

}
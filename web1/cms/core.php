<?php
	namespace TinelixCms;
	
	include_once dirname(__FILE__) . '/content/pages.php';
	include_once dirname(__FILE__) . '/templates/default.php';
	include_once dirname(__FILE__) . '/includes.php';
	
	require dirname(__FILE__) . '/libs/HTMLPurifier/HTMLPurifier.standalone.php';
	
	use TinelixCms\Templates\DefaultTemplate;
	use TinelixCms\Content\PagesCollection;
	
	class Core {
		
		public $db;
		public $priv_db;
		public $template;
		public $enconding;
		public $pages;
		public $purifier;
		public $protocol;
		
		public function __construct($protocol, $enconding) {
			$this->db = new \SQLite3(dirname(__FILE__) . '/pub.db');
			$this->priv_db  = new \SQLite3(dirname(__FILE__) . '/priv.db');

			if(isset($protocol))
				$this->protocol = $protocol;
			else
				$this->protocol = "http://";
			
			if (isset($encoding))
				$this->encoding = $encoding;
			else if (strlen($_GET["encoding"]) > 0)
				$this->encoding = $_GET["encoding"];
			else
				$this->encoding = "cp1251";
			
			$config = \HTMLPurifier_Config::createDefault();
			$config->set('HTML.AllowedAttributes',
						 '*.style, *.class, a.href, a.name, p.align, table.rules, table.cellpadding, table.cellspacing, table.align, table.width, table.border, '
						 .'table.border, table.frame, td.align, td.rowspan, td.width, td.height, '
						 .'td.colspan, img.width, img.height, img.alt, '
						 .'img.src');
			$config->set('URI.DisableExternal', false);
			$config->set('Attr.EnableID', true);
			$config->set('HTML.Allowed', 'h1, h2, h3, h4, h5, h6, img, table, tbody, tr, td, p, br, b, i, a');
			
			$this->purifier = new \HTMLPurifier($config);
			
			$this->template = new DefaultTemplate($this->db, $this);
			$this->pages = new PagesCollection($this->db, $this->priv_db, $this);
		}

		public static function getFullFormattedMskTime() {
			$current_time = new \DateTime('now', new \DateTimeZone('Europe/Moscow'));
			$current_time->setTimestamp($current_time->getTimestamp() + (3 * 60 * 60));
			$dw = date("w", $current_time->getTimestamp());
			$formatter = new \IntlDateFormatter('ru_RU', \IntlDateFormatter::MEDIUM, \IntlDateFormatter::MEDIUM);
			$dws = array('Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота');
			$formatter->setPattern('dd.MM.yyyy');
			$format_date = $formatter->format($current_time);
			return $dws[$dw].", ".$format_date;
		}

		public static function getFormattedDateTime($timezone = 'Europe/Moscow', $pattern, $day_of_week = true) {
			$current_time = new \DateTime('now', new \DateTimeZone($timezone));
			$current_time->setTimestamp($current_time->getTimestamp() + (3 * 60 * 60));
			$dw = date("w", $current_time->getTimestamp());
			$format_dt = $current_time->format($pattern);
			$dws = array('Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота');
			if($day_of_week)
				return $dws[$dw].", ".$format_dt;
			else
				return $format_dt;
		}


		public static function getCurrentYear() {
			$current_time = new \DateTime('now', new \DateTimeZone('Europe/Moscow'));
                        $current_time->setTimestamp($current_time->getTimestamp() + (3 * 60 * 60));
			$year = $current_time->format('Y');
			return (int)$year;
		}

		public static function getLastUpdatedDate() {
			return "10.01.2026";
		}
		
		public function closeDatabase() {
			$this->db->close();
			unset($db);
		}
    }
?>

<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	
	var $actsAs = array('Containable');
	var $appNotices = array();
	
	protected function saveImage($image, $options = array()) {
		if (is_array($image) && !empty($image['name'])) {
			$imagePrefix = rand(33, 99) . '_';
			
			$newImageName = $imagePrefix . $image['name'];
			
			$newImageFilename = $this->getImagePath() . $newImageName;
			
			if (move_uploaded_file($image['tmp_name'], $newImageFilename)) {
				$newThumbnailFilename = $this->getImagePath() . 'mini_' . $newImageName;
				if ($this->createThumbnail($newImageFilename, $newThumbnailFilename)) {
					return $newImageName;
				} else {
					return false;
				}
			} else {
				return false;
				unset($this->data[$this->alias]['image']);
			}
		} else {
			return false;
		}
	}
	
	public function createThumbnail($sourceFilename, $targetFilename, $options = array()) {
		$defaultOptions = array(
			'q' => 85,
			'f' => 'jpg',
			'w' => 700,
			'h' => 700
		);

		$options = array_merge($defaultOptions, $options);

        // Load phpThumb
		App::import('Vendor', 'phpThumb', array('file' => 'phpThumb' . DS . 'phpthumb.class.php'));
        $phpThumb = new phpThumb();
        $phpThumb->setSourceFilename($sourceFilename);
        $phpThumb->setParameter('q', $options['q']);
        $phpThumb->setParameter('f', $options['f']);
        $phpThumb->setParameter('w', $options['w']);
        $phpThumb->setParameter('h', $options['h']);
        $phpThumb->setParameter('zc', 0);

        if ($phpThumb->GenerateThumbnail()) {
            if ($phpThumb->RenderToFile($targetFilename)) {
				return true;
            } else {
				return false;
			}
        } else {
			return false;
        }
	}
	
	public function getImagePath() {
		return WWW_ROOT . 'img' . DS . strtolower(Inflector::pluralize($this->alias)) . DS;
	}
}

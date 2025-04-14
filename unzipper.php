<?php
/**
 * The Unzipper extracts .zip or .rar archives and .gz files on webservers.
 * It's handy if you do not have shell access. E.g. if you want to upload a lot
 * of files (php framework or image collection) as an archive to save time.
 * As of version 0.1.0 it also supports creating archives.
 *
 * @author  Andreas Tasch, at[tec], attec.at
 * @license GNU GPL v3
 * @package attec.toolbox
 * @version 0.1.1
 */
define('VERSION', '0.1.1');

$GLOBALS['status'] = array();

$unzipper = new Unzipper;

$archive = 'project.zip';
$destination = '.';
$unzipper->prepareExtraction($archive, $destination);

var_dump($GLOBALS['status']);

/**
 * Class Unzipper
 */
class Unzipper {
  public $localdir = '.';
  public $zipfiles = array();

  public function __construct() {
    // Read directory and pick .zip, .rar and .gz files.
    if ($dh = opendir($this->localdir)) {
      while (($file = readdir($dh)) !== FALSE) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'zip'
          || pathinfo($file, PATHINFO_EXTENSION) === 'gz'
          || pathinfo($file, PATHINFO_EXTENSION) === 'rar'
        ) {
          $this->zipfiles[] = $file;
        }
      }
      closedir($dh);

      if (!empty($this->zipfiles)) {
        $GLOBALS['status'] = array('info' => '.zip or .gz or .rar files found, ready for extraction');
      }
      else {
        $GLOBALS['status'] = array('info' => 'No .zip or .gz or rar files found. So only zipping functionality available.');
      }
    }
  }

  /**
   * Prepare and check zipfile for extraction.
   *
   * @param string $archive
   *   The archive name including file extension. E.g. my_archive.zip.
   * @param string $destination
   *   The relative destination path where to extract files.
   */
  public function prepareExtraction($archive, $destination = '') {
    // Determine paths.
    if (empty($destination)) {
      $extpath = $this->localdir;
    }
    else {
      $extpath = $this->localdir . '/' . $destination;
      // Todo: move this to extraction function.
      if (!is_dir($extpath)) {
        mkdir($extpath);
      }
    }
    // Only local existing archives are allowed to be extracted.
    if (in_array($archive, $this->zipfiles)) {

      self::extractZipArchive($archive, $extpath);
    }
  }

    /**
     * Decompress/extract a zip archive using ZipArchive.
     *
     * @param string $archive
     * @param string $destination
     */
    public static function extractZipArchive($archive, $destination) {
        // Check if webserver supports unzipping.
        if (!class_exists('ZipArchive')) {
            $GLOBALS['status'] = array('error' => 'Error: Your PHP version does not support unzip functionality.');
            return;
        }

        $zip = new ZipArchive;

        // Check if archive is readable.
        if ($zip->open($archive) === TRUE) {
            // Check if destination is writable
            if (is_writeable($destination . '/')) {
                // Use FL_OVERWRITE flag to overwrite existing files during extraction
                $flg = ZipArchive::FL_OVERWRITE;

                // Extract the entire archive to the destination with the FL_OVERWRITE flag
                $zip->extractTo($destination, null, $flg);

                $zip->close();
                $GLOBALS['status'] = array('success' => 'Files unzipped successfully');
            } else {
                $GLOBALS['status'] = array('error' => 'Error: Directory not writeable by webserver.');
            }
        } else {
            $GLOBALS['status'] = array('error' => 'Error: Cannot read .zip archive.');
        }
    }

}

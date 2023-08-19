<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'vendors/Parsedown.php';
require_once 'vendors/ParsedownExtra.php';

/**
 * Markdown directory
 * @var   String
 */
const _MD_DIR = '../markdown/';
/**
 * Pages directory
 * @var   String
 */
const _PAGES_DIR = '../pages/';

/**
 * Create html page
 * 
 * @param   String $content
 * @param   array $og open graph tags
 * @return   String created html page
 */
function createPage(String $content, array $og = array()): String
{
   $t_TITLE = (preg_match('#<h1>(.+)<\/h1>#i', $content, $matches)) ?
      $matches[1] : 'Untited';
   $t_CONTENT = $content;
   $t_OPEN_GRAPH = array(
      'title' => (preg_match('#<h1>(.+)<\/h1>#i', $content, $matches)) ?
         $matches[1] : null,
      'description' => (preg_match('#<p>(.+)<\/p>#i', $content, $matches)) ?
         $matches[1] : null,
      'img' => (preg_match('#img src="(.+)"#i', $content, $matches)) ?
         $matches[1] : null
   );
   
   return require('templates/default.php');
}

/**
 * Create html file
 * 
 * @param   String $pathToMD md that create html file
 * @param   String $pathToHTML html file to create
 * @param   array $ogTags open graph tags, optional
 */
function createHTMLFile(String $pathToMD, String $pathToHTML, Array $ogTags = array()) 
{
   if (file_exists($pathToMD) && is_file($pathToMD)) {
      $mdFile = fopen($pathToMD, 'r');
      $mdFileContent = fread($mdFile, 1024);
      fclose($mdFile);
      
      $Extra = new ParsedownExtra();
      $htmlFromMD = $Extra->text($mdFileContent);
      
      $htmlContent = createPage($htmlFromMD, $ogTags);
      
      // result of writing to file
      $wFileResult = file_put_contents($pathToHTML, $htmlContent);
      if ($wFileResult !== false) {
         echo $pathToHTML .' : ' .$wFileResult .'\n';
      }
   }
}

function createHTMLFilesByDirName(String $dirName = '') {
   if ($dirName !== '') $dirName .= '/';
   $mdFilenames = scandir(_MD_DIR ."$dirName");
   foreach ($mdFilenames as $mdFilename) {
      $pathToMD = _MD_DIR ."$dirName" ."$mdFilename";
      $pathToHTML = _PAGES_DIR ."$dirName" .preg_replace('#\.md$#i', '.html', $mdFilename);
      
      createHTMLFile($pathToMD, $pathToHTML);
   }
}
(function() {
   createHTMLFilesByDirName('blogs');
   createHTMLFilesByDirName();
})();

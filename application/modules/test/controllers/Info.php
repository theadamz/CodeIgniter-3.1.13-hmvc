<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Info extends MY_Controller
{

   function __construct()
   {
      parent::__construct();
      // Jika production maka tidak bisa diakses
      if ((ENVIRONMENT == 'production')) {
         show_404();
         exit(4);
      }
   }

   public function index()
   {
      $this->info_test_db();
   }

   private function cek_module($modules)
   {
      try {
         if (extension_loaded($modules)) {
            return "OK";
         } else {
            return "MISSING";
         }
      } catch (Exception $e) {
         return $e->getMessage();
      } catch (InvalidArgumentException $e) {
         return $e->getMessage();
      }
   }

   public function cek_modules()
   {
      $list_mod = array(
         'opcache',
         'bz2',
         'calendar',
         'ctype',
         'curl',
         'exif',
         'fileinfo',
         'ftp',
         'gd',
         'gettext',
         'iconv',
         'json',
         'mysqlnd',
         'pdo',
         'pgsql',
         'phar',
         'sockets',
         'sqlite3',
         'tokenizer',
         'mcrypt',
         'mysqli',
         'pdo_mysql',
         'pdo_pgsql',
         'pdo_sqlite',
         'zip',
      );
      echo '<p>Checking extension [' . date('d/m/Y H:i:s') . '] :</p>';

      foreach ($list_mod as $key => $val) {
         echo $val . " : ", $this->cek_module($val), '<br>';
      }
   }

   public function phpinfo()
   {
      // ini_set('memory_limit', '2048M'); // Limit memory to 2GB
      // ini_set("memory_limit", -1); // remove memory limits
      phpinfo();
   }

   public function info_test_db()
   {
      // Load model
      $this->load->model('info_model', 'model');

      // Retrive data
      $data['categories'] = $this->model->get_test_data();

      // Send data to view
      $this->load->view('Info', $data);
   }
}

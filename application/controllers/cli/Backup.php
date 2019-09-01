<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 7/24/16
 * Time: 10:52 AM
 */

/**
 * @property CI_DB_query_builder $db
 * Class Backup
 */
class Backup extends CI_Controller {

    private $database_backup_file = '';
    private $files_backup_file = '';

    const BACKUP_TO_SERVER = 1;

    public function __construct()
    {
        parent::__construct();

        if(!is_cli())
        {
            exit('No direct script access allowed');
        }
    }

    public function index($path) {

        /**
         * 1. create zip db backup
         * 2. create zip files backup
         * 3. merge two backups in one zip
         * 4. send the zip file to the specified
         */

        #1. create zip db backup
        $this->backup_database();

        #2. create zip files backup
        #3. merge two backups in one zip
        $this->backup_files();
        $this->backup_to_server();
    }

    private function backup_database() {

        $this->database_backup_file = 'backup-'.time().'.sql';

        $db_host = $this->db->hostname;
        $db_user = $this->db->username;
        $db_pass = $this->db->password;
        $db_name = $this->db->database;

        exec("mysqldump -u{$db_user} -h{$db_host} -p{$db_pass} {$db_name} > {$this->database_backup_file}");
    }

    private function backup_files() {
        $rootPath = FCPATH . 'files';

        $this->files_backup_file = 'backup-'.time().'.zip';

        // Initialize archive object
        $zip = new ZipArchive();
        $zip->open($this->files_backup_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // Create recursive directory iterator
        /** @var SplFileInfo[] $files */
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file)
        {
            // Skip directories (they would be added automatically)
            if (!$file->isDir())
            {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);

                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
            }
        }

        $this->backup_database();

        //Adding the database dump file
        $zip->addFile("{$this->database_backup_file}" , "{$this->database_backup_file}");

        // Zip archive will be created only after closing object
        $zip->close();
    }

    private function backup_to_server() {
        exec('mv '.$this->files_backup_file . ' ' . FCPATH . 'backup/');
    }
}
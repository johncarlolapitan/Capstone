<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends Admin_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_backup');
        $this->load->model('model_maincat');
        $this->data['page_title'] = 'Backup and Restore';

         $this->load->helper('url');
        $this->load->library('session');
    }
 
    public function index()
    {
        // Load the view and pass the data
        $this->render_template('backup/index', $this->data);	
       
    }
 
    public function create()
    {
        // Load the DB utility class
        $this->load->dbutil();
        
        $test = date('YmdS-His');
        // Backup your entire database and assign it to a variable
        $config = array (
            'format' => 'zip', // gzip, zip, txt
            'filename' => 'bubblebee_'.$test.'_db.sql', // File name - NEEDED ONLY WITH ZIP FILES
            'add_drop' => TRUE, // Whether to add DROP TABLE statements to backup file
            'add_insert' => TRUE, // Whether to add INSERT data to backup file
            'newline' => "\n", // Newline character used in backup file
            'foreign_key_checks' => FALSE,
        );
       $backup =& $this->dbutil->backup($config);
       $db_name ='bubblebee_'.$test.'.zip';
       $this->load->helper('download');
       force_download($db_name, $backup);
    }
   
    public function create3()
    {
        $this->load->helper('url');
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->library('zip');
        $this->load->dbutil();
        $db_format=array('format'=>'zip','filename'=>'bubblebee.sql');
        $backup=& $this->dbutil->backup($db_format);
        $dbname='bubblebee_'.date('Y-m-d').'.zip';
        $save ='assets/db_backup/'.$db_name;
        write_file($save,$backup);
        force_download($dbname,$backup);
    }
     public function create20()
    {
       $this->load->dbutil();

       $prefs = array(
        'format' => 'zip',
        'filename' => 'bubblebee.sql',
       );
       $backup =& $this->dbutil->backup($prefs);
       $db_name = 'backup-on-'.date("Y-m-d-h-i-s").'.zip';
       $save = 'assets/backup/'.$db_name;

       $this->load->helper('file');
       write_file($save,$backup);

       $this->load->helper('download');
       force_download($db_name, $backup);
    }
   public function restore() {
       
        // Connect to database
        $host = "localhost";
        $username = "root";
        $password = "";
        $database_name = "bubblebee";
        $conn = mysqli_connect($host, $username, $password, $database_name);
        $conn->set_charset("utf8");
        $name = $_FILES['datafile']['name'];
        $name1 = $_FILES['datafile']['tmp_name'];
        // Check if file is of type .sql
        if(pathinfo($name, PATHINFO_EXTENSION) != "sql") {
            return "File must be of type .sql";
        }
        
        // Read the file and execute the SQL script
        $file = fopen($name1, 'r');
        $query = fread($file, filesize($name1));
        fclose($file);
        $this->model_backup->droptable();
        // Execute the SQL script
        $result = mysqli_multi_query($conn, $query);
        if(!$result) {
            return "Error restoring database";
        }

        $user_id = $this->session->userdata('id');
        //audit trail
        $data1 = array(
            'date_time' => strtotime(date('Y-m-d h:i:s a')),
            'user_id' => $user_id,
            'action_made' => 'User has restored database',
        );

        $audit = $this->model_maincat->create1($data1);


        $this->session->set_flashdata('success', 'Successfully restored');
        header("Refresh:.2; url=index");
        
        

    }


    public function create_backup() {
        $this->model_backup->create_backup();
        $this->session->set_flashdata('success', 'Backup created successfully.');
        redirect('backup/index');
    }

    public function restore_backup() {
        $this->model_backup->restore_backup();
        $this->session->set_flashdata('success', 'Backup restored successfully.');
        redirect('backup/index');
    }


    public function backup_db()
    {
        $this->load->dbutil();
        $db_name = 'backup-db-'.$this->db->database.'-on'.date("Y-m-d-H-i-s").'.sql';
        $prefs = array(
            'format' => 'zip',
            'filename' => $db_name,
            'ignore'        => array(),  
            'add_insert' => TRUE,
            'foreign_key_checks' => FALSE,

        );
        $backup = $this->dbutil->backup($prefs);
        $save = 'pathtobkfolder'.$db_name;

        $this->load->helper('file');
        write_file($save, $backup);

        $this->load->helper('download');
        force_download($db_name, $backup);
    }
    public function asus(){
      $this->load->dbutil();   
       $backup =& $this->dbutil->backup();  
       $this->load->helper('file');
       write_file('your_file_path/your_DB.zip', $backup); 
    }
    function backup()
{
    $this->load->helper('download');
    $this->load->library('zip'); 
    $time = time(); 
    $this->zip->read_dir('D:xampp/htdocs/wms/');
    $this->zip->download('my_backup.'.$time.'.zip');
}

}

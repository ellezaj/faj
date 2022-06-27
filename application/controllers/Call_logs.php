<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Call_logs extends CI_Controller
{


  public function __construct()
  {
    parent::__construct();
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('', '');
    $this->load->model('Main');

    login_authentication();
  }

  public function index()
  {

    $this->template->title('Call Logs');
    $this->template->set_layout('default');
    $this->template->set_partial('header', 'partials/header');
    $this->template->set_partial('sidebar', 'partials/sidebar');
    $this->template->set_partial('aside', 'partials/aside');
    $this->template->set_partial('footer', 'partials/footer');
    $this->template->append_metadata('<script src="' . base_url("assets/js/pages/call_logs.js?ver=") . filemtime(FCPATH . "assets/js/pages/call_logs.js") . '"></script>');

    $this->template->build('call_logs_view');
  }

  public function save()
  {
    extract($_POST);
    $my_emp_id = $this->session->userdata('emp_id');
    $user_id = $this->session->userdata('user_id');
    $success = false;

    date_default_timezone_set("Asia/Hong_Kong");
    $date = date("Y-m-d H:i:s");

    $serial_number_same = (array)$this->Main->select([
      'select'       => '*',
      'table'        => 'tbl_equipment',
      'type'         => 'row',
      'condition'    => ['serial_number' => $serial_number],
    ]);

    if (!empty($serial_number_same)) {
      $response = array(
        'success' => false,
        'message' => "Serial Number Already Exists.",
      );

      response_json($response);
      return;
    }

    $insdata = [
      "equipment_type_id" => $equipment_type_id,
      // "technician_emp_id" => $technician_emp_id,
      "technician_emp_id" => $my_emp_id,
      "emp_id"            => $emp_id,
      "property_no"       => $property_no,
      "brand_model"       => $brand_model,
      "computer_name"     => $computer_name,
      "serial_number"     => $serial_number,
      "created_by"        => $user_id,
      "date_created"      => $date
    ];

    $equipment_id =  $this->Main->insert('tbl_equipment', $insdata, true)['lastid'];

    $condition['pst.removed'] = 0;
    $condition['pt.removed'] = 0;
    $condition['et.removed'] = 0;

    $condition['et.equipment_type_id'] = $equipment_type_id;
    $all_task_checklist = $this->e_model->getAllEquipmentTypeChecklist("*", $condition, []);
    $checklist_ins_batch = [];

    if (!empty($all_task_checklist)) {
      foreach ($all_task_checklist as $key => $value) {
        $checklist_ins_batch[] = [
          'equipment_id'   => $equipment_id,
          'pm_task_id'     => $value['pm_task_id'],
          'pm_sub_task_id' => $value['pm_sub_task_id']
        ];
      }
    }

    if (!empty($checklist_ins_batch)) {
      $success_batch = $this->Main->insertbatch("tbl_equipment_subtask_status", $checklist_ins_batch);
    }

    if ($success_batch && $equipment_id) {
      $success = true;
    }

    // logs
    $log_data['old_data'] = [];
    $log_data['new_data'] = $insdata;
    insertLogs("add", "tbl_equipment", $log_data);
    // logs

    $response = array(
      'success' => $success,
      'message' => "Successfully Added Equipment",
    );

    response_json($response);
  }

  public function update_pm()
  {
    extract($_POST);
    $success = false;

    date_default_timezone_set("Asia/Hong_Kong");
    $date = date("Y-m-d H:i:s");

    //check if equipment type id changed
    $equipment_data =  $this->Main->select([
      'select'    => '*',
      'table'     => 'tbl_equipment',
      'type'      => 'row',
      'condition' => ['equipment_id' => $equipment_id],
    ]);


    if ($equipment_data->equipment_type_id != $equipment_type_id) {
      // if changed, removed previous checklist

      $this->Main->update("tbl_equipment_subtask_status", ['equipment_id' => $equipment_id], ['removed' => 1]);

      $condition['et.equipment_type_id'] = $equipment_type_id;
      $all_task_checklist = $this->e_model->getAllEquipmentTypeChecklist("*", $condition, []);
      $checklist_ins_batch = [];

      if (!empty($all_task_checklist)) {
        foreach ($all_task_checklist as $key => $value) {
          $checklist_ins_batch[] = [
            'equipment_id'   => $equipment_id,
            'pm_task_id'     => $value['pm_task_id'],
            'pm_sub_task_id' => $value['pm_sub_task_id'],
            'date_created'   => $date
          ];
        }
      }

      if (!empty($checklist_ins_batch)) {
        $success_batch = $this->Main->insertbatch("tbl_equipment_subtask_status", $checklist_ins_batch);
      }
    }

    $update_data = [
      "equipment_type_id" => $equipment_type_id,
      "technician_emp_id" => $technician_emp_id,
      "emp_id" => $emp_id,
      "property_no" => $property_no,
      "brand_model" => $brand_model,
      "computer_name" => $computer_name,
      "serial_number" => $serial_number,
    ];

    $log_data['old_data'] = $this->Main->select([
      'select'    => '*',
      'table'     => 'tbl_equipment',
      'type'      => 'row',
      'condition' => ['equipment_id' => $equipment_id]
    ]);

    $success =  $this->Main->update('tbl_equipment', ['equipment_id' => $equipment_id], $update_data);

    // logs
    $log_data['new_data'] = $update_data;
    insertLogs("update", "tbl_equipment", $log_data);
    // logs

    $response = array(
      'success' => $success,
      'message' => "Successfully Updated Equipment",
    );

    response_json($response);
  }

  public function delete_pm()
  {
    extract($_POST);
    $success = false;
    $update_data = ['removed' => 1];

    $log_data['old_data'] = $this->Main->select([
      'select'    => '*',
      'table'     => 'tbl_equipment',
      'type'      => 'row',
      'condition' => ['equipment_id' => $equipment_id]
    ]);

    $success =  $this->Main->update('tbl_equipment', ['equipment_id' => $equipment_id], $update_data);

    // logs
    $log_data['new_data'] = $update_data;
    insertLogs("delete", "tbl_equipment", $log_data);
    // logs

    $response = array(
      'success' => $success,
      'message' => "Successfully Removed Equipment",
    );
    response_json($response);
  }
 
}


<?php

function cekLogin(){
    $ci=get_instance();
    if (!$ci->session->has_userdata('login_session')) {
        // setPesan('please login',false);
        redirect('auth');
    }
}

function isAdmin()
{
    $ci=get_instance();
    $role=$ci->session->userdata('login_session')['role'];

    $status=true;

    if ($role!='Administrator') {
        $status=false;
    }
    return $status;
}

function rupiah($angka){
	
	$hasil_rupiah = "Rp. " . number_format($angka,0,',','.');
	return $hasil_rupiah;
 
}

function isBagianUmum()
{
    $ci=get_instance();
    $role=$ci->session->userdata('login_session')['role'];

    $status=true;

    if ($role!='Bagian Umum') {
        $status=false;
    }
    return $status;
}

function isTeknisi()
{
    $ci=get_instance();
    $role=$ci->session->userdata('login_session')['role'];

    $status=true;

    if ($role!='Teknisi IT') {
        $status=false;
    }
    return $status;
}

function setPesan($pesan, $tipe=TRUE)
{
    $ci=get_instance();
    if ($tipe) {
        $ci->session->set_flashdata('pesan',"<div class='alert alert-success'><strong>SUCCESS!</strong> {$pesan} <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
    } else {
        $ci->session->set_flashdata('pesan', "<div class='alert alert-danger'><strong>ERROR!</strong> {$pesan} <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
    }
}

function userdata($field)
{
    $ci=get_instance();
    $ci->load->model('Admin_model','admin'); 

    $userId=$ci->session->userdata('login_session')['user'];
    return $ci->admin->get('user',['id_user'=>$userId])[$field];
}


function userdataPegawai($field)
{
    $ci=get_instance();
    $ci->load->model('Admin_model','admin'); 

    $userId=$ci->session->userdataPegawai('login_session')['user'];
    return $ci->admin->get('ustb_pegawai',['nip'=>$userId])[$field];
}


function output_json($data)
{
    $ci=get_instance();
    $data=json_encode($data);
    $ci->output->set_content_type('application/json')->set_output($data); 
}
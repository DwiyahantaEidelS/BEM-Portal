<?php
if (isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['jabatan'])) {
    include_once("m_programKerja.php");

    class c_programKerja
    {
        public $model;

        public function __construct()
        {
            $this->model = new m_programKerja();
        }

        public function invoke()
        {
            $jabatan = $_SESSION['jabatan']; 
            $proker = $this->model->getAll();
            include 'v_programKerja.php';
        }

        public function insert($nomorProgram, $namaProgram, $suratKeterangan)
        {
            $jabatan = $_SESSION['jabatan'];

            if ($jabatan == 'Kepala Departemen' || $jabatan == 'Staf') {
                $this->model->setProgramKerja($nomorProgram, $namaProgram, $suratKeterangan);
                header('Location: ' . "index.php");
            }
        }

        public function deleteAction($num)
        {
            $this->model->delete($num);
            header('Location: ' . "index.php");
        }

        public function updateAction($num, $nama, $surat)
        {
            $this->model->update($num, $nama, $surat);
            header('Location: ' . "index.php");

        }
    }
}
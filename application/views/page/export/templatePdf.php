<?php
date_default_timezone_set('Asia/Jakarta');
$this->apdf->SetMargins("10","","10");
$this->apdf->setFilename($filename);

$this->load->view($konten);

//Export
$this->apdf->Output(str_replace(" ", "_",$filename."_".$data->nomorfaktur).".pdf",'I');
?>
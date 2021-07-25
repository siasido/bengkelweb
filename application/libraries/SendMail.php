<?php

class SendMail {

    protected $ci;

    function __construct(){
        $this->ci =& get_instance();
    }

    public function send($data)
    {
        
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'bengkelsuryamadirimotor@gmail.com',  // Email gmail
            'smtp_pass'   => 'suryamandirimotor',  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        // Load library email dan konfigurasinya
        $this->ci->load->library('email', $config);

        // Email dan nama pengirim
        $this->ci->email->from('no-reply@smmotor.com', 'smmotor.com');

        // Email penerima
        $this->ci->email->to($data['recipient']); // Ganti dengan email tujuan

        // Lampiran email, isi dengan url/path file
        if ($data['attachment'] != null && !empty($data['attachment'])) {
            $this->ci->email->attach($data['attachment']);
        }

        // Subject email
        $this->ci->email->subject($data['subject']);

        // Isi email
        $this->ci->email->message($data['content']);

        // Tampilkan pesan sukses atau error
        if ($this->ci->email->send()) {
            echo 'Sukses! email berhasil dikirim.';
        } else {
            echo 'Error! email tidak dapat dikirim.';
        }
    }
}
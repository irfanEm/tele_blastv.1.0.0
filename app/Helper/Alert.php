<?php

namespace IRFANEM\TELE_BLAST\Helper;

class Alert
{
    public string $nama;
    public string $tipe;
    public string $pesan;

    public function __construct($nama, $tipe, $pesan)
    {
        $this->nama = $nama;
        $this->tipe = $tipe;
        $this->pesan - $pesan;
    }

    public function setAlert(): void
    {
        
    }

}

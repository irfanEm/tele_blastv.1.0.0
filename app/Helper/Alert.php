<?php

namespace IRFANEM\TELE_BLAST\Helper;

class Alert
{
    private string $nama;
    private string $tipe;
    private string $pesan;

    public function __construct($nama, $tipe, $pesan)
    {
        $this->nama = $nama;
        $this->tipe = $tipe;
        $this->pesan = $pesan;
    }

    public function getAlert(): array
    {
        return [
            'nama' => $this->nama,
            'tipe' => $this->tipe,
            'pesan' => $this->pesan
        ];
    }

}
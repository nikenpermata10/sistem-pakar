<?php

/** class Bayes */
class Bayes
{
    public $selected, $penyakit, $data;
    public $eh_total, $ph, $ph_eh, $ph_eh_total, $phe, $peh, $peh_total;
    /**
     * Konstruktor class
     * @param array $selected Gejala yang terpilih
     * @param array $penyakit Data semua penyakit (kode, nama, bobot, keterangan)
     * @param array $data Data bobot penyakit untuk setiap gejala
     */
    function __construct($selected, $penyakit, $data)
    {
        $this->selected = $selected;
        $this->penyakit = $penyakit;
        $this->data = $data;
        $this->hitung();
    }

    /**
     * Melakukan proses perhitungan
     */
    function hitung()
    {
        $this->eh_total = [];
        foreach ($this->data as $key => $val) {
            $this->eh_total[$key] = array_sum($val);
        }
        $this->ph = [];
        foreach ($this->data as $key => $val) {
            foreach ($val as $k => $v) {
                $this->ph[$key][$k] = $v / $this->eh_total[$key];
            }
        }
        $this->ph_eh = [];
        foreach ($this->ph as $key => $val) {
            foreach ($val as $k => $v) {
                $this->ph_eh[$key][$k] = $v * $this->data[$key][$k];
            }
            $this->ph_eh_total[$key] = array_sum($this->ph_eh[$key]);
        }
        $this->phe = [];
        foreach ($this->ph as $key => $val) {
            foreach ($val as $k => $v) {
                $this->phe[$key][$k] = $v * $this->data[$key][$k] / $this->ph_eh_total[$key];
            }
        }
        $this->peh = [];
        foreach ($this->phe as $key => $val) {
            foreach ($val as $k => $v) {
                $this->peh[$key][$k] = $v * $this->data[$key][$k];
            }
            $this->peh_total[$key] = array_sum($this->peh[$key]);
        }
    }
}

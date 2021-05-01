<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Bio;
use App\Models\Kelas;
use App\Models\Jkel;

class SiswaLw extends Component
{
  public $siswa;
  public $kelas;
  public $jkelas;
  public $id_user, $nama, $nis, $alamat, $user_id, $kd_kelas , $j_kelamin, $tanggal_lahir;
  public $isModalOpen = 0;
  public $nama_kelas, $id_kelas;
  public $jkel, $id_jkel;



  public function render()
  {
    $this->siswa = Bio::
    join('jkels', 'bios.j_kelamin', '=', 'jkels.id_jkel')
    ->join('kelas', 'kelas.id_kelas', '=', 'bios.kd_kelas')
    // ->select('nama_kelas','jkel')
    ->get();
    $this->kelas=Kelas::all();
    $this->jkelas=Jkel::all();
      return view('Livewire.siswa-lw')->layout('layouts.awetemplate');
  }

  public function create()
  {
      $this->resetCreateForm();
      $this->openModalPopover();
  }

  public function openModalPopover()
  {
      $this->isModalOpen = true;
  }

  public function closeModalPopover()
  {
      $this->isModalOpen = false;
  }

  private function resetCreateForm(){
      $this->id_user=null;
      $this->user_id = '1';
      $this->nama = '';
      $this->nis = '';
      $this->j_kelamin = '';
      $this->kd_kelas = '';
      $this->alamat = '';
      $this->tanggal_lahir = '';
  }

  public function store()
  {
      $this->validate([
          'nama' => 'required',
          'nis' => 'required',
          'j_kelamin' => 'required',
          'kd_kelas' => 'required',
          'alamat' => 'required',
          'tanggal_lahir' => 'required',
      ]);

      Bio::updateOrCreate(['id_user' => $this->id_user], [
        'user_id'=>$this->user_id,
        'nama' => $this->nama,
        'nis' => $this->nis,
        'j_kelamin' => $this->j_kelamin,
        'kd_kelas' => $this->kd_kelas,
        'alamat' => $this->alamat,
        'tanggal_lahir' => $this->tanggal_lahir,
      ]);

      session()->flash('message', $this->id_user ? 'Data Siswa updated.' : 'Data Siswa created.');

      $this->closeModalPopover();
      $this->resetCreateForm();
  }

  public function edit($id_user)
  {
      $siswa = Bio::findOrFail($id_user);
      $this->id_user=$siswa->id_user;
      $this->user_id = $siswa->user_id;
      $this->nama = $siswa->nama;
      $this->nis = $siswa->nis;
      $this->j_kelamin = $siswa->j_kelamin;
      $this->kd_kelas = $siswa->kd_kelas;
      $this->alamat = $siswa->alamat;
      $this->tanggal_lahir = $siswa->tanggal_lahir;

      $this->openModalPopover();
  }

  public function delete($id_user)
  {
      Bio::find($id_user)->delete();
      session()->flash('message', 'Data Siswa telah Dihapus.');
  }

}

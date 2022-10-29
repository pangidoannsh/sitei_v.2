<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Konsentrasi;
use App\Models\Mahasiswa;
use App\Models\Role;
use App\Models\User;
use App\Models\Prodi;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'role_id' => 1,
            'username' => 'tariseptaviani',
            'nama' => 'Tari Septa Viani',
            'email' => 'tarisepta@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        User::create([
            'role_id' => 2,
            'username' => 'muhammadpeter',
            'nama' => 'Muhammad Peter, A.Md',
            'email' => 'muhpeter@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        User::create([
            'role_id' => 3,
            'username' => 'khairinafitria',
            'nama' => 'Khairina Fitria Lubis, S.Kom',
            'email' => 'khairinafitria@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        User::create([
            'role_id' => 4,
            'username' => 'zainalasri',
            'nama' => 'Zainal Asri',
            'email' => 'zainalasri@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        Role::create([
            'role_akses' => 'Staff Jurusan'
        ]);

        Role::create([
            'role_akses' => 'Staff Prodi TE D3'
        ]);

        Role::create([
            'role_akses' => 'Staff Prodi TE S1'
        ]);

        Role::create([
            'role_akses' => 'Staff Prodi TI S1'
        ]);

        Role::create([
            'role_akses' => 'Ketua Jurusan'
        ]);

        Role::create([
            'role_akses' => 'Ketua Prodi TE D3'
        ]);

        Role::create([
            'role_akses' => 'Ketua Prodi TE S1'
        ]);

        Role::create([
            'role_akses' => 'Ketua Prodi TI S1'
        ]);

        Role::create([
            'role_akses' => 'Koordinator KP & Skripsi TE D3'
        ]);

        Role::create([
            'role_akses' => 'Koordinator KP & Skripsi TE S1'
        ]);

        Role::create([
            'role_akses' => 'Koordinator KP & Skripsi TI S1'
        ]);

        Prodi::create([
            'nama_prodi' => 'Teknik Elektro D3'
        ]);

        Prodi::create([
            'nama_prodi' => 'Teknik Elektro S1'
        ]);

        Prodi::create([
            'nama_prodi' => 'Teknik Informatika S1'
        ]);

        Konsentrasi::create([
            'nama_konsentrasi' => 'Teknik Tenaga Listrik'
        ]);

        Konsentrasi::create([
            'nama_konsentrasi' => 'Teknik Telekomunikasi'
        ]);

        Konsentrasi::create([
            'nama_konsentrasi' => 'Komputasi Cerdas dan Visualiasi'
        ]);

        Konsentrasi::create([
            'nama_konsentrasi' => 'Rekayasa Perangkat Lunak'
        ]);

        Konsentrasi::create([
            'nama_konsentrasi' => 'Komputasi Berbasis Jaringan'
        ]);

        Mahasiswa::create([
            'prodi_id' => 3,
            'konsentrasi_id' => 4,
            'nim' => '1807125148',
            'nama' => 'Rahul Ilsa Tajri Mukhti',
            'email' => 'rahul.ilsa5148@student.unri.ac.id',
            'password' => bcrypt('123456'),
            'angkatan' => '2018',
        ]);

        Mahasiswa::create([
            'prodi_id' => 3,
            'konsentrasi_id' => 3,
            'nim' => '1807125149',
            'nama' => 'Murdillah Rezky',
            'email' => 'murdillah.rezky5149@student.unri.ac.id',
            'password' => bcrypt('123456'),
            'angkatan' => '2018',
        ]);

        Mahasiswa::create([
            'prodi_id' => 3,
            'konsentrasi_id' => 5,
            'nim' => '1807125150',
            'nama' => 'M. Fajar Edwin Saputra',
            'email' => 'fajar.edwin5150@student.unri.ac.id',
            'password' => bcrypt('123456'),
            'angkatan' => '2018',
        ]);

        Mahasiswa::create([
            'prodi_id' => 3,
            'konsentrasi_id' => 4,
            'nim' => '1807125151',
            'nama' => 'Fahril Hadi',
            'email' => 'fahril.hadi515q@student.unri.ac.id',
            'password' => bcrypt('123456'),
            'angkatan' => '2018',
        ]);

        Mahasiswa::create([
            'prodi_id' => 3,
            'konsentrasi_id' => 4,
            'nim' => '1807125152',
            'nama' => 'M. Seprinaldi',
            'email' => 'm.seprinaldi5152@student.unri.ac.id',
            'password' => bcrypt('123456'),
            'angkatan' => '2018',
        ]);

        Mahasiswa::create([
            'prodi_id' => 3,
            'konsentrasi_id' => 4,
            'nim' => '1807125153',
            'nama' => 'Aqil Muafa',
            'email' => 'aqilmuafa@student.unri.ac.id',
            'password' => bcrypt('123456'),
            'angkatan' => '2018',
        ]);

        Dosen::create([
            'role_id' => 5,            
            'nip' => 000,
            'password' => bcrypt('123456'),
            'nama' => 'Anhar, ST., MT., Ph.D',
            'email' => 'anhar.lecturer@unri.ac.id',
        ]);

        Dosen::create([
            'role_id' => 8,            
            'nip' => 111,
            'password' => bcrypt('123456'),
            'nama' => 'Dr. Feri Candra, ST., MT',
            'email' => 'fericandra.lecturer@unri.ac.id',
        ]);

        Dosen::create([
            'role_id' => 11,            
            'nip' => 222,
            'password' => bcrypt('123456'),
            'nama' => 'Edi Susilo, S.Pd., M.Kom., M.Eng',
            'email' => 'edisusilo.lecturer@unri.ac.id',
        ]);

        Dosen::create([                       
            'nip' => 333,
            'password' => bcrypt('123456'),
            'nama' => 'T. Yudi Hadiwandra, S.Kom., M.Kom',
            'email' => 'yudi.lecturer@unri.ac.id',
        ]);

        Dosen::create([                     
            'nip' => 444,
            'password' => bcrypt('123456'),
            'nama' => 'Dr. Irsan Taufik Ali, ST., MT',
            'email' => 'anhar.lecturer@unri.ac.id',
        ]);

        Dosen::create([                        
            'nip' => 555,
            'password' => bcrypt('123456'),
            'nama' => 'Rahyul Amri, ST., MT',
            'email' => 'rahyulamri.lecturer@unri.ac.id',
        ]);
    }
}

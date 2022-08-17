@extends('layouts.layout')


@section('isi')

<div class="row mb-5">

    <div class="col-6">
        <ol class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold mb-2">NIM</div>
            <span>1807125148</span>         
            </div>        
        </li> 
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold mb-2">Nama</div> 
            <span>Rahul Ilsa Tajri Mukhti</span>            
            </div>        
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold mb-2">Judul</div>
            <span>Sistem Penilaian Seminar Akademik</span>             
            </div>        
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold mb-2">Jadwal</div>
            <span>12 Agustus 2022, 08:00</span>             
            </div>        
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold mb-2">Lokasi</div>
            <span>Lab. RPL</span>           
            </div>        
        </li>   
        </ol>
    </div>

    <div class="col-6">
        <ol class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold mb-2">Pembimbing</div>
                <span>Edi Susilo, S.Pd., M.Kom., M.Eng</span>
                <br>
                <span>Anhar, S.T., M.T., Ph.D</span>
            </div>        
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold mb-2">Penguji</div>
                <span>Dr. Irsan Taufik Ali, ST., MT</span> 
                <br>
                <span>T. Yudi Hadiwandra, S.Kom., M.Kom</span> 
                <br>
                <span>Dr. Feri Candra, ST., MT</span>                               
            </div>        
        </li>     
        </ol>
    </div>

</div>

<div>    
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 100px">#</th>
                        <th style="width: 700px">Aspek Penilaian Pembimbing</th>
                        <th class="bg-danger" style="width: 30px">B</th>
                        <th>Nilai Pembimbing</th>                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>  
                        <td>Penguasaan Dasar Teori</td>
                        <td class="bg-secondary">9</td>
                        <td>0</td>                        
                    </tr>
                    <tr>
                        <td>2</td> 
                        <td>Tingkat Penguasaan Materi</td>
                        <td class="bg-secondary">9</td>
                        <td>0</td>                                            
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Tinjauan Pustaka</td>
                        <td class="bg-secondary">9</td>
                        <td>0</td>                                              
                    </tr>
                    <tr>
                        <td>4</td> 
                        <td>Tata Tulis</td>
                        <td class="bg-secondary">9</td>
                        <td>0</td>                                              
                    </tr>
                    <tr>
                        <td>5</td> 
                        <td>Sikap dan Kepribadian Selama Bimbingan</td>
                        <td class="bg-secondary">9</td>
                        <td>0</td>                                               
                    </tr>                    

                    <tr>
                        <td colspan="2">Total Nilai Pembimbing</td>
                        <td class="bg-danger">45</td>
                        <td class="bg-warning">0</td>                        
                    </tr>
                    <tr>
                        <td colspan="3">Nilai Huruf Pembimbing</td>                        
                        <td class="bg-warning">E</td>                       
                    </tr>                   
                </tbody>
            </table>          
</div>
@endsection   
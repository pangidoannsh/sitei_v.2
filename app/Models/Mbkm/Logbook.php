<?php

namespace App\Models\Mbkm;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;

    protected $table = "mbkm_logbook";
    protected $guarded = [];

    public static function generateMonthArray($startDate, $endDate)
    {
        // Ubah string tanggal menjadi objek Carbon
        $startDate = Carbon::createFromFormat('Y-m-d', $startDate);
        $endDate = Carbon::createFromFormat('Y-m-d', $endDate);

        // Inisialisasi array untuk menyimpan bulan-bulan
        $monthArray = [];

        // Tambahkan tanggal mulai kegiatan
        $currentDate = $startDate;
        $monthArray[] = $currentDate->toDateString();

        // Tambahkan satu bulan pada setiap iterasi sampai mencapai tanggal selesai
        while ($currentDate->lessThan($endDate)) {
            $currentDate->addMonths(1);
            if ($currentDate->greaterThanOrEqualTo($endDate)) {
                break;
            }
            $monthArray[] = $currentDate->toDateString();
        }

        return $monthArray;
    }
}

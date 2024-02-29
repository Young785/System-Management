<?php

namespace App\Exports;

use App\Models\Member;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MembersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $memberQuery = Member::select(
                '*',
                'zones.name as zone_name',
                'members.code as code',
                'regions.name as region_name',
                DB::raw("DATE_FORMAT(members.created_at, '%d %M %Y') as created_at"), DB::raw("DATE_FORMAT(members.updated_at, '%d %M %Y') as updated_at")
            )
            ->join("zones", "zones.code", "members.zone_id")
            ->join("regions", "regions.code", "=", "zones.region_id");
            
        if(auth()->user()->role === 'superadmin'){
            return $memberQuery->get();
        } else {
            return $memberQuery->where("manager_id", auth()->user()->secret_code)->get();
        }
    }
    public function headings(): array
    {
        $firstRow = $this->collection()->first();
        return array_keys($firstRow->toArray());
    }
}

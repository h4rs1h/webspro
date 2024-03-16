<?php

namespace App\Imports;

use App\Models\Ownership;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class OwnershipImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Ownership([
            'business_id' => $row['business_id'],
            'name' => $row['name'],
            'salutation' => $row['salutation'],
            'tel_no' => $row['tel_no'],
            'hand_phone' => $row['hand_phone'],
            'fax_no' => $row['fax_no'],
            'owner_acct' => $row['owner_acct'],
            'lot_no' => $row['lot_no'],
            'rentable_area' => $row['rentable_area'],
            'address1' => $row['address1'],
            'address2' => $row['address2'],
            'address3' => $row['address3'],
            'post_cd' => $row['post_cd'],
            'mail_addr1' => $row['mail_addr1'],
            'mail_addr2' => $row['mail_addr2'],
            'mail_addr3' => $row['mail_addr3'],
            'mail_post_cd' => $row['mail_post_cd'],
            'type_descs' => $row['type_descs'],
            'build_up_area' => $row['build_up_area'],
            'remark' => $row['remark'],
            'start_date' => $row['start_date'],
            'handphone4' => $row['handphone4'],
            'virtual_acct' => $row['virtual_acct'],
            'virtual_acct_real' => $row['virtual_acct_real'],
        ]);
    }
}

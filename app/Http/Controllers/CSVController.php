<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\Datatables;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Api\patientDetails;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CSVController extends Controller
{

    public function export()
    {

        $data = $data = User::with(['patientDetails.referringProvider'])->where('role_id', '5')->get();

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the headers
        $headers = ['EZMed Number', 'Patient Name', 'Identification Number', 'Referring Provider'];
        $sheet->fromArray($headers, null, 'A1');

        // Set the data starting from the second row
        $rowData = [];

        foreach ($data as $row) {


            $rowData[] = [$row->patientDetails->EZMed_number, $row->first_name . ' ' . $row->last_name, $row->identity_number, $row->patientDetails->referringProvider->first_name . ' ' . $row->patientDetails->referringProvider->last_name];
        }
        $sheet->fromArray($rowData, null, 'A2');
        $sheet->getStyle('A1:D1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
        // Create a new Excel Writer object and save the Spreadsheet as a file
        $writer = new Xlsx($spreadsheet);
        $fileName = 'patients.xlsx';
        $writer->save($fileName);

        // Return the file as a download response
        return response()->download($fileName)->deleteFileAfterSend();
    }
}

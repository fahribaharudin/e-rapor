<?php

namespace App\Jobs\Data;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Excel;

class ImportDataAbstract extends Job
{

    /**
     * Contains the result of reading uploaded excel file
     * 
     * @var array
     */
    protected $imported_data = [];

    
    /**
     * Handle the process of reading uploaded excel file
     * 
     * @param  File $file 
     * @return void       
     */
    protected function readExcelFile($file)
    {
        // Upload the file
        $file->move(
            storage_path('app/laravel-excel/'), 
            'uploaded_file.' . $file->getClientOriginalExtension()
        );

        Excel::load(storage_path('app/laravel-excel/uploaded_file.xlsx'), function($reader) {
            $this->importDataToArray($reader);
        });

        // Delete the file after reading 
        unlink(storage_path('app/laravel-excel/uploaded_file.xlsx'));
    }


    /**
     * Handle importing data from an excel file to array collection
     * 
     * @param  LaravelExcelReader $excel 
     * @return void        
     */
    // abstract protected function importDataToArray($excel);

}

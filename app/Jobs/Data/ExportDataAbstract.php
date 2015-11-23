<?php

namespace App\Jobs\Data;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

abstract class ExportDataAbstract extends Job
{

    /**
     * Set description to the exported file
     * 
     * @param GuruListExport $file 
     * @return GuruListExport $file
     */
    protected function setFileDescription($file, array $description)
    {
        $file->setTitle($description['title'])
            ->setCreator('Fahri Baharudin')
            ->setCompany('kenekono.com')
            ->setDescription('Digunakan sebagai backup atau draft import data ke aplikasi e-Rapor');

        return $file;
    }
    
}

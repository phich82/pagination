<?php

namespace Tests\Unit;

use Tests\TestCase;
use org\bovigo\vfs\vfsStream;
use Illuminate\Http\UploadedFile;
use org\bovigo\vfs\vfsStreamFile;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UploadCsvTest extends TestCase
{
    public function testSuccessfulUploadingCsv()
    {
        $this->json('POST', 'upload-csv', [
            'usersCsvFile' => $this->createCsvUploadFile()
        ]);
        $this->assertResponseOk();
        $this->seeJson(["username,\"first name\",\"last name\"\n","jondoe,Jon,Doe\n","janedoe,Jane,Doe\n"]);
    }

    protected function createCsvUploadFile($fileName = 'testFile')
    {
        $virtualFile = $this->createVirtualFile($fileName, 'csv')->getChild($fileName.'.csv');

        $fileResource = fopen($virtualFile->url(), 'a+');
        collect([
            ['username', 'first name', 'last name'],
            ['jondoe', 'Jon', 'Doe'],
            ['janedoe', 'Jane', 'Doe']
        ])->each(function ($fields) use ($fileResource) {
            fputcsv($fileResource, $fields);
        });
        fclose($fileResource);

        return $this->createUploadFile($virtualFile);
    }

    protected function createUploadFile(vfsStreamFile $file)
    {
        return new UploadedFile(
            $file->url(),
            null,
            mime_content_type($file->url()),
            null,
            null,
            true
        );
    }

    protected function createVirtualFile($filename, $extension)
    {
        return vfsStream::setup(sys_get_temp_dir(), null, [$filename.'.'.$extension => '']);
    }
}

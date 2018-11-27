<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Email_template;
use App\User_order;
use App\User;
use Mail;
use DB;

class cronEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dailyOrdersReport:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send daily email with total orders placed in a day.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $userName="";
        $todaysOrderDetails='';
        $todaysOrders=User_order::with('user')->where('created_at', '>=',date('Y-m-d').' 00:00:00')->get();
        $orderStatus="";
        $totalRevenue=0;
        $totalOrderCount=0;
        $orderSummary="";


        foreach($todaysOrders as $todaysOrder)
        {
            
            $userName=$todaysOrder->user['firstname']." ".$todaysOrder->user['lastname'];
            
            if($todaysOrder->status=='p')
            {
                $orderStatus="pending";
            }
            else if($todaysOrder->status=='o')
            {
                $orderStatus="processing";
            }
            else if($todaysOrder->status=="s")
            {
                $orderStatus="shipped";
            }
            else if($todaysOrder->status=="d")
            {
                $orderStatus="deliverd";
            }

            $todaysOrderDetails.="<tr><td>".$todaysOrder->id."</td><td>".$userName."</td><td>".$todaysOrder->billing_address_1.",<br>".$todaysOrder->billing_address_2.",<br>".$todaysOrder->billing_city.", ".$todaysOrder->billing_state."<br>".$todaysOrder->billing_country.", ".$todaysOrder->billing_zipcode."</td><td>".$todaysOrder->grand_total."</td><td>".$orderStatus."</td></tr>";

            $totalOrderCount++;
            $totalRevenue=$totalRevenue+$todaysOrder->grand_total;

        }

        $todaysOrderTableView="<table border='1' style='border-collapse:collapse;'><tr><th>Order ID</th><th>Customer Name</th><th>Customer Address</th><th>Ammount</th><th>Status</th></tr>".$todaysOrderDetails."</table>";
        $orderSummary="<table border='1' style='border-collapse:collapse;'><tr><th>Total Orders</th><th>Revenue</th></tr><tr><td>".$totalOrderCount."</td><td>$".$totalRevenue."</td></tr></table>";
        $template=Email_template::where('title','=','todaysAllOrder')->get();
        foreach($template as $email)
        {
            $subject=$email->subject;
            $content=$email->content;
        }
        $content=str_replace("{todaysOrderDetails} ",$todaysOrderTableView,$content);
        $content=str_replace("{todaysOrderSummary}",$orderSummary,$content);

        Mail::send([],[], function($message) use ($content,$subject)
        {
            $message->to('eshopersnoreply@gmail.com')->subject($subject)->setBody($content, 'text/html');
        });
        
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\User_wish_list;
use App\Product;
use DB;
use Carbon\Carbon;
use Mail;
use App\Email_template;

class weeklyWishlistReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weeklyWishlistReport:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send weekly report of users wish list to admin';

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
        $userWishlistDetails='';
        $topWishlistedProducts='';
        $startDate=Carbon::now()->subweek(4);
        foreach(User_wish_list::with('user')->select('user_id')->distinct()->get() as $user)
        {
            $userWishlistDetails.="<tr><td>".$user->user['firstname']." ".$user->user['lastname']."</td><td><ul>";
            foreach(User_wish_list::with('user','product')->where('user_id','=',$user->user['id'])->where('created_at','>=',$startDate)->get() as $wishlistProduct)
            {
                $userWishlistDetails.="<li>".$wishlistProduct->product['name']."</li>";
            }
            $userWishlistDetails.="</ul></td></tr>";
        }
        $wishlistTable="<table border='1' style='border-collapse:collapse; vertical-align:top'><tr><th>Customer Name</th><th>Wishlisted Products</th></tr>".$userWishlistDetails."</table>";

       $topWishlistedProducts.="<table border='1' style='border-collapse:collapse;'><th colspan='4'>Top 3 Wishlisted Products</th></tr><tr><td>Sr.No</td><td>Product Id</td><td>Name</td><td>Description</td></tr>";
       $i=1;
       foreach(User_wish_list::all()->groupBy('product_id')->sortByDesc('occurrences')->take(3) as $topProductKey => $value)
       {
        foreach(Product::where('id','=',$topProductKey)->get() as $product)
            {
                $topWishlistedProducts.="<tr><td>".$i."</td><td>".$topProductKey."</td><td>".$product->name."</td><td>".$product->short_description."</td></tr>";
            }
            $i++;
       }
       $topWishlistedProducts.="</table>";

       $template=Email_template::where('title','=','wishListReport')->get();
        foreach($template as $email)
        {
            $subject=$email->subject;
            $content=$email->content;
        }
        $content=str_replace("{userWishList}",$wishlistTable,$content);
        $content=str_replace("{topProducts}",$topWishlistedProducts,$content);

        Mail::send([],[], function($message) use ($content,$subject)
        {
            $message->to('eshopersnoreply@gmail.com')->subject($subject)->setBody($content, 'text/html');
        });        
    }
}

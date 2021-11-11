<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;
use App\Models\Compra;

class TransbankController extends Controller
{
    public function __construct()
    {
        if (app()->environment('production')) 
        {
            WebpayPlus::configureForProduction(
                env('webpay_plus_cc'),
                env('webpay_plus_api_key')
            );
        }
        else 
        {
            WebpayPlus::configureForTesting();
        }
    }

    public function iniciar_compra(Request $request)
    {
        $nueva_compra = new Compra();
        $nueva_compra->session_id = "123456";
        $nueva_compra->total = 123456;
        $nueva_compra->save();
        $url_to_pay = self::start_web_pay_plus_transaction($nueva_compra);
        return $url_to_pay;
    }

    public function start_web_pay_plus_transaction($nueva_compra)
    {
       
        $transaccion = (new Transaction)->create(
            $nueva_compra->id, //buy order
            $nueva_compra->session_id, //session_id
            $nueva_compra->total, //amount
            route('confirmar_pago') //return url
        );

        $url = $transaccion->getUrl().'?token_ws='.$transaccion->getToken();
        return $url;
    }

    public function confirmar_pago(Request $request)
    {
       
        //$compra = Compra::where('id', 20)->first();
        //return redirect()->route('confirmacion', ['compra_id' => $compra->id]);

        $confirmacion = (new Transaction)->commit($request->get('token_ws'));

        $compra = Compra::where('id', $confirmacion->buyOrder)->first();
        
        if ($confirmacion->isApproved()) 
        {
            $compra->status = 2; //aprobada
            $compra->update();

            return redirect()->route('confirmacion', ['compra_id' => $compra->id]);
            //return redirect(('/confirmacion')."?compra_id={$compra->id}");
        }
        else //fallida o rechazada
        {
            return redirect()->route('confirmacion', ['compra_id' => $compra->id]);
            //return redirect(('/confirmacion')."?compra_id={$compra->id}");
        }
    }

}

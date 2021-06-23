<?php

namespace App\Console\Commands\AvisoEmail;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use stdClass;
use Carbon\Carbon;
use App\Models\Servicios\ClienteServicio;
use DateTime;
use Illuminate\Support\Facades\Mail;

class AvisoFechaExpiracionServicio extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fecha:expiracion';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Aviso de permanencia del servicio contratado';

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
     * @return int
     */
    public function handle()
    {

        $services = ClienteServicio::with('cliente', 'servicio')->get(); 

        foreach ($services as $service) {
            $fechaActual = Carbon::now();
            $avisoPermanencia =  new DateTime($service->aviso_permanencia);
            $diff = $fechaActual->diff($avisoPermanencia);  
           
            if ($diff->days == 29) {
                // echo "enviar mail";
                // echo ($diff->invert == 1) ? ' - ' . $diff->days .' days '  : $diff->days .' days ';

                $data = ["servicio" => $service];
                if ($service->cliente->email != null) {
                    Mail::send('emails.expiracion', $data, function ($message) use ($data)
                    {
                        // $pdfFactura = PDF::loadView('pdf.factura_pdf_view', $data);
                        $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME')); //From correo de la app
                        $message->to($data['servicio']['cliente']['email'])->subject('Aviso de Permanancia ' .  env('APP_NAME'));
                    });
                }
                
            }

        }       

       



       
    }
}

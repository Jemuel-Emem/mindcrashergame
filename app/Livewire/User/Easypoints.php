<?php

namespace App\Livewire\User;
use Livewire\Component;
use Dompdf\Dompdf;
class Easypoints extends Component
{
    public $label =false ;
    public $score;
    public $score1;
    public $add_modal = false;

    public function mount($score)
    {
        $user = auth()->user();

        $this->score = $score;

    }


    public function render()
    {

        return view('livewire.user.easypoints');
    }

    public function download()
    {
        // Generate HTML content for the certificate
        $htmlContent = '<div>
            <h1>CONGRATULATIONS!</h1>
            <p>YOU FINISHED THIS LEVEL</p>
            <p>Score: ' . $this->score . ' points</p>
        </div>';

        // Create Dompdf instance
        $dompdf = new Dompdf();

        // Load HTML content
        $dompdf->loadHtml($htmlContent);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (important step)
        $dompdf->render();

        // Generate file name
        $fileName = 'certificate_' . date('YmdHis') . '.pdf';

        // Output PDF to browser for download
        $dompdf->stream($fileName);
    }

    public function hello(){
        dd("sasa");
       }
}
